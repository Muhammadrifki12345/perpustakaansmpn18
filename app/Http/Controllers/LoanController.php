<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Waitlist;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->isAdmin() 
            ? Loan::with(['user', 'book']) 
            : Loan::where('user_id', auth()->id())->with('book');

        if ($request->status === 'returned') {
            $query->where('status', 'returned');
        } elseif ($request->status === 'active') {
            $query->whereIn('status', ['borrowed', 'pending']);
        }

        $loans = $query->latest()->get();

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::where('stock', '>', 0)->get();
        return view('loans.create', compact('books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($validated['book_id']);

        // Tentukan User ID (Admin bisa meminjamkan untuk orang lain / mencatat data siswa)
        $userId = (auth()->user()->isAdmin() && $request->has('user_id'))
            ? $request->user_id
            : auth()->id();

        // Cek apakah user sudah meminjam/booking buku ini
        $existingLoan = Loan::where('user_id', $userId)
            ->where('book_id', $book->id)
            ->whereIn('status', ['borrowed', 'pending'])
            ->exists();

        if ($existingLoan) {
            return back()->with('error', 'Siswa ini sudah memiliki permintaan aktif atau sedang meminjam buku ini.');
        }

        // Limit max 3 buku (untuk status borrowed)
        $activeLoans = Loan::where('user_id', $userId)->where('status', 'borrowed')->count();
        if ($activeLoans >= 3 && !auth()->user()->isAdmin()) {
            return back()->with('error', 'Batas maksimal peminjaman tercapai. Kembalikan buku lain terlebih dahulu (Maksimal 3).');
        }

        // Cek stok buku
        if ($book->stock < 1) {
            if (auth()->user()->isAdmin()) {
                return back()->with('error', 'Stok buku habis. Tidak bisa mencatat peminjaman.');
            }

            // Siswa masuk waitlist
            $exists = \App\Models\Waitlist::where('user_id', $userId)
                ->where('book_id', $book->id)
                ->where('status', 'waiting')
                ->exists();

            if ($exists) {
                return back()->with('error', 'Kamu sudah berada dalam daftar tunggu buku ini.');
            }

            \App\Models\Waitlist::create([
                'user_id' => $userId,
                'book_id' => $book->id,
                'status' => 'waiting'
            ]);

            return redirect()->route('dasbor')->with('success', "Stok habis. Kamu telah masuk dalam daftar tunggu.");
        }

        // Buat permintaan peminjaman
        // Jika dicatat oleh Admin, langsung status 'borrowed'
        $status = auth()->user()->isAdmin() ? 'borrowed' : 'pending';

        $startDate = now()->toDateString();
        $duration = (int) \App\Models\Setting::getValue('loan_duration', 7);
        $endDate = now()->addDays($duration)->toDateString();

        $loanData = [
            'user_id' => $userId,
            'book_id' => $book->id,
            'invoice_number' => Loan::generateInvoiceNumber(),
            'loan_date' => $startDate,
            'expected_return_date' => $endDate,
            'status' => $status,
        ];

        $loan = Loan::create($loanData);

        if ($status === 'borrowed') {
            $book->decrement('stock');
            $book->increment('borrow_count');

            \App\Models\Activity::create([
                'user_id' => auth()->id(),
                'type' => 'borrowed',
                'details' => ['book_id' => $book->id, 'title' => $book->title]
            ]);

            return redirect()->route('peminjaman.invoice', $loan->id)->with('success', 'Peminjaman berhasil dicatat!');
        }

        return redirect()->route('peminjaman.invoice', $loan->id)->with('success', 'Permintaan peminjaman terkirim. Menunggu persetujuan pengurus.');
    }

    public function show(Loan $loan)
    {
        // Siswa hanya boleh melihat loan milik sendiri
        if (!auth()->user()->isAdmin() && $loan->user_id !== auth()->id()) {
            abort(403);
        }

        $loan->load(['user', 'book.category', 'book.shelf']);
        return view('loans.invoice', compact('loan'));
    }

    /**
     * Invoice / Bukti Peminjaman
     */
    public function invoice(Loan $loan)
    {
        // Siswa hanya boleh melihat invoice milik sendiri
        if (!auth()->user()->isAdmin() && $loan->user_id !== auth()->id()) {
            abort(403);
        }

        $loan->load(['user', 'book.category', 'book.shelf']);
        return view('loans.invoice', compact('loan'));
    }

    public function update(Request $request, Loan $loan)
    {
        if (auth()->user()->isAdmin() || auth()->id() === $loan->user_id) {
            if ($request->has('status') && $request->status === 'returned' && $loan->status !== 'returned') {
                // Tambahkan catatan teguran jika terlambat
                $notes = null;
                if ($loan->expected_return_date && now() > $loan->expected_return_date) {
                    $daysLate = now()->diffInDays($loan->expected_return_date);
                    $notes = $request->notes ?? "Terlambat {$daysLate} hari. Siswa telah diberikan teguran.";
                }

                if ($notes) {
                    $loan->update(['notes' => $notes]);
                }

                $loan->markAsReturned();

                return back()->with('success', 'Buku berhasil dikembalikan.' . ($notes ? ' (Keterlambatan dicatat)' : ''));
            }
        }
        return back()->with('error', 'Akses ditolak.');
    }

    public function destroy(Loan $loan)
    {
        if (auth()->user()->isAdmin()) {
            if ($loan->status === 'borrowed') {
                $loan->book->increment('stock');
            }
            $loan->delete();
            return back()->with('success', 'Data dihapus.');
        }
        return back()->with('error', 'Akses ditolak.');
    }

    /* ─── Admin: Approval Methods ─── */

    public function approvals()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $globalPendingRequests = Loan::with(['user', 'book'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('admin.approvals', compact('globalPendingRequests'));
    }

    public function waitlistAdmin()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $waitlists = \App\Models\Waitlist::with(['user', 'book'])
            ->where('status', 'waiting')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.waitlist', compact('waitlists'));
    }

    public function destroyWaitlist(\App\Models\Waitlist $waitlist)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $waitlist->delete();

        return back()->with('success', 'Daftar tunggu berhasil dibatalkan dan dihapus.');
    }

    public function approve(Loan $loan)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $duration = (int) \App\Models\Setting::getValue('loan_duration', 7);

        $loan->update([
            'status' => 'borrowed',
            'loan_date' => now()->toDateString(),
            'expected_return_date' => now()->addDays($duration)->toDateString(),
        ]);

        // Generate invoice number if not already set
        if (!$loan->invoice_number) {
            $loan->update(['invoice_number' => Loan::generateInvoiceNumber()]);
        }

        if ($loan->book) {
            $loan->book->decrement('stock');
            $loan->book->increment('borrow_count');

            // Rekam aktivitas untuk user yang meminjam
            \App\Models\Activity::create([
                'user_id' => $loan->user_id,
                'type' => 'borrowed',
                'details' => ['book_id' => $loan->book->id, 'title' => $loan->book->title]
            ]);
        }

        return back()->with('success', 'Permintaan peminjaman telah disetujui (ACC)! Siswa dapat mengambil buku di perpustakaan.');
    }

    public function reject(Loan $loan)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $loan->update(['status' => 'rejected']);

        return back()->with('success', 'Permintaan peminjaman ditolak.');
    }
}

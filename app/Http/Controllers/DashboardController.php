<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Otomatis tandai keterlambatan untuk semua pinjaman aktif yang melewati jatuh tempo
        Loan::where('status', 'borrowed')
            ->where('expected_return_date', '<', now()->startOfDay())
            ->where('is_late', false)
            ->update(['is_late' => true]);

        // 1. SPK Buku Terbaik (SAW Method equivalent)
        // W1 (Rating) = 0.35, W2 (Popularity/Borrow Count) = 0.45, W3 (Stock) = 0.20
        $books = Book::withAvg('ratings', 'rating')->get();
        $maxBorrowCount = $books->max('borrow_count') ?: 1;
        $maxStock = $books->max('stock') ?: 1;

        $spkBooks = $books->map(function ($book) use ($maxBorrowCount, $maxStock) {
            $avgRating = $book->ratings_avg_rating ?? 0;
            // Normalize rating to scale 0-1
            $normRating = $avgRating / 5;
            $normBorrow = $book->borrow_count / $maxBorrowCount;
            $normStock = $book->stock / $maxStock;

            $book->spk_score = ($normRating * 0.35) + ($normBorrow * 0.45) + ($normStock * 0.20);
            return $book;
        })->sortByDesc('spk_score')->take(5);

        $data = [
            'spkBooks' => $spkBooks,
        ];

        if ($user->role === 'admin' || $user->role === 'superadmin') {
            // Trend Calculations (Both see this as it's monitoring)
            $data['trends'] = [
                'books' => Book::where('created_at', '>=', now()->subDay())->count(),
                'users' => User::where('role', 'siswa')->where('created_at', '>=', now()->subWeek())->count(),
                'loans' => Loan::where('status', 'borrowed')->where('created_at', '>=', now()->subDay())->count(),
            ];

            // Smart Insights (Focus for Pengurus & Monitoring for SA)
            $busiestDay = Loan::select(DB::raw('DAYNAME(loan_date) as day'), DB::raw('count(*) as count'))
                ->groupBy(DB::raw('DAYNAME(loan_date)'))->orderBy('count', 'desc')->first();
            $data['smartInsights']['busiestDay'] = $busiestDay ? $busiestDay->day : 'N/A';

            $topCategory = \App\Models\Category::withCount('books')->get()->sortByDesc(function ($cat) {
                return $cat->books->sum('borrow_count');
            })->first();
            $data['smartInsights']['topGenre'] = $topCategory ? $topCategory->name : 'N/A';

            $mostLateUser = User::where('role', 'siswa')
                ->withCount([
                    'loans' => function ($q) {
                        $q->where('is_late', true)
                            ->orWhere(function ($sq) {
                                $sq->where('status', 'borrowed')
                                    ->where('expected_return_date', '<', now());
                            });
                    }
                ])->orderBy('loans_count', 'desc')->first();
            $data['smartInsights']['mostLateUser'] = ($mostLateUser && $mostLateUser->loans_count > 0) ? $mostLateUser->name : 'N/A';

            // Chart Data
            $data['weeklyLoanData'] = Loan::select(DB::raw('DATE(loan_date) as date'), DB::raw('count(*) as count'))
                ->where('loan_date', '>=', now()->subDays(7))
                ->groupBy(DB::raw('DATE(loan_date)'))->orderBy('date', 'asc')->get();

            // Data Bulanan (Januari - Desember) untuk tahun berjalan
            $data['monthlyLoanData'] = Loan::select(
                DB::raw('MONTH(loan_date) as month'),
                DB::raw('count(*) as count')
            )
            ->whereYear('loan_date', date('Y'))
            ->groupBy(DB::raw('MONTH(loan_date)'))
            ->orderBy('month', 'asc')
            ->get()
            ->pluck('count', 'month')
            ->toArray();
            
            // Pastikan semua bulan (1-12) ada datanya (isi 0 jika kosong)
            $fullYearData = [];
            $monthNames = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            for ($m = 1; $m <= 12; $m++) {
                $fullYearData[] = [
                    'month' => $monthNames[$m],
                    'count' => $data['monthlyLoanData'][$m] ?? 0
                ];
            }
            $data['monthlyLoanData'] = $fullYearData;

            // Operational Details (Only for Pengurus)
            if ($user->role === 'admin') {
                $data['activeUsers'] = User::where('role', 'siswa')
                    ->withCount('loans')
                    ->orderBy('loans_count', 'desc')
                    ->take(5)
                    ->get();

                $data['lateUsers'] = User::where('role', 'siswa')->get()->map(function ($u) {
                    $totalLoans = $u->loans()->count();
                    $historicalLate = $u->loans()->where('is_late', true)->count();
                    $currentOverdue = $u->loans()->where('status', 'borrowed')
                        ->where('expected_return_date', '<', now())
                        ->count();

                    if ($currentOverdue > 0) {
                        $u->late_probability = 100 + ($historicalLate * 5);
                    } else {
                        $u->late_probability = $totalLoans > 0 ? ($historicalLate / $totalLoans) * 100 : 0;
                    }

                    return $u;
                })->filter(fn($u) => $u->late_probability > 0)->sortByDesc('late_probability')->take(5);

                $data['popularBooks'] = Book::orderBy('borrow_count', 'desc')->take(5)->get();
            }

            $data['settings'] = \App\Models\Setting::all()->pluck('value', 'key');
        } else {
            // Recommendation for Siswa
            $favoriteCategoryId = DB::table('loans')
                ->join('books', 'loans.book_id', '=', 'books.id')
                ->where('loans.user_id', $user->id)
                ->select('books.category_id', DB::raw('COUNT(*) as count'))
                ->groupBy('books.category_id')
                ->orderBy('count', 'desc')
                ->first()?->category_id;

            $seed = date('Ymd'); // Seed untuk random harian

            $query = Book::query();

            if ($favoriteCategoryId) {
                $query->orderByRaw("category_id = ? DESC", [$favoriteCategoryId]);
            }

            $data['recommendedBooks'] = $query->orderByRaw("RAND($seed)")->take(5)->get();

            // Rak Buku Digital (Aktif)
            $rakBuku = Loan::with('book')
                ->where('user_id', $user->id)
                ->where('status', 'borrowed')
                ->get();
            $data['rakBuku'] = $rakBuku;

            // Booking Aktif (Reservasi)
            // Lazy Cleanup: Batalkan booking yang sudah lewat 24 jam
            $expiredBookings = Loan::with('book')
                ->where('status', 'booked')
                ->where('loan_date', '<', now()->subHours(24))
                ->get();

            foreach ($expiredBookings as $eb) {
                if ($eb->book) {
                    $eb->update(['status' => 'cancelled']);
                    $eb->book->increment('stock');
                }
            }

            $data['bookings'] = Loan::with('book')
                ->where('user_id', $user->id)
                ->where('status', 'booked')
                ->get();

            $data['pendingRequests'] = Loan::with('book')
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->get();

            $data['waitlists'] = \App\Models\Waitlist::with('book')
                ->where('user_id', $user->id)
                ->where('status', 'waiting')
                ->get();
        }

        if ($user->role === 'admin') {
            $data['globalPendingRequests'] = Loan::with(['user', 'book'])
                ->where('status', 'pending')
                ->latest()
                ->get();
        }

        return view('dashboard', $data);
    }

    public function timeline()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return $this->adminTimeline();
        }

        $followingIds = $user->following()->pluck('users.id')->toArray();
        $followingIds[] = $user->id; // Tambahkan diri sendiri

        $feed = \App\Models\Activity::with(['user', 'likes', 'comments'])
            ->withCount(['likes', 'comments'])
            ->whereIn('user_id', $followingIds)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $stats = null;
        $notifications = null;

        return view('timeline', compact('feed', 'stats', 'notifications'));
    }

    public function adminTimeline()
    {
        // 1. Hitung Statistik Monitoring
        $stats = [
            'total_books' => Book::count(),
            'total_borrowed' => Loan::where('status', 'borrowed')->count(),
            'total_late' => Loan::where('status', 'borrowed')
                ->where('expected_return_date', '<', now())
                ->count(),
            'active_students' => Loan::where('status', 'borrowed')
                ->distinct('user_id')
                ->count('user_id'),
        ];

        // 2. Notifikasi Penting (Terlambat & Stok Habis)
        $notifications = [
            'late_loans' => Loan::with(['user', 'book'])
                ->where('status', 'borrowed')
                ->where('expected_return_date', '<', now())
                ->take(5)->get(),
            'low_stock' => Book::where('stock', 0)->take(5)->get(),
        ];

        // 3. Feed Monitoring (Pinjam, Kembali, Ulasan, Buku Baru)
        $feed = \App\Models\Activity::whereIn('type', ['borrowed', 'returned', 'reviewed', 'book_added'])
            ->with(['user', 'likes', 'comments.user'])
            ->withCount(['likes', 'comments'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('timeline', compact('feed', 'stats', 'notifications'));
    }

    public function updateSettings(Request $request)
    {
        if (!Auth::user()->isSuperAdmin()) {
            return back()->with('error', 'Akses ditolak.');
        }

        foreach ($request->except('_token') as $key => $value) {
            \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }
}

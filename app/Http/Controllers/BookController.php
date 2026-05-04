<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('publisher', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->orderBy('borrow_count', 'desc')->get();
        $categories = Category::all();
        
        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'shelf_id' => 'nullable|exists:shelves,id',
            'barcode' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:51200',
            'cover_file' => 'nullable|image|max:5120',
        ]);

        // Handle PDF upload
        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            $pdfName = time() . '_' . str_replace(' ', '_', $pdf->getClientOriginalName());
            $pdf->move(public_path('ebooks'), $pdfName);
            $validated['file_path'] = 'ebooks/' . $pdfName;
        }

        // Handle Cover upload
        if ($request->hasFile('cover_file')) {
            $cover = $request->file('cover_file');
            $coverName = time() . '_' . str_replace(' ', '_', $cover->getClientOriginalName());
            $cover->move(public_path('covers'), $coverName);
            $validated['cover_image'] = 'covers/' . $coverName;
        }

        $book = Book::create($validated);

        // Rekam Aktivitas monitoring (Admin added book)
        \App\Models\Activity::create([
            'user_id' => auth()->id(),
            'type' => 'book_added',
            'details' => [
                'book_id' => $book->id,
                'title' => $book->title,
                'cover_image' => $book->cover_image
            ]
        ]);

        return redirect()->route('buku.index')->with('success', 'e-Book berhasil ditambahkan ke koleksi.');
    }

    public function show(Book $book)
    {
        $book->load('category', 'ratings.user');
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'shelf_id' => 'nullable|exists:shelves,id',
            'barcode' => 'nullable|string',
            'synopsis' => 'nullable|string',
            'pdf_file' => 'nullable|file|mimes:pdf|max:51200',
            'cover_file' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('pdf_file')) {
            $pdf = $request->file('pdf_file');
            $pdfName = time() . '_' . str_replace(' ', '_', $pdf->getClientOriginalName());
            $pdf->move(public_path('ebooks'), $pdfName);
            $validated['file_path'] = 'ebooks/' . $pdfName;
        }

        if ($request->hasFile('cover_file')) {
            $cover = $request->file('cover_file');
            $coverName = time() . '_' . str_replace(' ', '_', $cover->getClientOriginalName());
            $cover->move(public_path('covers'), $coverName);
            $validated['cover_image'] = 'covers/' . $coverName;
        }

        $oldStock = $book->stock;
        $book->update($validated);

        if ($validated['stock'] > $oldStock) {
            $this->handleWaitlistOnRestock($book, $validated['stock'] - $oldStock);
        }

        return redirect()->route('buku.show', $book->id)->with('success', 'e-Book berhasil diperbarui.');
    }

    public function updateStock(Request $request, Book $book)
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0',
        ]);

        $oldStock = $book->stock;
        $newStock = $validated['stock'];

        $book->update(['stock' => $newStock]);

        if ($newStock > $oldStock) {
            $this->handleWaitlistOnRestock($book, $newStock - $oldStock);
        }

        // Rekam aktivitas opsional (Admin updated stock)
        \App\Models\Activity::create([
            'user_id' => auth()->id(),
            'type' => 'book_added', // Reusing an existing type for simplicity or creating a new detail block
            'details' => [
                'book_id' => $book->id,
                'title' => "Stok: " . $book->title,
                'cover_image' => $book->cover_image ?? null
            ]
        ]);

        return redirect()->route('buku.show', $book->id)->with('success', 'Stok buku berhasil diperbarui ke ' . $validated['stock'] . ' eksemplar.');
    }

    private function handleWaitlistOnRestock(Book $book, int $diff)
    {
        if ($diff <= 0)
            return;

        $waitlistsToFulfill = \App\Models\Waitlist::where('book_id', $book->id)
            ->where('status', 'waiting')
            ->orderBy('created_at', 'asc')
            ->take($diff)
            ->get();

        foreach ($waitlistsToFulfill as $nextInLine) {
            $nextInLine->update(['status' => 'assigned']);

            \App\Models\Loan::create([
                'user_id' => $nextInLine->user_id,
                'book_id' => $book->id,
                'loan_date' => now()->toDateString(),
                'expected_return_date' => now()->addDays((int) \App\Models\Setting::getValue('loan_duration', 7))->toDateString(),
                'status' => 'booked'
            ]);
            $book->decrement('stock');
        }
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('buku.index')->with('success', 'e-Book berhasil dihapus dari koleksi.');
    }

    public function read(Book $book)
    {
        // Akses baca dibebaskan (tidak perlu pinjam fisik dulu)
        $book->load('category');
        return view('books.read', compact('book'));
    }

    /* ─── Rating ─── */
    public function storeRating(Request $request, Book $book)
    {
        $user = auth()->user();

        // Hanya siswa yang sudah/pernah meminjam boleh rating
        $hasBorrowed = \App\Models\Loan::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->exists();

        if (!$hasBorrowed) {
            return back()->with('error', 'Anda harus meminjam buku ini terlebih dahulu untuk memberikan ulasan.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        \App\Models\Rating::updateOrCreate(
            ['user_id' => $user->id, 'book_id' => $book->id],
            ['rating' => $request->rating, 'review' => $request->review]
        );

        // Catat ke aktivitas (hanya jika belum ada review activity untuk buku ini)
        \App\Models\Activity::updateOrCreate(
            [
                'user_id' => $user->id,
                'type' => 'reviewed',
                'details->book_id' => $book->id
            ],
            [
                'details' => [
                    'book_id' => $book->id,
                    'title' => $book->title,
                    'rating' => $request->rating,
                    'text' => $request->review,
                    'cover_image' => $book->cover_image ?? null,
                ]
            ]
        );

        return back()->with('success', 'Ulasan berhasil disimpan! Terima kasih.');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('book.category', 'book.ratings')
            ->latest()
            ->paginate(12);

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Book $book)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Buku telah dihapus dari favorit.');
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id
            ]);
            return back()->with('success', 'Buku berhasil ditambahkan ke favorit!');
        }
    }
}

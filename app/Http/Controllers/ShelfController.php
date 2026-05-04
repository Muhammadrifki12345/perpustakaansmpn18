<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shelf;

class ShelfController extends Controller
{
    public function index()
    {
        $shelves = Shelf::withCount('books')->latest()->get();
        return view('admin.shelves.index', compact('shelves'));
    }

    public function create()
    {
        return view('admin.shelves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:shelves,name',
            'location_code' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);
        Shelf::create($request->only('name', 'location_code', 'description'));
        return redirect()->route('rak.index')->with('success', 'Rak buku berhasil ditambahkan.');
    }

    public function edit(Shelf $rak)
    {
        return view('admin.shelves.edit', compact('rak'));
    }

    public function update(Request $request, Shelf $rak)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:shelves,name,' . $rak->id,
            'location_code' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);
        $rak->update($request->only('name', 'location_code', 'description'));
        return redirect()->route('rak.index')->with('success', 'Rak buku berhasil diperbarui.');
    }

    public function destroy(Shelf $rak)
    {
        $rak->delete();
        return redirect()->route('rak.index')->with('success', 'Rak buku berhasil dihapus.');
    }
}

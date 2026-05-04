<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publisher::latest()->get();
        return view('admin.publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('admin.publishers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:200|unique:publishers,name',
            'address' => 'nullable|string|max:500',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:100',
        ]);
        Publisher::create($request->only('name', 'address', 'phone', 'email'));
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil ditambahkan.');
    }

    public function edit(Publisher $penerbit)
    {
        return view('admin.publishers.edit', compact('penerbit'));
    }

    public function update(Request $request, Publisher $penerbit)
    {
        $request->validate([
            'name'    => 'required|string|max:200|unique:publishers,name,' . $penerbit->id,
            'address' => 'nullable|string|max:500',
            'phone'   => 'nullable|string|max:20',
            'email'   => 'nullable|email|max:100',
        ]);
        $penerbit->update($request->only('name', 'address', 'phone', 'email'));
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil diperbarui.');
    }

    public function destroy(Publisher $penerbit)
    {
        $penerbit->delete();
        return redirect()->route('penerbit.index')->with('success', 'Penerbit berhasil dihapus.');
    }
}

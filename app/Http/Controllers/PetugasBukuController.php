<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class PetugasBukuController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'katagori' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_url' => 'required|url',
            'deskripsi' => 'nullable|string',
        ]);

        Book::create($validated);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'katagori' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_url' => 'required|url',
            'deskripsi' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $book->update($validated);

        return redirect()->back()->with('success', 'Buku berhasil diperbarui!');
    }
}

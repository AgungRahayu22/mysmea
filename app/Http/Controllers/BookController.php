<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('home', compact('books'));
    }
    public function adminIndex()
    {
        $books = Book::all();
        return view('admin.databuku', compact('books')); // Return ke halaman admin
    }
    public function user()
    {
        $books = Book::all();
        return view('user.pinjam', compact('books')); // Return ke halaman user
    }
    public function petugas()
    {
        $books = Book::all(); // Ambil semua data buku dari database
       return view('petugas.dabuk', compact('books'));
     // Kirim variabel $books ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'katagori' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_url' => 'required|url',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.databuku')->with('success', 'Buku berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.databuku', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
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
        $book->update($request->all());

        return redirect()->route('admin.databuku')->with('success', 'Buku berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.databuku')->with('success', 'Buku berhasil dihapus.');
    }
    public function showPeminjaman()
    {
        $peminjaman = PeminjamanBuku::with('book', 'user')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }




}

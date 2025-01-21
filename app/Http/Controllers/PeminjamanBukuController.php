<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanBukuController extends Controller
{
   public function store(Request $request, $bookId)
    {
        $book = Book::findOrFail($bookId); // Mencari buku berdasarkan ID yang dikirimkan
        if ($book->jumlah <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia.');
        }

        PeminjamanBuku::create([
            'book_id' => $bookId,
            'user_id' => Auth::id(),
            'tanggal_pinjam' => now(),
        ]);

        $book->decrement('jumlah'); // Kurangi jumlah buku yang tersedia

        return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
    }


}

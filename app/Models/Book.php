<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'katagori',
        'tahun',
        'jumlah',
        'image_url',
        'pdf_url',
        'deskripsi',
    ];

    // Menyambungkan ke relasi PeminjamanBuku
    public function peminjamanBukus()
    {
        return $this->hasMany(PeminjamanBuku::class);
    }

    public function showPdf($id)
    {
        $book = Book::findOrFail($id);

        return redirect($book->pdf_url); // Redirect ke URL PDF
    }
    public function peminjamanBuku()
    {
        return $this->hasMany(PeminjamanBuku::class, 'book_id');
    }

}

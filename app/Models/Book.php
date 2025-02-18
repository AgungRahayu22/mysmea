<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit_id', // Disesuaikan dengan relasi
        'kategori_id', // Disesuaikan dengan relasi
        'tahun',
        'jumlah',
        'image_url',
        'pdf_path',
        'deskripsi',
    ];

    // Relasi ke PeminjamanBuku
    public function peminjamanBukus()
    {
        return $this->hasMany(PeminjamanBuku::class, 'book_id');
    }

    // Relasi ke Rating
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
     public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    // Relasi ke Kategori
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }
    public function kategori()
    {
        return $this->belongsTo(BukuKategori::class, 'kategori_id');
    }

    // Relasi ke Penerbit

}

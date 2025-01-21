<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];


    // Relasi ke model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


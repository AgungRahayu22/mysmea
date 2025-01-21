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
    ];

    // Relasi dengan model Book
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

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

    // Menambahkan properti $dates untuk memastikan kolom tanggal menjadi objek Carbon
    protected $dates = [
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    // Relasi ke tabel buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


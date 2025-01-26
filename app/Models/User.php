<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'telepon',
        'jenis',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Menyambungkan ke relasi PeminjamanBuku
    public function peminjamanBukus()
    {
        return $this->hasMany(PeminjamanBuku::class);
    }
    public function peminjamanBuku()
    {
        return $this->hasMany(PeminjamanBuku::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


}

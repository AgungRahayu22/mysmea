<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pinjam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pinjams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'buku_id',
        'tgl_pinjam',
        'tgl_kembali',
        'status'
    ];
        public function user():BelongsTo{
            return $this->belongsTo(User::class);
        }
        public function buku():BelongsTo{
            return $this->belongsTo(Buku::class);
        }
}

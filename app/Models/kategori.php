<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategoris';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
        'deskripsi',
    ];
}

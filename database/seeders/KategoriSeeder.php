<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        Kategori::create(['nama' => 'Novel']);
        Kategori::create(['nama' => 'Legenda']);
    }
}
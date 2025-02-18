<?php

namespace App\Http\Controllers;
use App\Models\Favorit;
use Illuminate\Http\Request;
use App\Models\Book;

class PenggunaController extends Controller
{
     public function index()
    {
        return view('user.pinjam');
    }

    public function ulasan()
    {
        return view('user.ulasan');
    }
    public function koleksi()
    {
        return view('user.koleksi');
    }
        public function favorit()
    {
        return view('user.favorit');
    }
    
}

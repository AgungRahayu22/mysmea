<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}

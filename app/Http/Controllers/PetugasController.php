<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.dabuk');
    }
        public function daper()
    {
        return view('petugas.daper');
    }
        public function laporan()
    {
        return view('petugas.laporan');
    }
    public function penerbit()
    {
        return view('petugas.penerbit');
    }
    public function kategori()
    {
        return view('petugas.kategori');
    }
}

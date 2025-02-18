<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function kelola()
    {
        return view('admin.kelola');
    }
     public function Databuku()
    {
        return view('admin.databuku');
    }
     public function penerbit()
    {
        return view('admin.penerbit');
    }
     public function peminjamanbuku()
    {
        return view('admin.peminjamanbuku');
    }
     public function ulasanbuku()
    {
        return view('admin.ulasanbuku');
    }
     public function laporanbuku()
    {
        return view('admin.laporanbuku');
    }
    public function Katagoribuku()
    {
        return view('admin.katagori');
    }


}

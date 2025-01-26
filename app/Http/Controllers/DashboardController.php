<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\PeminjamanBuku;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total pengguna
        $totalPengguna = User::count();

        $totalBuku = Book::count();

        $totalPeminjaman = PeminjamanBuku::count();

        // Kirim data ke view
        return view('admin.dashboard', compact('totalPengguna', 'totalBuku', 'totalPeminjaman'));
    }
    public function kelola()
    {
         $users = User::all();

          return view('admin.kelola', compact('users'));
    }
}

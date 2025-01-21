<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total pengguna
        $totalPengguna = User::count();

        $totalBuku = Book::count();

        // Kirim data ke view
        return view('admin.dashboard', compact('totalPengguna', 'totalBuku'));
    }
    public function kelola()
    {
         $users = User::all();

          return view('admin.kelola', compact('users'));
    }
}

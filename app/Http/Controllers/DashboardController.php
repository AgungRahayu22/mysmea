<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count(); // Menghitung jumlah pengguna
        $totalBooks = 350; // Contoh data total buku
        $totalBorrowers = 75; // Contoh data total peminjam

        // Mengirimkan data ke view
        return view('dashboard', compact('totalUsers', 'totalBooks', 'totalBorrowers'));
    }
}

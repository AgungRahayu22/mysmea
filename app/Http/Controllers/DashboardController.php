<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\PeminjamanBuku;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total pengguna
        $totalPengguna = User::count();

        // Hitung total buku
        $totalBuku = Book::count();

        // Hitung total peminjaman
        $totalPeminjaman = PeminjamanBuku::count();

        // Ambil data peminjaman harian
        $dailyData = PeminjamanBuku::select(DB::raw('DATE(tanggal_pinjam) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Ambil data peminjaman mingguan
        $weeklyData = PeminjamanBuku::select(DB::raw('WEEK(tanggal_pinjam) as week'), DB::raw('count(*) as total'))
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Kirim data ke view
        return view('admin.dashboard', compact('totalPengguna', 'totalBuku', 'totalPeminjaman', 'dailyData', 'weeklyData'));
    }
    public function kelola()
    {
         $users = User::all();

          return view('admin.kelola', compact('users'));
    }

        public function kelolaSuper()
    {
         $users = User::all();

          return view('superadmin.index', compact('users'));
    }
}

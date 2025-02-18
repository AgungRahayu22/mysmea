<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\PeminjamanBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\LogActivity;

class PeminjamanBukuController extends Controller
{
    // Fungsi untuk menyimpan peminjaman buku
    public function store(Request $request, $bookId)
    {
        // Pastikan pengguna terautentikasi
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Mencari buku berdasarkan ID yang dikirimkan
        $book = Book::findOrFail($bookId);

        // Cek apakah jumlah buku cukup
        if ($book->jumlah <= 0) {
            return redirect()->back()->with('error', 'Buku tidak tersedia dan dipinjam.');
        }

        // Cek apakah pengguna sudah meminjam buku yang sama
        $existingLoan = PeminjamanBuku::where('book_id', $bookId)
            ->where('user_id', Auth::id())
            ->whereNull('tanggal_kembali') // Buku belum dikembalikan
            ->first();

        if ($existingLoan) {
            return redirect()->back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        // Menyimpan data peminjaman
        PeminjamanBuku::create([
            'book_id' => $bookId,
            'user_id' => Auth::id(),  // Mendapatkan user_id dari pengguna yang sedang login
            'nama_peminjam' => Auth::user()->name,  // Menambahkan nama peminjam
            'tanggal_pinjam' => now(),
        ]);

        // Kurangi jumlah buku yang tersedia
        $book->decrement('jumlah');

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
    }



    // Fungsi untuk menampilkan daftar peminjaman
    public function index()
    {
        // Mengambil semua peminjaman dengan relasi buku dan pengguna
        $peminjaman = PeminjamanBuku::with(['book', 'user'])->get();

        // Konversi tanggal_pinjam dan tanggal_kembali menjadi objek Carbon
       $peminjaman = $peminjaman->map(function ($item) {
            $item->tanggal_pinjam = Carbon::parse($item->tanggal_pinjam);
            $item->batas_waktu = $item->tanggal_pinjam->copy()->addDays(7); // Menambahkan batas waktu pengembalian

            if ($item->tanggal_kembali) {
                $item->tanggal_kembali = Carbon::parse($item->tanggal_kembali);
            }

            return $item;
        });

        // Kirim data peminjaman ke view
        return view('admin.peminjamanbuku', compact('peminjaman'));
    }
    public function returnBook($id)
    {
        // Cari data peminjaman berdasarkan ID
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Pastikan peminjaman ini milik pengguna yang sedang login
        if ($peminjaman->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki hak untuk mengembalikan buku ini.');
        }

        // Update tanggal kembali
        $peminjaman->update([
            'tanggal_kembali' => now(),
        ]);

        // Tambahkan kembali jumlah buku di tabel buku
        $book = $peminjaman->book;
        $book->increment('jumlah');

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);

        // Cek apakah pengguna sedang meminjam buku ini
        $peminjaman = PeminjamanBuku::where('book_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        // Menghitung jumlah buku yang sedang dipinjam oleh orang lain
        $totalDipinjam = PeminjamanBuku::where('book_id', $id)
            ->whereNull('tanggal_kembali')  // Buku yang belum dikembalikan
            ->count();

        // Menghitung jumlah buku yang tersedia
        $tersedia = $book->jumlah - $totalDipinjam;

        return view('user.pinjam', compact('book', 'peminjaman', 'tersedia', 'totalDipinjam'));
    }
    public function koleksi()
    {
        $userId = Auth::id(); // ID pengguna yang sedang login

        // Ambil buku yang dipinjam oleh pengguna
        $koleksi = PeminjamanBuku::with('book')
            ->where('user_id', $userId)
            ->get();

        return view('user.koleksi', compact('koleksi'));
    }
    public function destroy($id)
    {
        // Cari data peminjaman berdasarkan ID
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Tambahkan kembali jumlah buku di tabel buku
        $book = $peminjaman->book;
        $book->increment('jumlah');

        // Hapus data peminjaman
        $peminjaman->delete();

        // Kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Peminjaman berhasil dihapus dan stok buku telah dikembalikan.');
    }
    public function return($id)
    {
        // Cari data peminjaman berdasarkan ID
        $peminjaman = PeminjamanBuku::findOrFail($id);

        // Tambahkan kembali jumlah buku di tabel buku
        $book = $peminjaman->book;
        $book->increment('jumlah');

        // Update tanggal kembali
        $peminjaman->delete();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan dan stok telah diperbarui.');
    }

    public function Ulasan()
    {
        $userId = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $koleksi = PeminjamanBuku::with(['book', 'book.ratings']) // Mengambil data buku dan rating
            ->where('user_id', $userId)
            ->get();

        return view('user.ulasan', ['koleksi' => $koleksi]); // Mengirim data ke view
    }



}

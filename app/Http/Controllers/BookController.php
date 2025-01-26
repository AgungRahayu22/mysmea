<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('home', compact('books'));
    }
    public function adminIndex()
    {
        $books = Book::all();
        return view('admin.databuku', compact('books')); // Return ke halaman admin
    }
    public function user()
    {
        $books = Book::all();
        return view('user.pinjam', compact('books')); // Return ke halaman user
    }
    public function petugas()
    {
        $books = Book::all(); // Ambil semua data buku dari database
       return view('petugas.dabuk', compact('books'));
     // Kirim variabel $books ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'katagori' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_url' => 'required|url',
        ]);

        Book::create($request->all());

        return redirect()->route('admin.databuku')->with('success', 'Buku berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('admin.databuku', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'katagori' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_url' => 'required|url',
            'deskripsi' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $book->update($request->all());

        return redirect()->route('admin.databuku')->with('success', 'Buku berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.databuku')->with('success', 'Buku berhasil dihapus.');
    }
    public function showPeminjaman()
    {
        $peminjaman = PeminjamanBuku::with('book', 'user')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }


    public function storeRating(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:255',
        ]);

        Rating::create([
            'book_id' => $request->book_id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->back()->with('success', 'Rating berhasil dikirim!');
    }

    public function adminUlasan()
    {
        // Mengambil semua rating dan menghubungkannya dengan buku dan pengguna
        $ratings = Rating::with(['book', 'user'])->get();

        // Kirim data rating ke view admin
        return view('admin.ulasanbuku', compact('ratings'));
    }
    public function destroyRating($id)
    {
        // Cari rating berdasarkan ID
        $rating = Rating::findOrFail($id);

        // Hapus rating
        $rating->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Rating berhasil dihapus.');
    }

        public function userUlasan()
    {
        // Mengambil semua rating dan menghubungkannya dengan buku dan pengguna
        $ratings = Rating::with(['book', 'user'])->get();

        // Kirim data rating ke view admin
        return view('user.pinjam', compact('ratings'));
    }
    public function laporan()
    {
        // Daftar Buku Per Tahun Terbit
        $bukuPerTahun = Book::select('tahun', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        // Daftar Buku Per Kategori
        $bukuPerKatagori = Book::select('katagori', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('katagori')
            ->orderBy('katagori', 'asc')
            ->get();

        // Daftar Buku yang Paling Banyak Dipinjam
        $bukuPalingDipinjam = Book::withCount('peminjamanBukus')
            ->orderBy('peminjaman_bukus_count', 'desc')
            ->take(10)
            ->get();

        // Daftar User yang Paling Banyak Meminjam Buku
        $userPalingBanyakMeminjam = DB::table('peminjaman_bukus')
            ->join('users', 'peminjaman_bukus.user_id', '=', 'users.id')
            ->select('users.nama', DB::raw('COUNT(peminjaman_bukus.id) as jumlah_peminjaman'))
            ->groupBy('users.nama')
            ->orderBy('jumlah_peminjaman', 'desc')
            ->take(10)
            ->get();

        return view('admin.laporanbuku', compact(
            'bukuPerTahun',
            'bukuPerKatagori',
            'bukuPalingDipinjam',
            'userPalingBanyakMeminjam'
        ));
    }

    public function laporanpetugas()
    {
        // Daftar Buku Per Tahun Terbit
        $bukuPerTahun = Book::select('tahun', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        // Daftar Buku Per Kategori
        $bukuPerKatagori = Book::select('katagori', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('katagori')
            ->orderBy('katagori', 'asc')
            ->get();

        // Daftar Buku yang Paling Banyak Dipinjam
        $bukuPalingDipinjam = Book::withCount('peminjamanBukus')
            ->orderBy('peminjaman_bukus_count', 'desc')
            ->take(10)
            ->get();

        // Daftar User yang Paling Banyak Meminjam Buku
        $userPalingBanyakMeminjam = DB::table('peminjaman_bukus')
            ->join('users', 'peminjaman_bukus.user_id', '=', 'users.id')
            ->select('users.nama', DB::raw('COUNT(peminjaman_bukus.id) as jumlah_peminjaman'))
            ->groupBy('users.nama')
            ->orderBy('jumlah_peminjaman', 'desc')
            ->take(10)
            ->get();

        return view('petugas.laporan', compact(
            'bukuPerTahun',
            'bukuPerKatagori',
            'bukuPalingDipinjam',
            'userPalingBanyakMeminjam'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\PeminjamanBuku;
use App\Models\Penerbit;
use App\Models\BukuKategori;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Favorit;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['kategori', 'penerbit'])->get();
        return view('home', compact('books'));
    }
    public function adminIndex()
    {
        $books = Book::with(['kategori', 'penerbit'])->get();
        $categories = DB::table('buku_kategori')->pluck('nama_kategori', 'id');
        $penerbits = DB::table('penerbit')->pluck('nama_penerbit', 'id');
        $ratings = DB::table('ratings')->pluck('id');


        return view('admin.databuku', compact('books', 'categories', 'penerbits','ratings' ));
    }

    public function user()
    {

        $books = Book::with(['kategori', 'penerbit' ,'ratings.user'])->get();
        $categories = DB::table('buku_kategori')->pluck('nama_kategori', 'id');
        $penerbits = DB::table('penerbit')->pluck('nama_penerbit', 'id');
        $ratings = DB::table('ratings')->pluck('id');

        return view('user.pinjam', compact('books', 'categories', 'penerbits','ratings' ));
    }
    public function petugas()
    {
        $books = Book::with(['kategori', 'penerbit'])->get();
        $categories = DB::table('buku_kategori')->pluck('nama_kategori', 'id');
        $penerbits = DB::table('penerbit')->pluck('nama_penerbit', 'id');// Ambil semua data buku dari database
        return view('petugas.dabuk', compact('books','categories', 'penerbits'));
     // Kirim variabel $books ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit_id' => 'required|exists:penerbit,id',
            'kategori_id' => 'required|exists:buku_kategori,id',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_file' => 'required|mimes:pdf|max:10240', // Validasi file PDF
            'deskripsi' => 'nullable|string',
        ]);

        // Simpan file PDF
        $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');

        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit_id' => $request->penerbit_id,
            'kategori_id' => $request->kategori_id,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
            'image_url' => $request->image_url,
            'pdf_path' => $pdfPath, // Simpan path file PDF
            'deskripsi' => $request->deskripsi,
        ]);

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
            'penerbit_id' => 'required|exists:penerbit,id',
            'kategori_id' => 'required|exists:buku_kategori,id',
            'tahun' => 'required|integer',
            'jumlah' => 'required|integer',
            'image_url' => 'required|url',
            'pdf_file' => 'nullable|mimes:pdf|max:10240', // Optional file upload
            'deskripsi' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $updateData = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit_id' => $request->penerbit_id,
            'kategori_id' => $request->kategori_id,
            'tahun' => $request->tahun,
            'jumlah' => $request->jumlah,
            'image_url' => $request->image_url,
            'deskripsi' => $request->deskripsi,
        ];

        // Jika ada file PDF baru diunggah
        if ($request->hasFile('pdf_file')) {
            // Hapus file PDF lama jika ada
            if ($book->pdf_path) {
                Storage::disk('public')->delete($book->pdf_path);
            }

            // Simpan file PDF baru
            $updateData['pdf_path'] = $request->file('pdf_file')->store('pdfs', 'public');
        }

        $book->update($updateData);

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
            'review' => 'required|string|max:10000',
        ]);

        // Cek apakah user sudah pernah memberikan rating untuk buku ini
        $existingRating = Rating::where('user_id', auth()->id())
                            ->where('book_id', $request->book_id)
                            ->first();

        if ($existingRating) {
            return redirect()->back()->with('error', 'Anda sudah memberikan rating untuk buku ini!');
        }

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
        $userId = auth()->id();

        // Ambil buku yang sudah diberi ulasan oleh user
        $koleksi = Rating::where('user_id', $userId)
            ->with('book')
            ->get();

        return view('user.pinjam', compact('koleksi'));
    }
     public function userUlasandestroy($id)
    {
        $ulasan = Rating::find($id);

        if (!$ulasan) {
            return redirect()->back()->with('error', 'Ulasan tidak ditemukan.');
        }

        $ulasan->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }

    public function laporan()
    {
        // Daftar Buku Per Tahun Terbit
        $bukuPerTahun = Book::select('tahun', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('tahun')
            ->orderBy('tahun', 'asc')
            ->get();

        // Daftar Buku Per Kategori
        $bukuPerKategori = Book::select('kategori_id', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('kategori_id')
            ->orderBy('kategori_id', 'asc')
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
            'bukuPerKategori',
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
        $bukuPerKategori = Book::select('kategori_id', DB::raw('COUNT(*) as jumlah'))
            ->groupBy('kategori_id')
            ->orderBy('kategori_id', 'asc')
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
            'bukuPerKategori',
            'bukuPalingDipinjam',
            'userPalingBanyakMeminjam'
        ));
    }
    public function favorit()
    {
        $userId = auth()->id();
        $favorites = Favorit::where('user_id', $userId)
            ->with('book.kategori', 'book.penerbit')
            ->get();

        return view('user.favorit', compact('favorites'));
    }

    public function tambahFavorit($bookId)
    {
        $userId = auth()->id();

        // Cek apakah buku sudah ada di favorit
        $exists = Favorit::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Buku sudah ada di daftar favorit!');
        }

        // Tambahkan ke favorit
        Favorit::create([
            'user_id' => $userId,
            'book_id' => $bookId
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke favorit!');
    }

    public function hapusFavorit($bookId)
    {
        $userId = auth()->id();

        Favorit::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->delete();

        return redirect()->back()->with('success', 'Buku berhasil dihapus dari favorit!');
    }

}

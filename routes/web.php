<?php

use App\Livewire\LoginComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\RegisterComponent;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TambahAnggotaController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PetugasBukuController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Models\PeminjamanBuku;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SuperadminController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\SupertambahController;
use App\Http\Controllers\BukuKategoriController;
use App\Http\Controllers\PenerbitController;
use App\Models\Book;
use App\Models\Penerbit;
use Illuminate\Support\Facades\Storage;

// Tampilan awal (home) tanpa middleware auth
Route::get('/', function () {
    return view('home'); // Menampilkan halaman home
});
Route::get('/about', function () {
    return view('about');
})->name('about');

// Halaman dashboard yang membutuhkan autentikasi
Route::get('/dashboard', function () {
    return view('dashboard'); // Buat file dashboard.blade.php
})->middleware('auth')->name('dashboard');

Route::get('/register', RegisterComponent::class)->name('register');
// Halaman login menggunakan Livewire
Route::get('/login', LoginComponent::class)->name('login');

// Halaman logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::get('/petugas/dabuk', [PetugasController::class, 'index'])->name('petugas.dabuk')->middleware('auth');
Route::get('/user/pinjam', [UserController::class, 'index'])->name('user.pinjam')->middleware('auth');


Route::get('admin',function (){
    return view('admin.dashboard');
})->name('admin')->middleware('auth');

Route::get('/admin/kelola', [AdminController::class, 'kelola'])->name('admin.kelola');
Route::get('/admin/databuku', [AdminController::class, 'databuku'])->name('admin.databuku');
Route::get('/admin/peminjamanbuku', [AdminController::class, 'peminjamanbuku'])->name('admin.peminjamanbuku');
Route::get('/admin/ulasanbuku', [AdminController::class, 'ulasanbuku'])->name('admin.ulasanbuku');
Route::get('/admin/laporanbuku', [AdminController::class, 'laporanbuku'])->name('admin.laporanbuku');
Route::get('/admin/katagori', [AdminController::class, 'katagoribuku'])->name('admin.katagori');
Route::get('/admin/penerbit', [AdminController::class, 'penerbit'])->name('admin.penerbit');
Route::get('/admin/data', [AdminController::class, 'Data'])->name('admin.data');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::get('/admin/kelola', [TambahAnggotaController::class, 'index'])->name('admin.kelola');
Route::post('/admin/kelola/store', [TambahAnggotaController::class, 'store'])->name('admin.kelola.store');
Route::post('/admin/kelola/{id}', [TambahAnggotaController::class, 'update'])->name('admin.kelola.update');
Route::delete('/admin/kelola/{id}', [TambahAnggotaController::class, 'destroy'])->name('admin.kelola.destroy');

Route::get('/admin/databuku', [BookController::class, 'index'])->name('admin.databuku');
Route::post('/admin/databuku', [BookController::class, 'store'])->name('admin.databuku.store');
Route::put('/admin/databuku/{id}', [BookController::class, 'update'])->name('admin.databuku.update');
Route::delete('/admin/databuku/{id}', [BookController::class, 'destroy'])->name('admin.databuku.destroy');

Route::get('/', [BookController::class, 'index'])->name('home');
Route::get('/admin/books', [BookController::class, 'adminIndex'])->name('admin.databuku');

Route::get('/user/pinjam', [PenggunaController::class, 'index'])->name('user.pinjam');
Route::get('/user/ulasan', [PenggunaController::class, 'ulasan'])->name('user.ulasan');
Route::get('/user/favorit', [PenggunaController::class, 'favorit'])->name('user.favorit');
Route::get('/user/koleksi', [PenggunaController::class, 'koleksi'])->name('user.koleksi');
Route::get('/user/pinjam', [BookController::class, 'user'])->name('user.pinjam');  // Untuk tampilan buku
Route::post('/user/pinjam', [PeminjamanBukuController::class, 'store'])->name('user.pinjam');


Route::get('/petugas/daper', [PetugasController::class, 'daper'])->name('petugas.daper');
Route::get('/petugas/laporan', [PetugasController::class, 'laporan'])->name('petugas.laporan');
Route::get('/petugas/penerbit', [PetugasController::class, 'penerbit'])->name('petugas.penerbit');
Route::get('/petugas/kategori', [PetugasController::class, 'kategori'])->name('petugas.kategori');
Route::put('/petugas/databuku/{id}', [PetugasBukuController::class, 'update'])->name('petugas.databuku.update');
Route::delete('/petugas/databuku/{id}', [PetugasBukuController::class, 'destroy'])->name('petugas.databuku.destroy');


Route::get('/petugas/dabuk', [BookController::class, 'petugas'])->name('petugas.dabuk');
Route::post('/user/pinjam/{bookId?}', [PeminjamanBukuController::class, 'store'])->name('user.pinjam');

Route::get('/admin/peminjamanbuku', [PeminjamanBukuController::class, 'index'])->name('admin.peminjamanbuku');
Route::post('/store', [PetugasBukuController::class, 'store'])->name('petugas.databuku.store');
Route::get('/user/pinjam/{id}', [PeminjamanBukuController::class, 'show'])->name('user.pinjam.show');
Route::get('/koleksi', [PeminjamanBukuController::class, 'koleksi'])->name('user.koleksi');
Route::delete('/peminjaman/{id}', [PeminjamanBukuController::class, 'destroy'])->name('peminjaman.destroy');
Route::post('/peminjaman/{id}/return', [PeminjamanBukuController::class, 'return'])->name('peminjaman.return');
Route::post('/book/rating', [BookController::class, 'storeRating'])->name('book.rating');
Route::get('/user/ulasan', [PeminjamanBukuController::class, 'Ulasan'])->name('user.ulasan');
// web.php
Route::delete('/rating/{id}', [BookController::class, 'destroyRating'])->name('admin.deleteRating');
Route::get('/admin/ulasanbuku', [BookController::class, 'adminUlasan'])->name('admin.ulasanbuku');
Route::get('/admin/laporanbuku', [BookController::class, 'laporan'])->name('admin.laporanbuku');
Route::get('/petugas/laporan', [BookController::class, 'laporanpetugas'])->name('petugas.laporan');
Route::get('/cek-peminjaman-kadaluarsa', [PeminjamanBukuController::class, 'cekPeminjamanKadaluarsa']);
Route::delete('/ulasan/{id}', [BookController::class, 'userUlasandestroy'])->name('ulasan.destroy');




Route::get('/admin/katagori', [BukuKategoriController::class, 'index'])->name('admin.katagori');
Route::post('/admin/katagori', [BukuKategoriController::class, 'store'])->name('admin.katagori.store');
Route::get('/admin/katagori/{id}/edit', [BukuKategoriController::class, 'edit'])->name('admin.katagori.edit');
Route::put('/admin/katagori/{id}', [BukuKategoriController::class, 'update'])->name('admin.katagori.update');
Route::delete('/admin/katagori/{id}', [BukuKategoriController::class, 'destroy'])->name('admin.katagori.destroy');

Route::get('/penerbit', [PenerbitController::class, 'index'])->name('admin.penerbit');
Route::post('/penerbit', [PenerbitController::class, 'store'])->name('admin.penerbit.store');
Route::put('/penerbit/{id}', [PenerbitController::class, 'update'])->name('admin.penerbit.update');
Route::delete('/penerbit/{id}', [PenerbitController::class, 'destroy'])->name('admin.penerbit.destroy');

Route::get('/petugas/kategori', [BukuKategoriController::class, 'petugas'])->name('petugas.kategori');
Route::delete('/petugas/katagori/{id}', [BukuKategoriController::class, 'destroyPetugas'])->name('petugas.kategori.destroy');
Route::put('/petugas/katagori/{id}', [BukuKategoriController::class, 'updatePetugas'])->name('petugas.katagori.update');
Route::post('/petugas/kategori/store', [BukuKategoriController::class, 'storePetugas'])->name('petugas.kategori.store');

Route::get('/user/favorit', [BookController::class, 'favorit'])->name('user.favorit');
Route::post('/user/favorit/{book}', [BookController::class, 'tambahFavorit'])->name('user.tambah-favorit');
Route::delete('/user/favorit/{book}', [BookController::class, 'hapusFavorit'])->name('user.hapus-favorit');

Route::get('/baca-buku/{id}', function($id) {
    $book = \App\Models\Book::findOrFail($id);
    $pdfUrl = Storage::url($book->pdf_path);
    return view('books.read', compact('pdfUrl'));
})->name('baca.buku');

Route::get('/petugas/penerbit', [PenerbitController::class, 'penerbit'])->name('petugas.penerbit');
Route::post('/petugas/penerbit', [PenerbitController::class, 'storePenerbit'])->name('petugas.penerbit.store');
Route::put('/petugas/penerbit/{id}', [PenerbitController::class, 'updatePenerbit'])->name('petugas.penerbit.update');
Route::delete('/petugas/penerbit/{id}', [PenerbitController::class, 'destroyPenerbit'])->name('petugas.penerbit.destroy');

Route::get('/admin/export-database', [AdminController::class, 'exportDatabase'])->name('admin.export-database');
Route::get('/admin/backup/download/{filename}', [AdminController::class, 'downloadBackup'])
    ->name('admin.download-backup');
Route::post('/admin/import-database', [AdminController::class, 'importDatabase'])->name('admin.import-database');
Route::post('/admin/preview-import', [AdminController::class, 'previewImport'])->name('admin.preview-import');

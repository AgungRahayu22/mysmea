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

// Tampilan awal (home) tanpa middleware auth
Route::get('/', function () {
    return view('home'); // Menampilkan halaman home
});

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
Route::get('/user/koleksi', [PenggunaController::class, 'koleksi'])->name('user.koleksi');
Route::get('/user/pinjam', [BookController::class, 'user'])->name('user.pinjam');  // Untuk tampilan buku
Route::post('/user/pinjam', [PeminjamanBukuController::class, 'store'])->name('user.pinjam');


Route::get('/petugas/daper', [PetugasController::class, 'daper'])->name('petugas.daper');
Route::get('/petugas/laporan', [PetugasController::class, 'laporan'])->name('petugas.laporan');

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

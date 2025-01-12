<?php

use App\Livewire\LoginComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\RegisterComponent;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


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

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/petugas/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');


Route::get('admin',function (){
    return view('admin.dashboard');
})->name('admin')->middleware('auth');

Route::get('/admin/kelola', [AdminController::class, 'kelola'])->name('admin.kelola');
Route::get('/admin/databuku', [AdminController::class, 'databuku'])->name('admin.databuku');
Route::get('/admin/penerbit', [AdminController::class, 'penerbit'])->name('admin.penerbit');
Route::get('/admin/peminjamanbuku', [AdminController::class, 'peminjamanbuku'])->name('admin.peminjamanbuku');
Route::get('/admin/ulasanbuku', [AdminController::class, 'ulasanbuku'])->name('admin.ulasanbuku');
Route::get('/admin/laporanbuku', [AdminController::class, 'laporanbuku'])->name('admin.laporanbuku');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

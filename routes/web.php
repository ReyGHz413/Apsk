<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\KategoriController;

// 1. Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Guest Routes (Hanya untuk yang BELUM login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

// 3. Logout (Harus sudah login salah satu guard)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:admin,siswa');

// 4. Admin Routes (Middleware Ganda: Auth Admin + Prevent Back)
Route::prefix('admin')->middleware(['auth:admin', 'prevent-back'])->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Detail Aspirasi & Tanggapan
    Route::get('/detail/{id}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::post('/tanggapi/{id}', [AdminController::class, 'berikanTanggapan'])->name('admin.tanggapi');

    // CRUD Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
});

// 5. Siswa Routes (Middleware Ganda: Auth Siswa + Prevent Back)
Route::prefix('siswa')->middleware(['auth:siswa', 'prevent-back'])->group(function () {
    // Dashboard & Riwayat
    Route::get('/dashboard', [AspirasiController::class, 'siswaDashboard'])->name('siswa.dashboard');
    
    // Pengaduan Baru
    Route::get('/input', [AspirasiController::class, 'create'])->name('siswa.input');
    Route::post('/input', [AspirasiController::class, 'store'])->name('siswa.store');
    
    // Detail Aspirasi
    Route::get('/detail/{id}', [AspirasiController::class, 'detail'])->name('siswa.detail');
});
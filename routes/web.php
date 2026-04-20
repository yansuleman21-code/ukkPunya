<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\TanggapanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// --- Semua rute di bawah ini wajib Login ---
Route::middleware(['auth'])->group(function () {
    
    // ===== Rute Khusus ADMIN =====
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');

        // Rute Tanggapan
        Route::get('/tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
        Route::get('/tanggapan/{id}', [TanggapanController::class, 'show'])->name('tanggapan.show');
        Route::post('/tanggapan/{id}', [TanggapanController::class, 'store'])->name('tanggapan.store');

        // Rute Kategori (CRUD Lengkap)
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        // Rute Manajemen User (CRUD)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // ===== Rute Khusus SISWA =====
    Route::middleware(['role:siswa'])->prefix('siswa')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'siswaDashboard'])->name('siswa.dashboard');

        // Rute CRUD Aspirasi
        Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
        Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
        Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
        Route::get('/aspirasi/{id}/edit', [AspirasiController::class, 'edit'])->name('aspirasi.edit');
        Route::put('/aspirasi/{id}', [AspirasiController::class, 'update'])->name('aspirasi.update');
        Route::delete('/aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
    });
});

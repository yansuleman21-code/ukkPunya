<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\TanggapanController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Semua rute di bawah ini wajib Login ---
Route::middleware(['auth'])->group(function () {
    
    // Rute Dashboard
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/siswa/dashboard', [AuthController::class, 'siswaDashboard'])->name('siswa.dashboard');

    // Rute CRUD Aspirasi (Hanya Siswa)
    Route::get('/siswa/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/siswa/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/siswa/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/siswa/aspirasi/{id}/edit', [AspirasiController::class, 'edit'])->name('aspirasi.edit');
    Route::put('/siswa/aspirasi/{id}', [AspirasiController::class, 'update'])->name('aspirasi.update');
    Route::delete('/siswa/aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
    
    // Rute Tanggapan (Hanya Admin)
    Route::get('/admin/tanggapan', [TanggapanController::class, 'index'])->name('tanggapan.index');
    Route::get('/admin/tanggapan/{id}', [TanggapanController::class, 'show'])->name('tanggapan.show');
    Route::post('/admin/tanggapan/{id}', [TanggapanController::class, 'store'])->name('tanggapan.store');
    
});

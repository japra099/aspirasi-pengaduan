<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AspirasiFeedbackController;
use App\Http\Controllers\AdminAuthController;

// Halaman utama redirect ke form aspirasi
Route::get('/', function () {
    return redirect()->route('aspirasi.form');
});

// Route untuk Siswa
Route::prefix('siswa')->group(function () {
    Route::get('/form-aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.form');
    Route::post('/form-aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/daftar-aspirasi', [AspirasiController::class, 'show'])->name('aspirasi.daftar');
    Route::delete('/aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
});

// Route Auth Admin
Route::prefix('admin')->group(function () {
    Route::get('/login',    [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login',   [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::get('/register', [AdminAuthController::class, 'showRegister'])->name('admin.register');
    Route::post('/register',[AdminAuthController::class, 'register'])->name('admin.register.post');
    Route::post('/logout',  [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Route yang butuh login
    Route::middleware('auth')->group(function () {
        Route::get('/feedback',      [AspirasiFeedbackController::class, 'index'])->name('feedback.index');
        Route::put('/feedback/{id}', [AspirasiFeedbackController::class, 'update'])->name('feedback.update');
    });
});

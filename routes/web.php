<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\PenggunaLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('admin.login'));

// ---- Admin ----
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'form'])->name('login')->middleware('guest:web');
    Route::post('login', [AdminLoginController::class, 'login'])->middleware('guest:web');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:web')->group(function () {
        Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    });
});

// ---- User (pemilik kartu) ----
Route::prefix('user')->name('user.')->group(function () {
    Route::get('login', [PenggunaLoginController::class, 'form'])->name('login')->middleware('guest:pengguna');
    Route::post('login', [PenggunaLoginController::class, 'login'])->middleware('guest:pengguna');
    Route::post('logout', [PenggunaLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:pengguna')->group(function () {
        Route::view('dashboard', 'user.dashboard')->name('dashboard');
    });
});

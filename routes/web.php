<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPeminjamController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login.process');

Route::post('/register', [AuthController::class, 'registerProses'])->name("register");

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::get('/petugas', fn() => 'Dashboard Petugas');

    Route::prefix('peminjam')->name('peminjam.')->group(function () {
        Route::get('/', [DashboardPeminjamController::class, 'index'])->name('dashboard');
        Route::get('/data-pesanan', [DashboardPeminjamController::class, 'index'])->name('data-pesanan');
        
    });
});
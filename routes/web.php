<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPeminjamController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register (jika ada)
Route::post('/register', [AuthController::class, 'registerProses'])->name('register');

// GROUP ADMIN
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');
    Route::get('/alat-tersedia', [AlatController::class, 'index'])->name('alat-tersedia');
    Route::post('/alat-tersedia', [AlatController::class, 'store'])->name('alat.store');
    Route::get('/alat-tersedia/{id}/edit', [AlatController::class, 'edit'])->name('alat.edit');
    Route::put('/alat-tersedia/{id}', [AlatController::class, 'update'])->name('alat.update');
    Route::delete('/alat-tersedia/{id}', [AlatController::class, 'destroy'])->name('alat.destroy');

    Route::get('/data-pesanan', [PesananController::class, 'index'])->name('data-pesanan');
    Route::get('/data-user', [UserController::class, 'index'])->name('data-user');
    Route::post('/data-user/store', [UserController::class, 'store'])->name('data-user.store');
    Route::delete('/data-user/{id}', [UserController::class, 'destroy'])->name('data-user.destroy');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

// GROUP PEMINJAM
Route::middleware('auth')->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [DashboardPeminjamController::class, 'index'])->name('dashboard');
    Route::get('/alat-tersedia', [AlatController::class, 'alatTersedia'])->name('alat-tersedia');
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy'])->name('riwayat.hapus');
    // Jika ada cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});
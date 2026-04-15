<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPeminjamController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Peminjam\CartController as PeminjamCartController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register (if available)
Route::post('/register', [AuthController::class, 'registerProses'])->name('register');

// GROUP ADMIN
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard');
    
    // Alat
    Route::get('/alat-tersedia', [AlatController::class, 'index'])->name('alat-tersedia');
    Route::post('/alat-tersedia', [AlatController::class, 'store'])->name('alat.store');
    Route::get('/alat-tersedia/{id}/edit', [AlatController::class, 'edit'])->name('alat.edit');
    Route::put('/alat-tersedia/{id}', [AlatController::class, 'update'])->name('alat.update');
    Route::delete('/alat-tersedia/{id}', [AlatController::class, 'destroy'])->name('alat.destroy');

    // Pesanan
    Route::get('/data-pesanan', [PesananController::class, 'index'])->name('data-pesanan');

    // Pesanan
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    
    // User
    Route::get('/data-user', [UserController::class, 'index'])->name('data-user');
    Route::post('/data-user/store', [UserController::class, 'store'])->name('data-user.store');
    Route::delete('/data-user/{id}', [UserController::class, 'destroy'])->name('data-user.destroy');

    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    // Pinjam
    Route::post('/admin/peminjaman/{id}/approve', [AdminPeminjamanController::class, 'approve']);
    Route::post('/admin/peminjaman/{id}/reject', [AdminPeminjamanController::class, 'reject']);

});

// GROUP PEMINJAM
Route::middleware('auth')->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/', [DashboardPeminjamController::class, 'index'])->name('dashboard');
    
    // Hanya satu route untuk alat tersedia (gunakan method alatTersedia di AlatController)
    Route::get('/alat-tersedia', [AlatController::class, 'alatTersedia'])->name('alat-tersedia');
    
    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');
    Route::delete('/riwayat/{id}', [RiwayatController::class, 'destroy'])->name('riwayat.hapus');
    
    // Route tambah ke keranjang (nama final: peminjam.cart.add)
    Route::get('/cart', [CartController::class, 'index'])->name('peminjam.cart');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::post('/peminjam/checkout', [PeminjamController::class, 'checkout'])
    ->name('peminjam.checkout');

    Route::get('/payment/{id}', [PaymentController::class, 'payGateway'])->name('peminjam.payment');
    Route::post('/payment/{id}/pay', [PaymentController::class, 'pay'])->name('peminjam.pay');

    Route::get('/reset-cart', function () {
    session()->forget('cart');
    return "cart cleared";
});

});
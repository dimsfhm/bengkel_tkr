<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPeminjamController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login.process');

Route::post('/register', [AuthController::class, 'registerProses'])->name("register");

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard');

    // USERS
    Route::get('/users', [UserController::class, 'index'])->name('users.admin.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.admin.store');
    Route::get('/admin', [UserController::class, 'store'])->name('admin.user.store');

    Route::get("/data-pesanan",[PesananController::class, 'index'])->name("data-pesanan");
    Route::get("/alat-tersedia",[AlatController::class, 'index'])->name("alat-tersedia");
    Route::get("/data-user",[UserController::class, 'index'])->name("data-user");
});
    

    Route::prefix('peminjam')->name('peminjam.')->group(function () {
        Route::get('/', [DashboardPeminjamController::class, 'index'])->name('dashboard');
        Route::get('/data-pesanan', [DashboardPeminjamController::class, 'index'])->name('data-pesanan');
        
    });


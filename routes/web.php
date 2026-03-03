<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardPeminjamController;
use App\Http\Controllers\PesananController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login.process');

Route::post('/register', [AuthController::class, 'registerProses'])->name("register");

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function (){
        Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard');
        Route::get("/data-pesanan",[PesananController::class, 'index'])->name("data-pesanan");
        Route::get("/alat-tersedia",[AlatController::class, 'index'])->name("alat-tersedia");
    });
    

    Route::prefix('peminjam')->name('peminjam.')->group(function () {
        Route::get('/', [DashboardPeminjamController::class, 'index'])->name('dashboard');
        Route::get('/data-pesanan', [DashboardPeminjamController::class, 'index'])->name('data-pesanan');
        
    });
});
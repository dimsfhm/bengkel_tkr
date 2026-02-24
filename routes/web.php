<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('login.process');

Route::post('/register', [AuthController::class, 'registerProses'])->name("register");

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/admin', fn() => 'Dashboard Admin')->middleware('auth');
Route::get('/petugas', fn() => 'Dashboard Petugas')->middleware('auth');
Route::get('/peminjam', fn() => 'Dashboard Peminjam')->middleware('auth');
<?php

use App\Http\Controllers\AuthController;

Route::get('/login', function () {
    return view('auth.login-register');
})->name('login');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProses']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/admin', fn() => 'Dashboard Admin')->middleware('auth');
Route::get('/petugas', fn() => 'Dashboard Petugas')->middleware('auth');
Route::get('/peminjam', fn() => 'Dashboard Peminjam')->middleware('auth');
<?php

use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Auth;

if (!function_exists('logAktivitas')) {
    function logAktivitas($aksi, $deskripsi = null, $data = [])
{
    if (!Auth::check()) return;

    try {
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role,
            'aktivitas' => json_encode([
                'aksi' => $aksi,
                'deskripsi' => $deskripsi,
                'data' => $data
            ])
        ]);
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}
}
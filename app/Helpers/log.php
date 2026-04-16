?<?php

use App\Models\log_aktivitas;
use Illuminate\Support\Facades\Auth;

if (!function_exists('logAktivitas')) {
    function logAktivitas($aksi, $deskripsi = null, $data = [])
    {
        if (!Auth::check()) return;

        log_aktivitas::create([
            'user_id' => Auth::id(),
            'role' => Auth::user()->role,
            'aktivitas' => json_encode([
                'aksi' => $aksi,
                'deskripsi' => $deskripsi,
                'data' => $data
            ])
        ]);
    }
}
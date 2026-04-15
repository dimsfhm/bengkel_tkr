<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
   public function approve($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->status !== 'pending') {
        return back()->with('error', 'Tidak bisa diproses');
    }

    $peminjaman->update([
        'status' => 'disetujui',
        'petugas_id' => auth()->id()
    ]);

    return back()->with('success', 'Peminjaman disetujui');
}

public function reject($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    $peminjaman->update([
        'status' => 'ditolak',
        'petugas_id' => auth()->id()
    ]);

    return back()->with('success', 'Peminjaman ditolak');
}
}
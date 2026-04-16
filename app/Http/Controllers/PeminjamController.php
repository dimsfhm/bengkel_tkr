<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Alat;  
use Carbon\Carbon;

class PeminjamController extends Controller
{
    public function checkout(Request $request)
{
    try {

        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'lama_sewa' => 'required|integer|min:1',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($request->jumlah > $alat->jumlah_total) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);
        $tanggalJatuhTempo = $tanggalPinjam->copy()->addDays($request->lama_sewa);

        Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $request->alat_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
            'status' => 'pending',
        ]);

        $alat->decrement('jumlah_total', $request->jumlah);

        return redirect()->route('peminjam.alat-tersedia')
            ->with('success', 'Permintaan berhasil dikirim ke admin');

    } catch (\Exception $e) {
        return back()->with('error', $e->getMessage()); // 🔥 jangan dd lagi
    }
}

public function ajukanPengembalian($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->status != 'disetujui') {
        return back()->with('error', 'Belum bisa dikembalikan');
    }

    $peminjaman->update([
        'status_pengembalian' => 'diajukan',
        'tanggal_kembali' => now() // request waktu ajukan
    ]);

    return back()->with('success', 'Pengembalian diajukan');
}
}
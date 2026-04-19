<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Services\PeminjamanService;

class PeminjamController extends Controller
{
    protected $peminjamanService;

    public function __construct(PeminjamanService $peminjamanService)
    {
        $this->peminjamanService = $peminjamanService;
    }

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

            $this->peminjamanService->checkout($request->all(), $alat);

            return redirect()
                ->route('peminjam.alat-tersedia')
                ->with('success', 'Permintaan berhasil dikirim ke admin');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function ajukanPengembalian($id)
    {
        try {
            $peminjaman = Peminjaman::findOrFail($id);

            $this->peminjamanService->ajukanPengembalian($peminjaman);

            return back()->with('success', 'Pengembalian diajukan');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
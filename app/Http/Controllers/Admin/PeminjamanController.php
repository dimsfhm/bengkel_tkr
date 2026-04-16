<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PeminjamanController extends Controller
{
    // =====================
    // LIST PEMINJAMAN
    // =====================
    public function index()
    {
        $peminjaman = Peminjaman::with('user','alat')->get();
        return view('admin.data-pesanan', compact('peminjaman'));
    }

    // =====================
    // APPROVE PEMINJAMAN
    // =====================
    public function approve($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Sudah diproses');
        }

        // kurangi stok saat disetujui
        $peminjaman->alat->decrement('jumlah_total', $peminjaman->jumlah);

        $peminjaman->update([
            'status' => 'disetujui',
            'petugas_id' => Auth::id()
        ]);

        return back()->with('success', 'Peminjaman disetujui');
    }

    // =====================
    // REJECT PEMINJAMAN
    // =====================
    public function reject($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return back()->with('error', 'Sudah diproses');
        }

        $peminjaman->update([
            'status' => 'ditolak',
            'petugas_id' => Auth::id()
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

    // =====================
    // LIST PENGEMBALIAN
    // =====================
    public function pengembalian()
    {
        $data = Peminjaman::with('user','alat')
            ->where('status_pengembalian', 'belum')
            ->get();

        return view('admin.pengembalian', compact('data'));
    }

    // =====================
    // APPROVE PENGEMBALIAN
    // =====================
    public function approveReturn($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status_pengembalian !== 'belum') {
            return back()->with('error', 'Sudah diproses');
        }

        $peminjaman->update([
            'status_pengembalian' => 'dikembalikan',
            'status' => 'selesai',
            'tanggal_kembali' => now(),
            'petugas_id' => Auth::id(),
        ]);

        // balikin stok
        $peminjaman->alat->increment('jumlah_total', $peminjaman->jumlah);

        return back()->with('success', 'Pengembalian disetujui');
    }

    // =====================
    // REJECT PENGEMBALIAN
    // =====================
    public function rejectReturn($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status_pengembalian !== 'belum') {
            return back()->with('error', 'Sudah diproses');
        }

        $peminjaman->update([
            'status_pengembalian' => 'rusak',
            'petugas_id' => Auth::id(),
        ]);

        return back()->with('success', 'Pengembalian ditolak / rusak');
    }

    // =====================
    // EXPORT PDF
    // =====================
    public function exportPdf()
    {
        $data = Peminjaman::with('user','alat')->get();

        $pdf = Pdf::loadView('admin.laporan_pdf', compact('data'));

        return $pdf->download('laporan-peminjaman.pdf');
    }
}
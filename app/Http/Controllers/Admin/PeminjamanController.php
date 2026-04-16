<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\denda;
use App\Models\log_aktivitas;
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

        logAktivitas(
    'create_alat',
    'Menambahkan alat',
    [
        'nama' => $request->nama,
        'id_alat' => $alat->id
    ]
);
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
            ->where('status_pengembalian', 'diajukan')
            ->get();

        return view('admin.pengembalian', compact('data'));
    }

    // =====================
    // APPROVE PENGEMBALIAN
    // =====================
    public function approveReturn($id)
{
    $peminjaman = Peminjaman::with('alat')->findOrFail($id);

    if ($peminjaman->status_pengembalian !== 'diajukan') {
        return back()->with('error', 'Sudah diproses');
    }

    $tanggalKembali = now()->toDateString();
    $jatuhTempo = $peminjaman->tanggal_jatuh_tempo;

    // hitung telat berbasis tanggal
    $hariTerlambat = 0;
    if ($tanggalKembali > $jatuhTempo) {
        $hariTerlambat = Carbon::parse($jatuhTempo)
            ->diffInDays(Carbon::parse($tanggalKembali));
    }

    // denda
    $dendaPerHari = 10000;
    $jumlahDenda = $hariTerlambat * $dendaPerHari;

    $peminjaman->update([
        'status_pengembalian' => 'dikembalikan',
        'status' => 'selesai',
        'tanggal_kembali' => $tanggalKembali,
        'petugas_id' => Auth::id(),
        'denda_total' => $jumlahDenda
    ]);

    // simpan kalau ada denda
    if ($hariTerlambat > 0) {
        Denda::create([
            'peminjaman_id' => $peminjaman->id,
            'hari_terlambat' => $hariTerlambat,
            'jumlah_denda' => $jumlahDenda,
            'status' => 'unpaid'
        ]);
    }

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

        if ($peminjaman->status_pengembalian !== 'diajukan') {
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
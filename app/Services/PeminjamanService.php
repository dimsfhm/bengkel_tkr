<?php

namespace App\Services;

use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeminjamanService
{
    public function checkout(array $data, Alat $alat)
    {
        return DB::transaction(function () use ($data, $alat) {

            $tanggalPinjam = Carbon::parse($data['tanggal_pinjam']);
            $tanggalJatuhTempo = $tanggalPinjam->copy()->addDays($data['lama_sewa']);

            $peminjaman = Peminjaman::create([
                'user_id' => Auth::id(),
                'alat_id' => $data['alat_id'],
                'jumlah' => $data['jumlah'],
                'tanggal_pinjam' => $tanggalPinjam,
                'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
                'status' => 'pending',
            ]);

            $alat->decrement('jumlah_total', $data['jumlah']);

            logAktivitas('checkout', 'User melakukan peminjaman', [
                'alat_id' => $data['alat_id'],
                'jumlah' => $data['jumlah']
            ]);

            return $peminjaman;
        });
    }

    public function ajukanPengembalian(Peminjaman $peminjaman)
    {
        return DB::transaction(function () use ($peminjaman) {

            if ($peminjaman->status != 'disetujui') {
                throw new \Exception('Belum bisa dikembalikan');
            }

            $peminjaman->update([
                'status_pengembalian' => 'diajukan',
                'tanggal_kembali' => now()
            ]);

            logAktivitas('pengembalian', 'User mengajukan pengembalian', [
                'peminjaman_id' => $peminjaman->id
            ]);

            return $peminjaman;
        });
    }
}
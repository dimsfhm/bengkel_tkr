<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayats = [
            (object)[
                'id' => 1,
                'nama_produk' => 'Kunci Inggris',
                'status' => 'Done',
                'tipe' => 'Standart',
                'kode' => '9177',
                'harga' => 100000
            ],
            // tambahkan data lain kalau mau
        ];

        return view('peminjam.riwayat', compact('riwayats'));
    }

    public function destroy($id)
    {
        // logic hapus data
        return back()->with('success', 'Data berhasil dihapus');
    }
}

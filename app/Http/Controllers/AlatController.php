<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Menampilkan daftar alat (halaman admin.alat-tersedia)
     */
    public function index()
    {
        $alat = Alat::with('kategori')->latest()->paginate(10);
        $kategoris = Kategori::all();
        return view('admin.alat-tersedia', compact('alat', 'kategoris'));
    }

    /**
     * Menyimpan alat baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'   => 'required|exists:kategori,id',
            'nama_alat'     => 'required|string|max:255|unique:alat,nama_alat',
            'jumlah_total'  => 'required|integer|min:0',
            'kondisi_baik'  => 'required|integer|min:0',
            'kondisi_rusak' => 'required|integer|min:0',
        ]);

        // Opsional: pastikan kondisi_baik + kondisi_rusak <= jumlah_total
        if ($request->kondisi_baik + $request->kondisi_rusak > $request->jumlah_total) {
            return back()->withErrors([
                'jumlah_total' => 'Jumlah total harus lebih besar atau sama dengan jumlah kondisi baik + rusak.'
            ])->withInput();
        }

        Alat::create($request->only([
            'kategori_id', 'nama_alat', 'jumlah_total', 'kondisi_baik', 'kondisi_rusak'
        ]));

        return redirect()->route('admin.alat-tersedia')
                         ->with('success', 'Alat berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit alat
     */
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all(); // untuk dropdown pilihan kategori
        return view('admin.alat-edit', compact('alat', 'kategoris'));
    }

    /**
     * Memperbarui data alat yang sudah ada
     */
    public function update(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $request->validate([
            'kategori_id'   => 'required|exists:kategori,id',
            'nama_alat'     => 'required|string|max:255|unique:alat,nama_alat,' . $alat->id,
            'jumlah_total'  => 'required|integer|min:0',
            'kondisi_baik'  => 'required|integer|min:0',
            'kondisi_rusak' => 'required|integer|min:0',
        ]);

        // Validasi jumlah
        if ($request->kondisi_baik + $request->kondisi_rusak > $request->jumlah_total) {
            return back()->withErrors([
                'jumlah_total' => 'Jumlah total harus lebih besar atau sama dengan jumlah kondisi baik + rusak.'
            ])->withInput();
        }

        $alat->update($request->only([
            'kategori_id', 'nama_alat', 'jumlah_total', 'kondisi_baik', 'kondisi_rusak'
        ]));

        return redirect()->route('admin.alat-tersedia')
                         ->with('success', 'Alat berhasil diperbarui!');
    }

    /**
     * Menghapus alat dari database
     */
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('admin.alat-tersedia')
                         ->with('success', 'Alat berhasil dihapus!');
    }

public function alatTersedia()
{
    $alats = \App\Models\Alat::with('kategori')
                ->where('kondisi_baik', '>', 0)
                ->latest()
                ->paginate(8);
    return view('peminjam.alat-tersedia', compact('alats'));
}
}
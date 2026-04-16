<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'nama_alat' => 'required|string|max:255|unique:alats,nama_alat',
            'jumlah_total'  => 'required|integer|min:0',
            'harga'         => 'required|numeric|min:0',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['kategori_id', 'nama_alat', 'jumlah_total', 'harga','gambar']);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('alat', 'public');
            $data['gambar'] = $path;
        }

        Alat::create($data);

        return redirect()->route('admin.alat-tersedia')
                         ->with('success', 'Alat berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit alat (jika menggunakan view terpisah)
     * Bisa dihapus jika menggunakan modal
     */
    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();
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
            'nama_alat'     => 'required|string|max:255|unique:alats,nama_alat,' . $alat->id,
            'jumlah_total'  => 'required|integer|min:0',
            'harga'         => 'required|numeric|min:0',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->only(['kategori_id', 'nama_alat', 'jumlah_total', 'harga']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($alat->gambar && Storage::exists('public/' . $alat->gambar)) {
                Storage::delete('public/' . $alat->gambar);
            }
            $path = $request->file('gambar')->store('alat', 'public');
            $data['gambar'] = $path;
        }

        $alat->update($data);

        return redirect()->route('admin.alat-tersedia')
                         ->with('success', 'Alat berhasil diperbarui!');
    }

    /**
     * Menghapus alat dari database
     */
    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        // Hapus file gambar jika ada
        if ($alat->gambar && Storage::exists('public/' . $alat->gambar)) {
            Storage::delete('public/' . $alat->gambar);
        }
        $alat->delete();

        return redirect()->route('admin.alat-tersedia')
                         ->with('success', 'Alat berhasil dihapus!');
    }

    /**
     * Halaman alat tersedia untuk peminjam
     * (menampilkan alat yang memiliki stok > 0)
     */
    public function alatTersedia()
    {
        $alats = Alat::with('kategori')
                    ->where('jumlah_total', '>', 0)  // atau sesuai logika stok tersedia
                    ->latest()
                    ->paginate(8);
        return view('peminjam.alat-tersedia', compact('alats'));
    }
}
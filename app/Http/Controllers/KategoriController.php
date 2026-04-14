<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar kategori (index + form create)
     */
    public function index()
    {
        $kategoris = Kategori::latest()->paginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Simpan kategori baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori'
        ]);

        Kategori::create($request->only('nama_kategori'));

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit (bisa via modal atau halaman terpisah)
     */
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $kategori->id
        ]);

        $kategori->update($request->only('nama_kategori'));

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);

        // Cek apakah kategori masih dipakai di tabel alat
        if ($kategori->alat()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                             ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki data alat.');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
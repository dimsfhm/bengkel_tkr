<?php

    namespace App\Http\Controllers; 

    use Illuminate\Http\Request;
    use App\Models\Peminjaman;

    class RiwayatController extends Controller
    {
        public function index()
        {
            $peminjaman = Peminjaman::with('alat')->paginate(10);
            return view('peminjam.riwayat', compact('peminjaman'));
        }

        public function destroy($id)
        {
            // logic hapus data
            return back()->with('success', 'Data berhasil dihapus');
        }
    }

<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //tampilkan keranjang
    public function index()
    {
        $cart = Session()->get('cart', []);
        return view('peminjam.cart', compact('cart'));
    }

    //hapus item
    public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            }
        Session::put('cart', $cart);
        return back()->with('success', 'Item dihapus');
    }

    //add ke keranjang
    public function add($id)
{
    $alat = \App\Models\Alat::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        // tambah quantity
        if ($cart[$id]['quantity'] + 1 > $alat->kondisi_baik) {
            return back()->with('error', 'Melebihi stok');
        }

        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            'nama' => $alat->nama_alat,
            'harga' => $alat->harga,
            'gambar' => $alat->gambar,
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    return redirect()->route('peminjam.cart')->with('success', 'Masuk ke keranjang');
}

}

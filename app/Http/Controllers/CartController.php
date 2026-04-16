<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // tampilkan cart
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('peminjam.cart', compact('cart'));
    }

    // tambah ke cart
    public function add(Request $request, $id)
    {
        $alat = Alat::findOrFail($id);

        $qty = $request->jumlah ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {

            if ($cart[$id]['quantity'] + $qty > $alat->jumlah_total) {
                return back()->with('error', 'Melebihi stok');
            }

            $cart[$id]['quantity'] += $qty;

        } else {

            if ($qty > $alat->jumlah_total) {
                return back()->with('error', 'Melebihi stok');
            }

            $cart[$id] = [
                'nama' => $alat->nama_alat,
                'harga' => $alat->harga,
                'gambar' => $alat->gambar,
                'quantity' => $qty,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('peminjam.cart')
            ->with('success', 'Masuk ke keranjang');
    }

    // hapus item
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Item dihapus');
    }

    // update qty (+ / -)
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $alat = Alat::findOrFail($id);

        if (!isset($cart[$id])) {
            return back();
        }

        $action = $request->action;

        if ($action == 'plus') {
            if ($cart[$id]['quantity'] < $alat->jumlah_total) {
                $cart[$id]['quantity']++;
            }
        }

        if ($action == 'minus') {
            $cart[$id]['quantity']--;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return back();
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Peminjaman;
use App\Models\detail_peminjaman;
use Illuminate\Support\Facades\DB;

class PeminjamController extends Controller
{
        public function checkout()
{
    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return back()->with('error', 'Keranjang kosong');
    }

    DB::beginTransaction();

    try {

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['harga'] * $item['quantity'];
        }

        $peminjaman = Peminjaman::create([
            'user_id' => auth()->id(),
            'tanggal_pinjam' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(3), // default
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'total' => $total
        ]);

        foreach ($cart as $id => $item) {
            $peminjaman->detail()->create([
                'alat_id' => $id,
                'qty' => $item['quantity'],
                'harga' => $item['harga'],
                'subtotal' => $item['harga'] * $item['quantity']
            ]);
        }

        session()->forget('cart');

        DB::commit();

        return redirect()->route('peminjam.payment', $peminjaman->id);

    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', $e->getMessage());
    }
}
}
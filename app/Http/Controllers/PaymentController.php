<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    return view('peminjam.payment', compact('peminjaman'));
}   

public function pay(Request $request, $id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->payment_status !== 'unpaid') {
        return back()->with('error', 'Sudah diproses');
    }

    // simulasi cash / gateway
    $metode = $request->metode ?? 'cash';

    $peminjaman->update([
        'payment_status' => 'paid'
    ]);

    $peminjaman->pembayaran()->create([
        'metode' => $metode,
        'jumlah' => $peminjaman->total,
        'status' => 'success',
        'paid_at' => now()
    ]);

    return redirect()->route('peminjam.detail', $id)
        ->with('success', 'Pembayaran berhasil');
}

public function __construct()
{
    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = config('midtrans.is_production');
    Config::$isSanitized = true;
    Config::$is3ds = true;
}

public function payGateway($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->payment_status !== 'unpaid') {
        return back()->with('error', 'Sudah diproses');
    }

    $params = [
        'transaction_details' => [
            'order_id' => 'PMJ-' . $peminjaman->id . '-' . time(),
            'gross_amount' => $peminjaman->total,
        ],
        'customer_details' => [
            'first_name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ]
    ];

    $snapToken = Snap::getSnapToken($params);

    return view('peminjam.payment_gateway', [
        'snapToken' => $snapToken,
        'peminjaman' => $peminjaman
    ]);
}


public function callback(Request $request)
{
    $serverKey = config('midtrans.server_key');

    $hashed = hash("sha512",
        $request->order_id .
        $request->status_code .
        $request->gross_amount .
        $serverKey
    );

    if ($hashed != $request->signature_key) {
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    $orderId = explode('-', $request->order_id)[1];

    $peminjaman = Peminjaman::find($orderId);

    if ($request->transaction_status == 'settlement') {
        $peminjaman->update([
            'payment_status' => 'paid'
        ]);
    }

    return response()->json(['message' => 'OK']);
}
}

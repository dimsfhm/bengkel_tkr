<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = $this->calculateTotal($cart);
        
        return view('cart.index', compact('cart', 'total'));
    }

    // Menambah produk ke keranjang
    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        $quantity = $request->input('quantity', 1);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'stock' => $product->stock
            ];
        }
        
        // Cek stok
        if ($cart[$product->id]['quantity'] > $product->stock) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    // Update jumlah produk
    public function update(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            $product = Product::find($productId);
            $newQuantity = $request->input('quantity');
            
            if ($newQuantity > $product->stock) {
                return response()->json(['error' => 'Stok tidak mencukupi'], 422);
            }
            
            $cart[$productId]['quantity'] = $newQuantity;
            session()->put('cart', $cart);
            
            return response()->json([
                'success' => true,
                'subtotal' => $this->calculateSubtotal($cart[$productId]),
                'total' => $this->calculateTotal($cart)
            ]);
        }
        
        return response()->json(['error' => 'Produk tidak ditemukan'], 404);
    }

    // Hapus produk dari keranjang
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    // Kosongkan keranjang
    public function clear()
    {
        session()->forget('cart');
        
        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan!');
    }

    // Hitung subtotal per item
    private function calculateSubtotal($item)
    {
        return $item['price'] * $item['quantity'];
    }

    // Hitung total semua item
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
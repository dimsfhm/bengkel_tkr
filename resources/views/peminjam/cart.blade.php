<x-navbar-sidebar-layout>
<h2>Keranjang</h2>

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

@if(session('error'))
    <div>{{ session('error') }}</div>
@endif

@if(count($cart) > 0)
    <table border="1" cellpadding="10">
        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>

        @php $total = 0; @endphp

        @foreach($cart as $id => $item)
        @php 
                $harga = $item['harga'] ?? 0;
            $qty = $item['quantity'] ?? 0;
            $subtotal = $harga * $qty;
            $total += $subtotal;
        @endphp

        <tr>
            <td>
                @if(!empty($item['gambar']))
    <img src="{{ asset('storage/' . $item['gambar']) }}" width="60">
@else
    <span>No image</span>
@endif
            </td>
            <td>{{ $item['nama'] }}</td>
            <td>Rp {{ number_format($item['harga']) }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>Rp {{ number_format($subtotal) }}</td>
            <td>
                <a href="{{ route('peminjam.cart.remove', $id) }}">Hapus</a>
            </td>
        </tr>
        @endforeach

        <tr>
            <td colspan="4"><strong>Total</strong></td>
            <td colspan="2"><strong>Rp {{ number_format($total) }}</strong></td>
        </tr>
    </table>
@else
    <p>Keranjang kosong</p>
@endif

</x-navbar-sidebar-layout>
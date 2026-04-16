<x-navbar-sidebar-layout>
<div class="container py-4">

    <h3 class="mb-4 fw-bold">🛒 Keranjang</h3>

    {{-- NOTIF --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(count($cart) > 0)

    <div class="card shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $total = 0; @endphp

                        @foreach($cart as $id => $item)
                        @php 
                            $harga = $item['harga'] ?? 0;
                            $qty = $item['quantity'] ?? 0;
                            $subtotal = $harga * $qty;
                            $total += $subtotal;
                        @endphp

                        <tr>
                            {{-- PRODUK --}}
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    @if(!empty($item['gambar']))
                                        <img src="{{ asset('storage/' . $item['gambar']) }}" 
                                             width="60" height="60"
                                             style="object-fit:cover; border-radius:8px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center"
                                             style="width:60px;height:60px;border-radius:8px;">
                                            <small>No Img</small>
                                        </div>
                                    @endif

                                    <div>
                                        <div class="fw-semibold">{{ $item['nama'] }}</div>
                                    </div>
                                </div>
                            </td>

                            {{-- HARGA --}}
                            <td>Rp {{ number_format($harga,0,',','.') }}</td>

                            {{-- JUMLAH --}}
                            <td>
                                <span class="badge bg-secondary">
                                    {{ $qty }}
                                </span>
                            </td>

                            {{-- TOTAL --}}
                            <td class="fw-semibold">
                                Rp {{ number_format($subtotal,0,',','.') }}
                            </td>

                            {{-- AKSI --}}
                            {{-- AKSI --}}
<td class="text-center">
    <form action="{{ route('peminjam.cart.remove', $id) }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-danger">
            Hapus
        </button>
    </form>
</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>

        {{-- FOOTER TOTAL --}}
        <div class="card-footer d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Total</h5>
            <h4 class="mb-0 text-primary fw-bold">
                Rp {{ number_format($total,0,',','.') }}
            </h4>
        </div>
    </div>

    @else
        <div class="alert alert-info text-center">
            Keranjang kosong 💤
        </div>
    @endif

</div>
</x-navbar-sidebar-layout>
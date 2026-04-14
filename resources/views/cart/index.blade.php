@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <h1>Keranjang Belanja</h1>
    
    @if(empty($cart))
        <div class="alert alert-info">Keranjang Anda kosong.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr id="cart-item-{{ $item['id'] }}">
                        <td>{{ $item['name'] }}</td>
                        <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td>
                            <input type="number" 
                                   class="form-control quantity-input" 
                                   data-id="{{ $item['id'] }}" 
                                   data-stock="{{ $item['stock'] }}"
                                   value="{{ $item['quantity'] }}" 
                                   min="1" 
                                   max="{{ $item['stock'] }}"
                                   style="width: 80px;">
                        </td>
                        <td class="subtotal-{{ $item['id'] }}">
                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                        </td>
                        <td>
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">Total:</th>
                    <th id="cart-total">Rp {{ number_format($total, 0, ',', '.') }}</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        
        <div class="d-flex justify-content-between">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Kosongkan Keranjang</button>
            </form>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Lanjutkan Belanja</a>
        </div>
    @endif
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.quantity-input').on('change', function() {
        let productId = $(this).data('id');
        let quantity = $(this).val();
        let maxStock = $(this).data('stock');
        
        if (quantity < 1) {
            quantity = 1;
            $(this).val(1);
        }
        
        if (quantity > maxStock) {
            alert('Stok tidak mencukupi! Maksimal ' + maxStock);
            $(this).val(maxStock);
            quantity = maxStock;
        }
        
        $.ajax({
            url: '/cart/update/' + productId,
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    $('.subtotal-' + productId).text(formatRupiah(response.subtotal));
                    $('#cart-total').text(formatRupiah(response.total));
                }
            },
            error: function(xhr) {
                alert(xhr.responseJSON.error);
            }
        });
    });
    
    function formatRupiah(angka) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
    }
});
</script>
@endpush
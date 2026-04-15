<x-navbar-sidebar-layout>
    <div class="container">
    <h2>Alat Tersedia</h2>
    <div class="row">
        @foreach($alats as $alat)
        <div class="col-md-3 mb-3">
            <div class="card">
                <img src="{{ $alat->gambar ? asset('storage/'.$alat->gambar) : 'https://via.placeholder.com/300' }}" class="card-img-top">
                <div class="card-body">
                    <h5>{{ $alat->nama_alat }}</h5>
                    <p>Stok: {{ $alat->jumlah_total }}</p>
                    <p>Harga: Rp {{ number_format($alat->harga,0,',','.') }}</p>
                    <form method="POST" action="{{ route('peminjam.checkout') }}">
    @csrf
    <button type="submit">Pinjam</button>
</form>
                    <form method="POST" action="{{ route('cart.add', $alat->id) }}">
    @csrf
    <button type="submit">Tambah ke Keranjang</button>
</form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $alats->links() }}
</div>
</x-navbar-sidebar-layout>
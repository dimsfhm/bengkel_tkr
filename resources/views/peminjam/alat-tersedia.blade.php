<x-navbar-sidebar-layout>
<div class="container py-4">
    <h2 class="mb-4">Alat Tersedia</h2>

    {{-- GRID --}}
    <div class="row g-3">
        @foreach($alats as $alat)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm">

                <img 
                    src="{{ $alat->gambar ? asset('storage/'.$alat->gambar) : 'https://via.placeholder.com/300x180' }}" 
                    class="card-img-top"
                    style="height:180px; object-fit:cover;"
                >

                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold">{{ $alat->nama_alat }}</h5>

                    <p class="mb-1">Stok: {{ $alat->jumlah_total }}</p>
                    <p class="mb-3">Harga: Rp {{ number_format($alat->harga,0,',','.') }}</p>

                    <div class="mt-auto">
                        <button class="btn btn-primary w-100 mb-2"
                            data-bs-toggle="modal"
                            data-bs-target="#pinjamModal{{ $alat->id }}">
                            Pinjam
                        </button>

                        <button class="btn btn-outline-primary w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#cartModal{{ $alat->id }}">
                            Tambah ke Keranjang
                        </button>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $alats->links() }}
    </div>
</div>

{{-- ✅ MODAL PINDAH KE LUAR ROW --}}
@foreach($alats as $alat)

{{-- MODAL PINJAM --}}
<div class="modal fade" id="pinjamModal{{ $alat->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Pinjam Alat</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('peminjam.checkout') }}">
                @csrf

                <div class="modal-body">
                    <input type="hidden" name="alat_id" value="{{ $alat->id }}">

                    <label>Nama</label>
                    <input type="text" class="form-control mb-2" value="{{ $alat->nama_alat }}" readonly>

                    <label>Jumlah</label>
                    <input type="number" name="jumlah" min="1" max="{{ $alat->jumlah_total }}" class="form-control mb-2" required>

                    <label>Tanggal</label>
                    <input type="date" name="tanggal_pinjam" class="form-control mb-2" required>

                    <label>Lama Sewa</label>
                    <input type="number" name="lama_sewa" class="form-control mb-2" required>

                    <label>Metode</label>
                    <select name="metode_pembayaran" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="cod">COD</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- MODAL CART --}}
<div class="modal fade" id="cartModal{{ $alat->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-secondary text-white">
                <h5 class="modal-title">Tambah ke Keranjang</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('peminjam.cart.add', $alat->id) }}">
                @csrf

                <div class="modal-body">
                    <p class="fw-semibold">{{ $alat->nama_alat }}</p>

                    <label>Jumlah</label>
                    <input type="number" name="jumlah" value="1" min="1" max="{{ $alat->jumlah_total }}" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endforeach

</x-navbar-sidebar-layout>
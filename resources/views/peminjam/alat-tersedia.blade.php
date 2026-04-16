<x-navbar-sidebar-layout>
<div class="container py-4">
    <h2 class="mb-4">Alat Tersedia</h2>

    <div class="row g-3">
        @foreach($alats as $alat)
        <div class="col-md-3">
            <div class="card h-100 shadow-sm">

                <img 
                    src="{{ $alat->gambar ? asset('storage/'.$alat->gambar) : 'https://via.placeholder.com/300' }}" 
                    class="card-img-top"
                    style="height:180px; object-fit:cover;"
                >

                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold">{{ $alat->nama_alat }}</h5>

                    <p class="mb-1">Stok: {{ $alat->jumlah_total }}</p>
                    <p class="mb-3">Harga: Rp {{ number_format($alat->harga,0,',','.') }}</p>

                    {{-- tombol di bawah --}}
                    <div class="mt-auto">

                        <button class="btn btn-primary w-100 mb-2"
                            data-bs-toggle="modal"
                            data-bs-target="#pinjamModal{{ $alat->id }}">
                            Pinjam
                        </button>

                        <form method="POST" action="{{ route('peminjam.cart.add', $alat->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary w-100">
                                Tambah ke Keranjang
                            </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        {{-- MODAL HARUS DI LUAR FORM/TOMBOL --}}
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

                            <label class="form-label">Nama Alat</label>
                            <input type="text" class="form-control mb-2" value="{{ $alat->nama_alat }}" readonly>

                            <label class="form-label">Jumlah Pinjam</label>
                            <input type="number" name="jumlah" min="1" max="{{ $alat->jumlah_total }}" class="form-control mb-2" required>

                            {{-- ✅ TANGGAL PINJAM --}}
    <label class="form-label">Tanggal Pinjam</label>
    <input type="date" name="tanggal_pinjam" class="form-control mb-2" required>

    {{-- ✅ LAMA SEWA --}}
    <label class="form-label">Lama Sewa (Hari)</label>
    <input type="number" name="lama_sewa" class="form-control" placeholder="Contoh: 3" required>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        @endforeach
    </div>

    <div class="mt-4">
        {{ $alats->links() }}
    </div>
</div>
</x-navbar-sidebar-layout>
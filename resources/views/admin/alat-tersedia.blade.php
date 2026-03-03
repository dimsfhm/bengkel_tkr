</x-navbar-sidebar-layout>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Alat Tersedia</h4>

        <!-- Tombol Tambah -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAlat">
            + Tambah Alat
        </button>
    </div>

    <!-- Card Produk -->
    <div class="card" style="width: 18rem;">
        <img src="https://via.placeholder.com/200" class="card-img-top">
        <div class="card-body">
            <h6 class="card-title">Mesin Bor Impact</h6>
            <p class="text-success">Rp. 100.000</p>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahAlat" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Alat Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('alat.store') }}" method="POST">
        @csrf

        <div class="modal-body">

            <div class="mb-3">
                <label class="form-label">Nama Alat</label>
                <input type="text" name="nama_alat" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Kondisi</label>
                <input type="text" name="kondisi" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Alat</label>
                <input type="number" name="jumlah" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control">
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

      </form>

    </div>
  </div>
</div>
</x-navbar-sidebar-layout>
<x-navbar-sidebar-layout>
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2 border-secondary">
            <h3 class="mb-4">Dashboard</h3>
        </div>
        <!-- Stats -->
        <div class="row g-3 mb-4">

            <div class="col-md-4">
                <div class="card stat-card shadow-sm border-left-primary">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-primary">Data Pesanan</small>
                            <h4 class="mb-0 fw-bold">{{ $peminjaman->count() }} Pesanan</h4>
                        </div>
                        <i class="bi bi-receipt fs-2 text-secondary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card shadow-sm border-left-success">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-success">Tambah Alat</small>
                            <h4 class="mb-0 fw-bold">{{ $total_alat }} Alat</h4>
                        </div>
                        <i class="bi bi-briefcase fs-2 text-secondary"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card shadow-sm border-left-danger">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-danger">Data Petugas</small>
                            <h4 class="mb-0 fw-bold">{{ $total_petugas }} Petugas</h4>
                        </div>
                        <i class="bi bi-people fs-2 text-secondary"></i>
                    </div>
                </div>
            </div>

        </div>

        <!-- Table -->
        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="mb-3">Peminjaman Terbaru</h5>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Produk</th>
                                <th>Status</th>
                                <th>Tipe</th>
                                <th>Kode Pesanan</th>
                                <th>Harga</th>
                            </tr>
                    </table>
                </div>

            </div>
        </div>

    </div>
</x-navbar-sidebar-layout>
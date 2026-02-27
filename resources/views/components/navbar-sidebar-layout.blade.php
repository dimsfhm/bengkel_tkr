<x-layout>
    <x-slot name="style">
        <style>
            body {
                background-color: #f4f6f9;
            }

            .sidebar {
                width: 250px;
                min-height: 100vh;
                background: linear-gradient(180deg, #6c757d, #1e3a5f);
            }

            .sidebar .nav-link {
                color: #fff;
                padding: 12px 20px;
            }

            .sidebar .nav-link:hover {
                background-color: rgba(255, 255, 255, 0.1);
            }

            .stat-card {
                border-radius: 10px;
            }

            .border-left-primary {
                border-left: 4px solid #0d6efd;
            }

            .border-left-success {
                border-left: 4px solid #198754;
            }

            .border-left-danger {
                border-left: 4px solid #dc3545;
            }

            .badge-active {
                background-color: #d1e7dd;
                color: #0f5132;
                border: 1px solid #198754;
            }
        </style>
    </x-slot>

    <div class="d-flex">

        <!-- Sidebar -->
        <div class="sidebar d-none d-md-block px-2">
            <div class="p-3 text-white fs-4 fw-bold border-bottom">
                <i class="bi bi-tools"></i> MasterAlat
            </div>

            <ul class="nav flex-column mt-3">
                <li class="nav-item">
                    <a href="{{ route('peminjam.dashboard') }}" class="nav-link {{ request()->routeIs('peminjam.dashboard') ? 'text-white fw-semibold border-bottom' : 'text-body-tertiary' }}">
                        <i class="bi bi-house me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjam.data-pesanan') }}" class="nav-link {{ request()->routeIs('peminjam.data-pemesanan') ? 'text-white fw-semibold border-bottom' : 'text-body-tertiary' }}">
                        <i class="bi bi-receipt me-2"></i> Data Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-briefcase me-2"></i> Alat Tersedia
                    </a>
                </li>
            </ul>
        </div>

        <!-- Content -->
        <div class="flex-grow-1">

            <!-- Topbar -->
            <nav class="navbar navbar-light bg-white shadow-sm px-3">
                <div class="container-fluid">
                    <i class="bi bi-cart2 fs-3"></i>
                    
                    <form class="d-flex gap-3">
                        <div class="rounded-pill ps-3 bg-body-secondary d-flex align-items-center">
                            <i class="bi bi-search"></i>
                            <input class="form-control bg-transparent border-0 outline-0 shadow-none me-2" type="search" placeholder="Search">
                            <button class="btn btn-primary rounded-pill d-flex gap-2">
                                <i class="bi bi-search"></i>
                                Cari
                            </button>
                        </div>
                    </form>

                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-circle fs-4 me-2"></i>
                            <span>Admin</span>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main -->
            <div class="container-fluid p-4">

                <h3 class="mb-4">Dashboard</h3>

                <!-- Stats -->
                <div class="row g-3 mb-4">

                    <div class="col-md-4">
                        <div class="card stat-card shadow-sm border-left-primary">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-primary">Data Pesanan</small>
                                    <h4 class="mb-0 fw-bold">0 Pesanan</h4>
                                </div>
                                <i class="bi bi-receipt fs-2 text-secondary"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card stat-card shadow-sm border-left-success">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-success">Alat tersedia</small>
                                    <h4 class="mb-0 fw-bold">0 Tersedia</h4>
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
                                    <h4 class="mb-0 fw-bold">0 Petugas</h4>
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
                                </thead>
                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/50" class="me-2 rounded">
                                                Kunci Inggris
                                            </div>
                                        </td>
                                        <td><span class="badge badge-active">Active</span></td>
                                        <td>Standart</td>
                                        <td><span class="badge bg-light text-dark border">9177</span></td>
                                        <td>Rp. 100.000</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/50" class="me-2 rounded">
                                                Kunci Inggris
                                            </div>
                                        </td>
                                        <td><span class="badge badge-active">Active</span></td>
                                        <td>Standart</td>
                                        <td><span class="badge bg-light text-dark border">9177</span></td>
                                        <td>Rp. 100.000</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/50" class="me-2 rounded">
                                                Kunci Inggris
                                            </div>
                                        </td>
                                        <td><span class="badge badge-active">Active</span></td>
                                        <td>Standart</td>
                                        <td><span class="badge bg-light text-dark border">9177</span></td>
                                        <td>Rp. 100.000</td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="https://via.placeholder.com/50" class="me-2 rounded">
                                                Kunci Inggris
                                            </div>
                                        </td>
                                        <td><span class="badge badge-active">Active</span></td>
                                        <td>Standart</td>
                                        <td><span class="badge bg-light text-dark border">9177</span></td>
                                        <td>Rp. 100.000</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-slot name="script"></x-slot>
</x-layout>

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
                        <i class="bi bi-briefcase me-2"></i> Tambah Alat
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
            {{ $slot }}
        </div>
    </div>

    <x-slot name="script"></x-slot>
</x-layout>

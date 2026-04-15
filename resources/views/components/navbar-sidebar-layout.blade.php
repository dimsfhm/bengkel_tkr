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

        @php
            $route_name = auth()->user()->role === 'admin' ? 'admin.' : (auth()->user()->role === 'petugas' ? 'petugas.' : 'peminjam.');
        @endphp
        
        <!-- Sidebar -->
        <div class="sidebar d-none d-md-block px-2">
            <div class="p-3 text-white fs-8 fw-bold border-bottom">
                <i class="bi bi-tools"></i> MasterAlat
            </div>

            <ul class="nav flex-column mt-3">
                {{--muncul semua  --}}
                <x-navlink href="{{ $route_name. 'dashboard' }}">Dashboard</x-navlink>
                {{--  --}}
                
                
                
                {{-- admin aja --}}
                @if (auth()->user()->role === 'admin')
                    <x-navlink href="{{ $route_name. 'data-pesanan' }}">Data Pesanan</x-navlink>
                    <x-navlink href="{{ $route_name. 'data-user' }}">Data User</x-navlink>
                    <x-navlink href="{{ $route_name. 'kategori.index' }}">add kategori</x-navlink>
                    
                @endif
                    
                {{-- petugas aja --}}
                @if (auth()->user()->role === 'petugas')
                    <x-navlink href="{{ $route_name. 'data-pesanan' }}">Data Pesanan</x-navlink>
                
                @endif


                {{-- peminjam aja --}}
                @if (auth()->user()->role === 'user')
                    <x-navlink href="{{ $route_name. 'riwayat' }}">Riwayat</x-navlink>
                    <x-navlink href="{{ $route_name. 'alat-tersedia' }}">Alat</x-navlink>
                    <x-navlink href="{{ $route_name. 'cart' }}">Keranjang</x-navlink>
                @endif

            </ul>
        </div>

        <!-- Content -->
        <div class="flex-grow-1">

            <!-- Topbar -->
            <nav class="navbar navbar-light bg-white shadow-sm px-3">
                <div class="container-fluid">
                    <i class="bi  fs-3"></i>
                    
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
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm ms-3">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main -->
            <main class="p-5">
                {{ $slot }}
            </main>
        </div>
    </div>

    <x-slot name="script"></x-slot>
</x-layout>

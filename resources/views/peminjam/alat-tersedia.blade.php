@extends('layouts.app') {{-- atau x-navbar-sidebar-layout --}}

@section('title', 'Alat Tersedia')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Alat Tersedia</h2>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Grid Alat --}}
    <div class="row">
        @forelse($alats as $alat)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm">
                {{-- Gambar placeholder jika tidak ada --}}
                <img src="{{ $alat->gambar ? asset('storage/' . $alat->gambar) : 'https://via.placeholder.com/300x200?text=Alat' }}"
                     class="card-img-top" alt="{{ $alat->nama_alat }}"
                     style="height: 180px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $alat->nama_alat }}</h5>
                    <p class="card-text text-primary fw-bold">
                        Rp {{ number_format($alat->harga ?? 0, 0, ',', '.') }}
                    </p>
                    <p class="card-text small text-muted">
                        Tersedia: {{ $alat->kondisi_baik }} unit
                    </p>
                </div>
                <div class="card-footer bg-transparent border-0 text-center mb-2">
                    <a href="{{ route('peminjam.cart.add', $alat->id) }}" class="btn btn-primary btn-sm w-100">
                        Pinjam / Sewa
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">Belum ada alat yang tersedia.</div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $alats->links() }}
    </div>
</div>
@endsection
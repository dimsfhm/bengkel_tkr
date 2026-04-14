<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aplikasi Peminjaman Alat')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            {{-- Brand: arahkan ke halaman dashboard sesuai role --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                Aplikasi Peminjaman
            </a>

            <div class="ms-auto d-flex gap-2">
                @auth
                    {{-- Jika user login, tampilkan tombol keranjang (opsional, jika ada route cart) --}}
                    @if(Route::has('peminjam.cart.index'))
                        <a href="{{ route('peminjam.cart.index') }}" class="btn btn-outline-primary">
                            Keranjang ({{ count(session()->get('cart', [])) }})
                        </a>
                    @endif

                    {{-- Tombol logout --}}
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html>
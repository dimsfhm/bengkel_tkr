<x-navbar-sidebar-layout>
    <div class="p-6 bg-gray-100 min-h-screen">

    <!-- Title -->
    <h1 class="text-2xl font-semibold mb-4">Riwayat</h1>

    <div class="bg-white rounded-xl shadow p-4">

        <!-- Table Header -->
        <div class="grid grid-cols-6 font-semibold text-gray-600 border-b pb-2 mb-2">
            <div>Produk</div>
            <div>Status</div>
            <div>Tipe</div>
            <div>Kode Pesanan</div>
            <div>Harga</div>
            <div></div>
        </div>

        <!-- Loop Data -->
        @foreach ($riwayats as $item)
        <div class="grid grid-cols-6 items-center gap-2 py-3 border-b">

            <!-- Produk -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/kunci.png') }}" class="w-10 h-10 rounded bg-gray-200 p-1">
                <span>{{ $item->nama_produk }}</span>
            </div>

            <!-- Status -->
            <div>
                <span class="px-3 py-1 text-green-600 border border-green-400 rounded-md text-sm">
                    {{ $item->status }}
                </span>
            </div>

            <!-- Tipe -->
            <div>{{ $item->tipe }}</div>

            <!-- Kode -->
            <div>
                <span class="bg-gray-200 px-3 py-1 rounded">
                    {{ $item->kode }}
                </span>
            </div>

            <!-- Harga -->
            <div>Rp. {{ number_format($item->harga, 0, ',', '.') }}</div>

            <!-- Action -->
            <div>
                <form action="{{ route('peminjam.riwayat.hapus', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded flex items-center gap-1">
                        🗑 Hapus
                    </button>
                </form>
            </div>

        </div>
        @endforeach

    </div>
</div>
</x-navbar-sidebar-layout>
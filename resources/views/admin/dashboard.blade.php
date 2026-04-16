<x-navbar-sidebar-layout>
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
                @forelse($peminjaman as $item)
                    <tr>
                        <td>{{ $item->produk ?? '-' }}</td>
                        <td>{{ $item->status ?? '-' }}</td>
                        <td>{{ $item->tipe ?? '-' }}</td>
                        <td>{{ $item->kode_pesanan ?? '-' }}</td>
                        <td>{{ $item->alat->harga ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-navbar-sidebar-layout>
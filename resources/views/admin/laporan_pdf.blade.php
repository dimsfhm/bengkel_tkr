<x-navbar-sidebar-layout>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>LAPORAN PEMINJAMAN ALAT</h2>

        <a href="{{ route('admin.laporan.pdf') }}" class="btn btn-danger">
            Export PDF
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data ?? [] as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->alat->nama_alat ?? '-' }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-navbar-sidebar-layout>
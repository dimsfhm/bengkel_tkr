<x-navbar-sidebar-layout>

<h4>Data Pengembalian</h4>

<table class="table">
    <thead>
        <tr>
            <th>Alat</th>
            <th>User</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $item)
        <tr>

            {{-- ALAT --}}
            <td>{{ $item->alat->nama_alat ?? '-' }}</td>

            {{-- USER --}}
            <td>{{ $item->user->name ?? '-' }}</td>

            {{-- JUMLAH --}}
            <td>{{ $item->jumlah }}</td>

            {{-- STATUS --}}
            <td>
                @if($item->status_pengembalian == 'belum')
                    <span class="badge bg-warning">Menunggu</span>

                @elseif($item->status_pengembalian == 'dikembalikan')
                    <span class="badge bg-success">Selesai</span>

                @elseif($item->status_pengembalian == 'rusak')
                    <span class="badge bg-danger">Rusak</span>

                @else
                    <span class="badge bg-secondary">-</span>
                @endif
            </td>

            {{-- AKSI --}}
            <td>
                @if($item->status_pengembalian == 'belum')
                    <button onclick="approveReturn({{ $item->id }})" class="btn btn-success btn-sm">
                        Terima
                    </button>

                    <button onclick="rejectReturn({{ $item->id }})" class="btn btn-danger btn-sm">
                        Tolak
                    </button>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>

        </tr>
        @endforeach
    </tbody>
</table>

{{-- JS HARUS DI SINI --}}
<script>
function approveReturn(id) {
    fetch(`/admin/peminjaman/${id}/return-approve`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    }).then(() => location.reload());
}

function rejectReturn(id) {
    fetch(`/admin/peminjaman/${id}/return-reject`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    }).then(() => location.reload());
}
</script>

</x-navbar-sidebar-layout>
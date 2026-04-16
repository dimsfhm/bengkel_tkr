<x-navbar-sidebar-layout>

<div class="container">
    <h2>Peminjaman</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
                <th>Detail Alat</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($peminjaman as $p)
            <tr>

                {{-- ID --}}
                <td>{{ $p->id }}</td>

                {{-- Tanggal Pinjam --}}
                <td>{{ $p->tanggal_pinjam }}</td>

                {{-- Jatuh Tempo --}}
                <td>{{ $p->tanggal_jatuh_tempo }}</td>

                {{-- STATUS --}}
                <td>
                    @if($p->status == 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($p->status == 'disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @elseif($p->status == 'ditolak')
                        <span class="badge bg-danger">Ditolak</span>
                    @elseif($p->status == 'selesai')
                        <span class="badge bg-primary">Selesai</span>
                    @else
                        <span class="badge bg-secondary">{{ $p->status }}</span>
                    @endif
                </td>

                {{-- DETAIL ALAT --}}
                <td>
                    @forelse($p->details ?? [] as $d)
                        - {{ $d->alat->nama_alat ?? '-' }} ({{ $d->qty ?? $d->jumlah_pinjam }}) <br>
                    @empty
                        <span class="text-muted">Tidak ada detail</span>
                    @endforelse
                </td>

                {{-- AKSI PENGEMBALIAN --}}
                <td>
    @if($p->status == 'disetujui' && $p->status_pengembalian == 'belum' && $p->tanggal_kembali == null)

        <form method="POST" action="/peminjam/pengembalian/{{ $p->id }}">
            @csrf
            <button class="btn btn-primary btn-sm">
                Ajukan Pengembalian
            </button>
        </form>

    @elseif($p->status_pengembalian == 'belum')

        <span class="badge bg-info">Menunggu verifikasi</span>

    @elseif($p->status_pengembalian == 'dikembalikan')

        <span class="badge bg-success">Sudah dikembalikan</span>

    @elseif($p->status_pengembalian == 'rusak')

        <span class="badge bg-danger">Ditolak / Rusak</span>

    @endif
</td>

            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- PAGINATION --}}
    {{ $peminjaman->links() }}

</div>

</x-navbar-sidebar-layout>
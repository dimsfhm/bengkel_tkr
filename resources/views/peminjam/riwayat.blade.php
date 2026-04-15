<x-navbar-sidebar-layout>
    <div class="container">
    <h2>Riwayat Peminjaman</h2>
    <table class="table">
        <thead>
            <tr><th>ID</th><th>Tgl Pinjam</th><th>Jatuh Tempo</th><th>Status</th><th>Detail Alat</th></tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->tanggal_jatuh_tempo }}</td>
                <td>{{ $p->status }}</td>
                <td>
                    @foreach($p->details as $d)
                    - {{ $d->alat->nama_alat }} ({{ $d->jumlah_pinjam }})<br>
                    @endforeach
                 </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $peminjaman->links() }}
</div>
</x-navbar-sidebar-layout>
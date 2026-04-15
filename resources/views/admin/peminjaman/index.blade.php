<x-navbar-sidebar-layout>
    <div class="container">
    <h2>Daftar Peminjaman</h2>
    <table class="table">
        <thead>
            <tr><th>ID</th><th>Peminjam</th><th>Tgl Pinjam</th><th>Jatuh Tempo</th><th>Status</th><th>Alat & Jumlah</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->tanggal_pinjam }}</td>
                <td>{{ $p->tanggal_jatuh_tempo }}</td>
                <td>{{ $p->status }}</td>
                <td>
                    @foreach($p->details as $d)
                    {{ $d->alat->nama_alat }} ({{ $d->jumlah_pinjam }})<br>
                    @endforeach
                </td>
                <td>
                    @if($p->status == 'menunggu')
                        <form action="{{ route('admin.peminjaman.approve', $p->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-success">Setujui</button>
                        </form>
                        <form action="{{ route('admin.peminjaman.reject', $p->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('PATCH')
                            <button class="btn btn-sm btn-danger">Tolak</button>
                        </form>
                    @elseif($p->status == 'disetujui')
                        <form action="{{ route('admin.peminjaman.kembali', $p->id) }}" method="POST">
                            @csrf @method('PATCH')
                            @foreach($p->details as $i => $d)
                            <select name="kondisi[{{ $i }}]" class="form-control form-control-sm mb-1" required>
                                <option value="baik">Baik</option>
                                <option value="rusak">Rusak</option>
                                <option value="hilang">Hilang</option>
                            </select>
                            @endforeach
                            <button class="btn btn-sm btn-info mt-1">Kembali</button>
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $peminjaman->links() }}
</div>
</x-navbar-sidebar-layout>
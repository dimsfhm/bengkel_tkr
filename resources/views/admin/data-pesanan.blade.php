    <x-navbar-sidebar-layout>

        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3 border-secondary">
            <h4>Data Pesanan</h4>
            <div>
                <input type="text" class="form-control d-inline w-auto" placeholder="Search">
                <button class="btn btn-primary ms-2">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
            </div>
        </div>

        {{-- NOTIF --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card card-custom p-3">
            <div class="table-responsive">

                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Status</th>
                            <th>Kode</th>
                            <th>Jumlah</th>
                            <th>Peminjam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($peminjaman as $item)
                        <tr>
                            <td>{{ $item->alat->nama_alat ?? '-' }}</td>

                            <td>
                                @if($item->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($item->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($item->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>

                            <td>#{{ $item->id }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->user->name ?? '-' }}</td>

                            <td>
                                @if($item->status == 'pending')
                                    <button onclick="approve({{ $item->id }})" class="btn btn-success btn-sm">
                                        Approve
                                    </button>

                                    <button onclick="reject({{ $item->id }})" class="btn btn-danger btn-sm">
                                        Reject
                                    </button>
                                @else
                                    <span class="text-muted">Dipinjam</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>

            </div>
        </div>

    </x-navbar-sidebar-layout>

    {{-- JS TARUH DI SINI --}}
    <script>
    function approve(id) {
        fetch(`/admin/peminjaman/${id}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => location.reload());
    }

    function reject(id) {
        fetch(`/admin/peminjaman/${id}/reject`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(() => location.reload());
    }
    </script>
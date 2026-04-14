<x-navbar-sidebar-layout>
    <div class="topbar mb-4">
        <div class="d-flex gap-2"></div>
    </div>

    <!-- Title -->
    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3 border-secondary">
        <h4>Data User</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            + Tambah User
        </button>
    </div>

    <!-- Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <!-- Table -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'petugas' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            <!-- Tombol hapus (opsional) -->
                            <form action="{{ route('admin.data-user.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data user.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $users->links() }} <!-- Pagination jika ada -->
        </div>
    </div>

    <!-- Modal Tambah User (sama seperti punya Anda, hanya saya tambahkan konfirmasi password opsional) -->
    <div class="modal fade" id="modalTambahUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah User Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.data-user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="user">User</option>
                                <option value="petugas">Petugas</option>
                                <option value="admin">Admin</option> <!-- jika ada -->
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-navbar-sidebar-layout>
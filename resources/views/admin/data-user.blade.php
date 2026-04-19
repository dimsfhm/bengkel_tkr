<x-navbar-sidebar-layout>

    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3 border-secondary">
        <h4>Data User</h4>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            + Tambah User
        </button>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- TABLE --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered align-middle">
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
                        <td>{{ $users->firstItem() + $key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'petugas' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td class="d-flex gap-1">

                            {{-- EDIT BUTTON --}}
                            <button
                                class="btn btn-sm btn-warning btn-edit"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}"
                                data-email="{{ $user->email }}"
                                data-role="{{ $user->role }}"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditUser">
                                Edit
                            </button>

                            {{-- DELETE --}}
                            <form action="{{ route('admin.data-user.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada data user</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $users->links() }}
        </div>
    </div>

    {{-- ===================== --}}
    {{-- MODAL TAMBAH USER --}}
    {{-- ===================== --}}
    <div class="modal fade" id="modalTambahUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah User</h5>
                    <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.data-user.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">

                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Role</label>
                            <select name="role" class="form-select" required>
                                <option value="user">User</option>
                                <option value="petugas">Petugas</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    {{-- ===================== --}}
    {{-- MODAL EDIT USER --}}
    {{-- ===================== --}}
    <div class="modal fade" id="modalEditUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Edit User</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formEditUser" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="mb-2">
                            <label>Nama</label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label>Role</label>
                            <select name="role" id="edit-role" class="form-select" required>
                                <option value="user">User</option>
                                <option value="petugas">Petugas</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label>Password (opsional)</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                        <button class="btn btn-warning">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

</x-navbar-sidebar-layout>


{{-- ===================== --}}
{{-- SCRIPT EDIT MODAL --}}
{{-- ===================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const editButtons = document.querySelectorAll('.btn-edit');
    const form = document.getElementById('formEditUser');

    editButtons.forEach(btn => {
        btn.addEventListener('click', function () {

            const id = this.dataset.id;
            const name = this.dataset.name;
            const email = this.dataset.email;
            const role = this.dataset.role;

            form.action = `/admin/data-user/${id}`;

            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-role').value = role;
        });
    });

});
</script>
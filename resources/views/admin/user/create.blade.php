<x-navbar-sidebar-layout>
    <div class="topbar mb-4">
    <div class="d-flex gap-2">
</div>

<!-- Title -->
<div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3 border-secondary">
    <h4>Data User</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
        + Tambah User
    </button>
</div>

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
                    <th></th>
                </tr>
            </thead>

        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambahUser" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Form -->
            <form action="{{ route('admin.user.store') }}" method="POST">
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
                        </select>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

</x-navbar-sidebar-layout>
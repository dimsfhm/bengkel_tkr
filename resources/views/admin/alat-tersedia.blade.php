<x-navbar-sidebar-layout>
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-3 border-secondary">
        <h4>Alat Tersedia</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahAlat">
            + Tambah Alat
        </button>
    </div>

    {{-- Notifikasi --}}
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

    {{-- Tabel Alat --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Jumlah Total</th>
                <th>Kondisi Baik</th>
                <th>Kondisi Rusak</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alat as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_alat }}</td>
                <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $item->jumlah_total }}</td>
                <td>{{ $item->kondisi_baik }}</td>
                <td>{{ $item->kondisi_rusak }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditAlat{{ $item->id }}">Edit</button>
                    <form action="{{ route('admin.alat.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">Belum ada data alat</td></tr>
            @endforelse
        </tbody>
    </table>
    {{ $alat->links() }}

</div>

{{-- MODAL TAMBAH ALAT --}}
<div class="modal fade" id="modalTambahAlat" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title">Tambah Alat Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.alat.store') }}" method="POST">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Nama Alat</label>
                <input type="text" name="nama_alat" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jumlah Total</label>
                <input type="number" name="jumlah_total" class="form-control" required min="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Kondisi Baik</label>
                <input type="number" name="kondisi_baik" class="form-control" required min="0">
            </div>
            <div class="mb-3">
                <label class="form-label">Kondisi Rusak</label>
                <input type="number" name="kondisi_rusak" class="form-control" required min="0">
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

{{-- MODAL EDIT ALAT (per item) --}}
@foreach($alat as $item)
<div class="modal fade" id="modalEditAlat{{ $item->id }}" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Alat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="{{ route('admin.alat.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
            <div class="mb-3">
                <label>Nama Alat</label>
                <input type="text" name="nama_alat" class="form-control" value="{{ $item->nama_alat }}" required>
            </div>
            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori_id" class="form-select" required>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $item->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Jumlah Total</label>
                <input type="number" name="jumlah_total" class="form-control" value="{{ $item->jumlah_total }}" required min="0">
            </div>
            <div class="mb-3">
                <label>Kondisi Baik</label>
                <input type="number" name="kondisi_baik" class="form-control" value="{{ $item->kondisi_baik }}" required min="0">
            </div>
            <div class="mb-3">
                <label>Kondisi Rusak</label>
                <input type="number" name="kondisi_rusak" class="form-control" value="{{ $item->kondisi_rusak }}" required min="0">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

</x-navbar-sidebar-layout>
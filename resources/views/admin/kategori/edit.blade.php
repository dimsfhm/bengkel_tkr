@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
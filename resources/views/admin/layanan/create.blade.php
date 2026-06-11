@extends('admin.layouts.app')

@section('title', 'Tambah Layanan')
@section('page-title', 'Tambah Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Layanan</h3>
    </div>

    <form action="{{ route('layanan.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="row g-3">


                <div class="col-12">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select name="id_kategori" id="id_kategori"
                        class="form-select @error('id_kategori') is-invalid @enderror" required>
                        <option value="" disabled {{ old('id_kategori') ? '' : 'selected' }}>Pilih kategori</option>
                        @foreach(($kategoriLayanan ?? []) as $kategori)
                        <option value="{{ $kategori->id_kategori }}" {{ old('id_kategori') === $kategori->id_kategori ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }} ({{ $kategori->id_kategori }})
                        </option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="nama_layanan" class="form-label">Nama Layanan</label>
                    <input type="text" name="nama_layanan" id="nama_layanan"
                        class="form-control @error('nama_layanan') is-invalid @enderror"
                        value="{{ old('nama_layanan') }}" required maxlength="100">
                    @error('nama_layanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga"
                        class="form-control @error('harga') is-invalid @enderror"
                        value="{{ old('harga') }}" required step="0.01" min="0">
                    @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status"
                        class="form-select @error('status') is-invalid @enderror" required>
                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Pilih status</option>
                        <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>aktif</option>
                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>nonaktif</option>
                    </select>
                    @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer d-flex justify-content-end gap-2">
            <a href="{{ route('layanan.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1" aria-hidden="true"></i>
                Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save me-1" aria-hidden="true"></i>
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
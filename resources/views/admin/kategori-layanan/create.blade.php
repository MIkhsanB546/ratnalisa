@extends('admin.layouts.app')

@section('title', 'Tambah Kategori Layanan')
@section('page-title', 'Tambah Kategori Layanan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Kategori Layanan</h3>
    </div>
    <form action="{{ route('kategori-layanan.store') }}" method="POST">
        @csrf

        <div class="card-body">
            <div class="row g-3">
                <div class="">
                    <label for="id_kategori" class="form-label">Id Kategori</label>
                    <input type="text" name="id_kategori" id="id_kategori"
                        class="form-control @error('id_kategori') is-invalid @enderror" value="{{ old('id_kategori') }}" required
                        maxlength="100">
                    @error('id_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="nama_kategori"
                        class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" required
                        maxlength="100">
                    @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan"
                        class="form-control @error('keterangan') is-invalid @enderror"
                        value="{{ old('keterangan') }}" maxlength="255">
                    @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end gap-2">
                <a href="{{ route('kategori-layanan.index') }}" class="btn btn-secondary">
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
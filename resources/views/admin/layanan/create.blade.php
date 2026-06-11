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
                <div class="">
                    <label for="id_layanan" class="form-label">Id Layanan</label>
                    <input type="text" name="id_layanan" id="id_layanan"
                        class="form-control @error('id_layanan') is-invalid @enderror" value="{{ old('id_layanan') }}" required
                        maxlength="100">
                    @error('id_layanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="nama_layanan" class="form-label">Nama Layanan</label>
                    <input type="text" name="nama_layanan" id="nama_layanan"
                        class="form-control @error('nama_layanan') is-invalid @enderror" value="{{ old('nama_layanan') }}" required
                        maxlength="100">
                    @error('nama_layanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga"
                        class="form-control @error('harga') is-invalid @enderror"
                        value="{{ old('harga') }}" maxlength="255">
                    @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
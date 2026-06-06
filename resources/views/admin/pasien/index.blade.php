@extends('admin.layouts.app')

@section('title', 'Pasien')
@section('page-title', 'Pasien')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Pasien</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 16rem">
                    <span class="input-group-text">
                        <i class="bi bi-search" aria-hidden="true"></i>
                    </span>
                    <input id="table-filter" type="search" class="form-control" placeholder="Cari pasien..."
                        aria-label="Cari pasien" />
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            <div class="d-flex flex-wrap gap-2 mb-3">
                <a href="{{ route('pasien.create') }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg me-1" aria-hidden="true"></i>
                    Tambah Pasien
                </a>
                <button id="export-csv" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-filetype-csv me-1" aria-hidden="true"></i>
                    Export CSV
                </button>
                <button id="export-json" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-filetype-json me-1" aria-hidden="true"></i>
                    Export JSON
                </button>
                <button id="print-table" type="button" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-printer me-1" aria-hidden="true"></i>
                    Print
                </button>
            </div>
            <div id="users-table" class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle mb-0" id="pasien-table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 3rem">No</th>
                            <th scope="col">ID Pasien</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No. HP</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Alamat</th>
                            <th scope="col" style="width: 6rem">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pasien as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id_pasien }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>
                                    {{ $item->tgl_lahir ? \Carbon\Carbon::parse($item->tgl_lahir)->format('d/m/Y') : '-' }}
                                </td>
                                <td>
                                    @if ($item->jenis_kelamin === 'L')
                                        Laki-laki
                                    @elseif ($item->jenis_kelamin === 'P')
                                        Perempuan
                                    @else
                                        {{ ucfirst((string) $item->jenis_kelamin) }}
                                    @endif
                                </td>
                                <td>{{ $item->alamat }}</td>
                                <td>
                                    <a href="{{ route('pasien.edit', $item) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                        <span class="visually-hidden">Edit</span>
                                    </a>
                                    <form action="{{ route('pasien.destroy', $item) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pasien ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash" aria-hidden="true"></i>
                                            <span class="visually-hidden">Hapus</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    Belum ada data pasien.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const table = document.getElementById('pasien-table');
            const filter = document.getElementById('table-filter');
            const csvButton = document.getElementById('export-csv');
            const jsonButton = document.getElementById('export-json');
            const printButton = document.getElementById('print-table');

            if (!table) {
                return;
            }

            const getHeaders = () => Array.from(table.querySelectorAll('thead th'))
                .map((header) => header.textContent.trim())
                .filter((header) => header !== 'Aksi');

            const getVisibleRows = () => Array.from(table.querySelectorAll('tbody tr'))
                .filter((row) => row.style.display !== 'none' && row.querySelectorAll('td').length > 1);

            const getRowData = () => getVisibleRows().map((row) => Array.from(row.querySelectorAll('td'))
                .slice(0, getHeaders().length)
                .map((cell) => cell.textContent.trim().replace(/\s+/g, ' ')));

            const downloadFile = (filename, content, type) => {
                const blob = new Blob([content], {
                    type
                });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');

                link.href = url;
                link.download = filename;
                link.click();
                URL.revokeObjectURL(url);
            };

            filter?.addEventListener('input', (event) => {
                const keyword = event.target.value.trim().toLowerCase();

                table.querySelectorAll('tbody tr').forEach((row) => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(keyword) ? '' : 'none';
                });
            });

            csvButton?.addEventListener('click', () => {
                const rows = [getHeaders(), ...getRowData()];
                const csv = rows.map((row) => row.map((value) => `"${value.replace(/"/g, '""')}"`).join(
                    ',')).join('\n');

                downloadFile('data-pasien.csv', csv, 'text/csv;charset=utf-8;');
            });

            jsonButton?.addEventListener('click', () => {
                const headers = getHeaders();
                const data = getRowData().map((row) => Object.fromEntries(headers.map((header, index) => [
                    header,
                    row[index] ?? ''
                ])));

                downloadFile('data-pasien.json', JSON.stringify(data, null, 2),
                    'application/json;charset=utf-8;');
            });

            printButton?.addEventListener('click', () => {
                window.print();
            });
        });
    </script>
@endpush

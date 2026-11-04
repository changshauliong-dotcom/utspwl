<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #333333;
        }

        .table-custom {
            width: 100%;
            border-collapse: collapse;
        }

        .table-custom thead th {
            font-weight: 600;
            font-size: 0.85rem;
            color: #333333;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.2rem 1rem;
            background-color: #ffffff;
        }

        /* Warna Selang-Seling Baris (Zebra Striping Soft) */
        .table-custom tbody tr:nth-child(even) {
            background-color: #f4f6f9;
        }

        .table-custom tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .table-custom tbody td {
            padding: 1rem;
            font-size: 0.85rem;
            vertical-align: middle;
            border: none;
        }

        /* Badge Status Pill Soft */
        .badge-pill-custom {
            font-size: 0.65rem;
            font-weight: 600;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            display: inline-block;
        }
        .badge-hadir { background-color: #d1f7c4; color: #2b8a3e; }
        .badge-absen { background-color: #ffe3e3; color: #e03131; }
        .badge-izin  { background-color: #fff3bf; color: #f08c00; }
        .badge-sakit { background-color: #e7f5ff; color: #1971c2; }

        /* Style Radio Button */
        .radio-status-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .radio-item {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-weight: 600;
            font-size: 0.8rem;
            color: #333333;
            cursor: pointer;
        }

        .radio-item input[type="radio"] {
            cursor: pointer;
            accent-color: #3b82f6;
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body>
<div class="container-fluid px-5 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0">Form Presensi</h4>
        <a href="{{ route('matakuliah.index') }}" class="btn btn-sm btn-outline-primary">Kelola Mata Kuliah</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Form Filter Tanggal & Mata Kuliah (Opsional) -->
    <form method="GET" action="{{ route('absensi.index') }}" class="row g-3 mb-4 bg-light p-3 rounded border">
        <div class="col-md-4">
            <label class="form-label fw-semibold text-secondary small">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $tanggal }}" class="form-control form-control-sm" onchange="this.form.submit()">
        </div>
        <div class="col-md-8">
            <label class="form-label fw-semibold text-secondary small">Mata Kuliah (Opsional)</label>
            <select name="mata_kuliah_id" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">-- Semua / Tanpa Mata Kuliah --</option>
                @foreach($listMataKuliah as $mk)
                    <option value="{{ $mk->id }}" {{ $mataKuliahId == $mk->id ? 'selected' : '' }}>
                        {{ $mk->kode }} - {{ $mk->nama_matakuliah }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <form method="POST" action="{{ route('absensi.store') }}">
        @csrf
        <input type="hidden" name="tanggal" value="{{ $tanggal }}">
        <input type="hidden" name="mata_kuliah_id" value="{{ $mataKuliahId }}">

        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th class="ps-4" width="6%">No</th>
                        <th width="40%">Mahasiswa</th>
                        <th width="25%">Kehadiran</th>
                        <th width="29%">
                            <div class="d-flex align-items-center justify-content-between pe-4">
                                <span>Status</span>
                                <div class="radio-status-group opacity-75">
                                    <span class="radio-item"><input type="radio" disabled> H</span>
                                    <span class="radio-item"><input type="radio" disabled> A</span>
                                    <span class="radio-item"><input type="radio" disabled> I</span>
                                    <span class="radio-item"><input type="radio" disabled> S</span>
                                </div>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mahasiswa as $index => $mhs)
                        @php
                            $statusAktif = isset($absensiExisting[$mhs->id]) ? $absensiExisting[$mhs->id]->status_absen : null;
                        @endphp
                        <tr>
                            <!-- 1. Nomor Urut -->
                            <td class="ps-4 text-muted">{{ $index + 1 }}</td>
                            
                            <!-- 2. Mahasiswa (Nama & NIM) -->
                            <td>
                                <div class="fw-bold text-dark text-uppercase" style="font-size: 0.85rem; letter-spacing: 0.2px;">{{ $mhs->nama }}</div>
                                <div class="text-muted small" style="font-size: 0.75rem;">{{ $mhs->nim }}</div>
                            </td>
                            
                            <!-- 3. Kehadiran (Badge Indicator) -->
                            <td>
                                @if($statusAktif == 'H')
                                    <span class="badge-pill-custom badge-hadir">Hadir</span>
                                @elseif($statusAktif == 'A')
                                    <span class="badge-pill-custom badge-absen">Absen</span>
                                @elseif($statusAktif == 'I')
                                    <span class="badge-pill-custom badge-izin">Izin</span>
                                @elseif($statusAktif == 'S')
                                    <span class="badge-pill-custom badge-sakit">Sakit</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            
                            <!-- 4. Status (Pilihan Radio Button H, A, I, S) -->
                            <td>
                                <div class="radio-status-group">
                                    <label class="radio-item">
                                        <input type="radio" name="kehadiran[{{ $mhs->id }}]" value="H" {{ $statusAktif == 'H' ? 'checked' : '' }}> H
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="kehadiran[{{ $mhs->id }}]" value="A" {{ $statusAktif == 'A' ? 'checked' : '' }}> A
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="kehadiran[{{ $mhs->id }}]" value="I" {{ $statusAktif == 'I' ? 'checked' : '' }}> I
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="kehadiran[{{ $mhs->id }}]" value="S" {{ $statusAktif == 'S' ? 'checked' : '' }}> S
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                Belum ada data mahasiswa di database. Silakan isi data di tabel <strong>mahasiswas</strong> di SQLYog terlebih dahulu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(count($mahasiswa) > 0)
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-sm">Simpan Absensi</button>
        </div>
        @endif
    </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
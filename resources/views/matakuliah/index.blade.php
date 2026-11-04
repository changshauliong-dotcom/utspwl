<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Mata Kuliah</h2>
        <div>
            <a href="{{ route('absensi.index') }}" class="btn btn-outline-secondary me-2">Ke Absensi</a>
            <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">+ Tambah Mata Kuliah</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" width="8%">No</th>
                        <th width="25%">Kode MK</th>
                        <th>Nama Mata Kuliah</th>
                        <th class="text-center" width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matakuliah as $key => $item)
                    <tr>
                        <td class="ps-3">{{ $key + 1 }}</td>
                        <td><span class="badge bg-secondary">{{ $item->kode }}</span></td>
                        <td><strong>{{ $item->nama_matakuliah }}</strong></td>
                        <td class="text-center">
                            <a href="{{ route('matakuliah.edit', ['matakuliah' => $item->id]) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                            <form action="{{ route('matakuliah.destroy', ['matakuliah' => $item->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus mata kuliah ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Belum ada data mata kuliah.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
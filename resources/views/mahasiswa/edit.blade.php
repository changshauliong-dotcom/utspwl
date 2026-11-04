<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 600px;">

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-bold">Edit Data Mahasiswa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">NIM</label>
                    <input type="text" name="nim" class="form-control @error('nim') is-invalid @enderror" value="{{ old('nim', $mahasiswa->nim) }}" required>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Mahasiswa</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $mahasiswa->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Update Mahasiswa</button>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>
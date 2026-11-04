<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 600px;">

    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">Edit Data Mata Kuliah</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Kode MK</label>
                    <input type="text" name="kode" value="{{ $matakuliah->kode }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matakuliah" value="{{ $matakuliah->nama_matakuliah }}" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between pt-2">
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 600px;">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Tambah Mata Kuliah Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('matakuliah.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Kode MK</label>
                    <input type="text" name="kode" class="form-control" placeholder="Contoh: IF123" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matakuliah" class="form-control" placeholder="Contoh: Pemrograman Web Lanjut" required>
                </div>
                <div class="d-flex justify-content-between pt-2">
                    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
</body>
</html>
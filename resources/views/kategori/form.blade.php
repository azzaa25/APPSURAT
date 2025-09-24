<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Surat >> {{ isset($kategori) ? 'Edit' : 'Tambah' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .main-content { background-color: #fff; padding: 2rem; border-radius: .5rem; box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); }
        .sidebar { background-color: #343a40; height: 100vh; color: white; padding: 2rem 0; }
        .sidebar h3 { padding-left: 1rem; }
        .sidebar .list-group-item { background-color: transparent; color: #adb5bd; border: none; padding: 1rem; }
        .sidebar .list-group-item:hover { background-color: #495057; color: white; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar">
            <h3>Menu</h3>
            <ul class="list-group list-group-flush">
                <a href="{{ route('arsip_surat.index') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-star me-2"></i>Arsip
                </a>
                <a href="{{ route('kategori.index') }}" class="list-group-item list-group-item-action active">
                    <i class="fa-solid fa-folder me-2"></i>Kategori Surat
                </a>
                <a href="{{ route('about') }}" class="list-group-item list-group-item-action">
                    <i class="fa-solid fa-circle-info me-2"></i>About
                </a>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 main-content">
            <h1>Kategori Surat >> {{ isset($kategori) ? 'Edit' : 'Tambah' }}</h1>
            <p>{{ isset($kategori) ? 'Ubah data kategori surat yang ada.' : 'Tambahkan kategori surat baru.' }}</p>
            <hr>

            <form action="{{ isset($kategori) ? route('kategori.update', $kategori->id_kategori) : route('kategori.store') }}" method="POST">
                @csrf
                @if(isset($kategori))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="id" class="form-label">ID (Auto Increment)</label>
                    <input type="text" class="form-control" id="id" value="{{ isset($kategori) ? $kategori->id_kategori : 'Auto' }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}">
                    @error('nama_kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $kategori->keterangan ?? '') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-start mt-4">
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary me-2"><< Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

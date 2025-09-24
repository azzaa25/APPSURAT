<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat >> Lihat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .main-content { background-color: #fff; padding: 2rem; border-radius: .5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075); }
        .sidebar { background-color: #343a40; height: 100vh; color: white; padding: 2rem 0; }
        .sidebar h3 { padding-left: 1rem; }
        .sidebar .list-group-item { background-color: transparent; color: #adb5bd; border: none; padding: 1rem; }
        .sidebar .list-group-item:hover { background-color: #495057; color: white; }
        .pdf-preview { border: 1px solid #dee2e6; border-radius: .25rem; height: 400px; overflow-y: auto; }
        .pdf-preview iframe { width: 100%; height: 100%; border: none; }
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
                    <a href="{{ route('kategori.index') }}" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-folder me-2"></i>Kategori Surat
                    </a>
                    <a href="{{ route('about') }}" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-circle-info me-2"></i>About
                    </a>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <h1>Detail Arsip Surat</h1>
                <p><strong>Nomor:</strong> {{ $surat->nomor_surat }}</p>
                <p><strong>Kategori:</strong> {{ $surat->kategori_surat->nama_kategori ?? '-' }}</p>
                <p><strong>Judul:</strong> {{ $surat->judul }}</p>
                <p><strong>Waktu Unggah:</strong> {{ $surat->created_at->format('Y-m-d H:i:s') }}</p>
                <hr>

                <!-- PDF Scrollable -->
                <div class="pdf-preview mb-4">
                    @if($surat->file_path)
                        <iframe src="{{ asset('storage/surat/' . basename($surat->file_path)) }}" ></iframe>
                    @else
                        <div class="text-center text-muted mt-5">Tidak ada file surat yang diunggah</div>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-start">
                    <a href="{{ route('arsip_surat.index') }}" class="btn btn-secondary me-2">
                        &laquo; Kembali
                    </a>
                    <a href="{{ route('arsip_surat.download', $surat->id) }}" class="btn btn-primary me-2">
                        <i class="fa fa-download me-1"></i> Unduh
                    </a>
                    <a href="{{ route('arsip_surat.edit', $surat->id) }}" class="btn btn-warning">
                        <i class="fa fa-edit me-1"></i> Edit / Ganti File
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat >> Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .main-content { background-color: #fff; padding: 2rem; border-radius: .5rem; box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075); }
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
                <h1>Edit Arsip Surat</h1>
                <p>Perbarui data surat yang telah diarsipkan.</p>
                <hr>
                
                <form action="{{ route('arsip_surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Nomor Surat (readonly) -->
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" 
                               class="form-control" 
                               id="nomor_surat" 
                               name="nomor_surat" 
                               value="{{ $surat->nomor_surat }}" 
                               readonly>
                    </div>

                    <!-- Kategori Surat -->
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="id_kategori" 
                                class="form-select @error('id_kategori') is-invalid @enderror" 
                                id="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategori_surat as $k)
                                <option value="{{ $k->id_kategori }}" 
                                    {{ old('id_kategori', $surat->id_kategori) == $k->id_kategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Judul Surat -->
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('judul') is-invalid @enderror" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul', $surat->judul) }}" 
                               required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- File PDF -->
                    <div class="mb-3">
                        <label for="file" class="form-label">Ganti File Surat (PDF)</label>
                        <input type="file" 
                               class="form-control @error('file') is-invalid @enderror" 
                               id="file" 
                               name="file" 
                               accept="application/pdf">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti file</small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($surat->file_path)
                            <p class="mt-2">
                                <a href="{{ asset('storage/' . str_replace('public/', '', $surat->file_path)) }}" target="_blank">
                                    Lihat File Lama
                                </a>
                            </p>
                        @endif
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-flex justify-content-start mt-4">
                        <a href="{{ route('arsip_surat.index') }}" class="btn btn-secondary me-2">
                            &laquo; Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-save me-2"></i> Update Arsip
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

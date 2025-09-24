<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat</title>
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
            <h1>Arsip Surat</h1>
            <p>Berikut adalah surat-surat yang telah terbit dan diarsipkan. Klik "Lihat" untuk membuka surat.</p>
            <hr>

            <!-- Form Pencarian -->
            <form action="{{ route('arsip_surat.index') }}" method="GET" class="d-flex mb-4">
                <label for="search" class="me-2 mt-2">Cari surat:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-search"></i></span>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-dark ms-2">Cari</button>
            </form>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="fa-solid fa-envelope-open-text text-success me-2"></i> Daftar Arsip Surat
                </h4>
                <a href="{{ route('arsip_surat.create') }}" class="btn btn-success shadow-sm px-4">
                    <i class="fa-solid fa-upload me-2"></i> Arsipkan Surat
                </a>
            </div>
            <!-- Tabel Surat -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Waktu Pengarsipan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($surat as $s)
                        <tr>
                            <td>{{ $s->nomor_surat }}</td>
                            <td>{{ $s->kategori_surat->nama_kategori ?? '-' }}</td>
                            <td>{{ $s->judul }}</td>
                            <td>{{ \Carbon\Carbon::parse($s->waktu_pengarsipan)->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="d-flex">
                                    <!-- Tombol Hapus -->
                                    <button type="button" 
                                            class="btn btn-sm btn-danger me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal"
                                            data-id="{{ $s->id }}"
                                            data-judul="{{ $s->judul }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- Tombol Unduh -->
                                    <a href="{{ route('arsip_surat.download', $s->id) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="fa-solid fa-download"></i>
                                    </a>

                                    <!-- Tombol Lihat -->
                                    <a href="{{ route('arsip_surat.show', $s->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data surat yang ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus arsip surat <strong id="suratJudul"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form id="deleteForm" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Script Bootstrap + Modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const suratId = button.getAttribute('data-id');
        const suratJudul = button.getAttribute('data-judul');

        document.getElementById('suratJudul').textContent = suratJudul;

        // route otomatis dari resource
        const form = document.getElementById('deleteForm');
        form.action = "{{ url('arsip_surat') }}/" + suratId;
    });
});
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Surat</title>
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
            <h1>Kategori Surat</h1>
            <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.</p>
            <hr>

            <!-- Form Search -->
            <form action="{{ route('kategori.index') }}" method="GET" class="d-flex mb-4">
                <label for="search" class="me-2 mt-2">Cari kategori:</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-search"></i></span>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Cari..." value="{{ request('search') }}">
                </div>
                <button type="submit" class="btn btn-dark ms-2">Cari</button>
            </form>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">
                    <i class="fa-solid fa-envelope-open-text text-success me-2"></i> Daftar Kategori Surat
                </h4>
                <a href="{{ route('kategori.create') }}" class="btn btn-success">
                    <i class="fa-solid fa-plus me-2"></i>Tambah Kategori Baru
                </a>
            </div>
            <!-- Tabel Kategori -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $k)
                        <tr>
                            <td>{{ $k->id_kategori }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                            <td>{{ $k->keterangan }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('kategori.edit', $k->id_kategori) }}" class="btn btn-sm btn-primary me-1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal"
                                            data-id="{{ $k->id_kategori }}"
                                            data-nama="{{ $k->nama_kategori }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data kategori.</td>
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
        Apakah Anda yakin ingin menghapus kategori <strong id="kategoriNama"></strong>?
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
        const kategoriId = button.getAttribute('data-id');
        const kategoriNama = button.getAttribute('data-nama');

        document.getElementById('kategoriNama').textContent = kategoriNama;

        const form = document.getElementById('deleteForm');
        form.action = "{{ url('kategori') }}/" + kategoriId;
    });
});
</script>
</body>
</html>

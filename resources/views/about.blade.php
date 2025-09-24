<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .main-content { 
            background-color: #fff; 
            padding: 2rem; 
            border-radius: .5rem; 
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075); 
            text-align: center;
        }
        .sidebar { background-color: #343a40; height: 100vh; color: white; padding: 2rem 0; }
        .sidebar h3 { padding-left: 1rem; }
        .sidebar .list-group-item { background-color: transparent; color: #adb5bd; border: none; padding: 1rem; }
        .sidebar .list-group-item:hover, 
        .sidebar .list-group-item.active { background-color: #495057; color: white; }
        .profile-img { 
            width: 150px; 
            height: 150px; 
            object-fit: cover; 
            border-radius: 50%; 
            border: 3px solid #198754; 
            margin-bottom: 20px; 
        }
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
                <a href="{{ route('about') }}" class="list-group-item list-group-item-action active">
                    <i class="fa-solid fa-circle-info me-2"></i>About
                </a>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 main-content">
            <h1 class="mb-4"><i class="fa-solid fa-user me-2 text-success"></i>Tentang Aplikasi</h1>

            <!-- Foto Profil -->
            <img src="{{ asset('images/profil.jpg') }}" alt="Foto Anda" class="profile-img">

            <!-- Data Diri -->
            <h3 class="text-success">AZZA SYARIFAH LUBNAH</h3>
            <p><strong>NIM:</strong> 2331730037</p>
            <p><strong>Tanggal Pembuatan Aplikasi:</strong> {{ date('d-m-Y', strtotime('2025-09-24')) }}</p>

            <hr>
            <p class="text-muted">Aplikasi ini dibuat sebagai tugas untuk mengelola arsip surat dengan fitur pencatatan, pengarsipan, dan pengelolaan kategori surat.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

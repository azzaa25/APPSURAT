<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\KategoriSuratController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama langsung ke daftar arsip surat
Route::get('/', [ArsipSuratController::class, 'index'])->name('home');

// Resource untuk Arsip Surat (CRUD otomatis: index, create, store, show, edit, update, destroy)
Route::resource('arsip_surat', ArsipSuratController::class);

// Route khusus download surat (tambahan di luar resource)
Route::get('/arsip_surat/download/{id}', [ArsipSuratController::class, 'download'])->name('arsip_surat.download');

// Halaman About
Route::get('/about', [ArsipSuratController::class, 'about'])->name('about');

// Resource untuk Kategori Surat (CRUD otomatis)
Route::resource('kategori', KategoriSuratController::class);

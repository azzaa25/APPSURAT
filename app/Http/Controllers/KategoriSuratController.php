<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class KategoriSuratController extends Controller
{
    // Tampilkan semua kategori
    public function index()
    {
        $kategori = KategoriSurat::all();
        return view('kategori.index', compact('kategori'));
    }

    // Form Tambah
    public function create()
    {
        return view('kategori.form');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        KategoriSurat::create($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Form Edit
    public function edit($id)
    {
        $kategori = KategoriSurat::findOrFail($id);
        return view('kategori.form', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $kategori = KategoriSurat::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = KategoriSurat::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}

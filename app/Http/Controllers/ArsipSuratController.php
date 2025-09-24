<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipSuratController extends Controller
{
    /**
     * Tampilkan daftar arsip surat
     */
    public function index(Request $request)
    {
        $query = Surat::with('kategori_surat'); // relasi dari model Surat

        // Pencarian berdasarkan judul
        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $surat = $query->orderBy('waktu_pengarsipan', 'desc')->get();

        return view('arsip_surat.index', compact('surat'));
    }

    /**
     * Form unggah arsip baru
     */
    public function create()
    {
        $kategori_surat = KategoriSurat::all();
        return view('arsip_surat.form', compact('kategori_surat'));
    }

    /**
     * Simpan arsip baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|unique:surat,nomor_surat',
            'id_kategori' => 'required|exists:kategori_surat,id_kategori',
            'judul'       => 'required|string|max:255',
            'file'        => 'required|mimes:pdf|max:10240',
        ]);

        $filePath = $request->file('file')->store('public/surat');

        Surat::create([
            'nomor_surat'       => $request->nomor_surat,
            'id_kategori'       => $request->id_kategori,
            'judul'             => $request->judul,
            'file_path'         => $filePath,
            'waktu_pengarsipan' => now(),
        ]);

        return redirect()->route('arsip_surat.index')->with('success', 'Surat berhasil diarsipkan.');
    }

    /**
     * Tampilkan detail surat
     */
    public function show($id)
    {
        $surat = Surat::with('kategori_surat')->findOrFail($id);
        return view('arsip_surat.show', compact('surat'));
    }

    /**
     * Form edit arsip
     */
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $kategori_surat = KategoriSurat::all();
        return view('arsip_surat.edit', compact('surat', 'kategori_surat'));
    }

    /**
     * Update arsip
     */
    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'id_kategori' => 'required|exists:kategori_surat,id_kategori',
            'judul'       => 'required|string|max:255',
            'file'        => 'nullable|mimes:pdf|max:10240',
        ]);

         $data = $request->only(['id_kategori', 'judul']);

        if ($request->hasFile('file')) {
            if ($surat->file_path && Storage::exists($surat->file_path)) {
                Storage::delete($surat->file_path);
            }
            $data['file_path'] = $request->file('file')->store('public/surat');
        }

        $surat->update($data);

        return redirect()->route('arsip_surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    /**
     * Hapus arsip
     */
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        if ($surat->file_path && Storage::exists($surat->file_path)) {
            Storage::delete($surat->file_path);
        }

        $surat->delete();

        return redirect()->route('arsip_surat.index')->with('success', 'Surat berhasil dihapus.');
    }

    /**
     * Download file surat
     */
    public function download($id)
    {
        $surat = Surat::findOrFail($id);

        if (Storage::exists($surat->file_path)) {
            return Storage::download($surat->file_path, $surat->judul . '.pdf');
        }

        return abort(404, 'File tidak ditemukan.');
    }

    /**
     * Halaman About
     */
    public function about()
    {
        return view('about');
    }
}

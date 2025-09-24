<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat';
    protected $primaryKey = 'id'; // default Laravel
    public $timestamps = true;

    protected $fillable = [
        'nomor_surat',
        'id_kategori',
        'judul',
        'file_path',
        'waktu_pengarsipan',
    ];

    /**
     * Relasi ke KategoriSurat (satu surat milik satu kategori)
     */
    public function kategori_surat()
    {
        return $this->belongsTo(KategoriSurat::class, 'id_kategori', 'id_kategori');
    }
}

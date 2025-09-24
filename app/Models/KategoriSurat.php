<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSurat extends Model
{
    use HasFactory;

    protected $table = 'kategori_surat';
    protected $primaryKey = 'id_kategori';
    public $timestamps = true;

    protected $fillable = [
        'nama_kategori',
        'keterangan',
    ];

    /**
     * Relasi ke Surat (satu kategori punya banyak surat)
     */
    public function surat()
    {
        return $this->hasMany(Surat::class, 'id_kategori', 'id_kategori');
    }
}

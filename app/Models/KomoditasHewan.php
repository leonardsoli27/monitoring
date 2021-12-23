<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomoditasHewan extends Model
{
    use HasFactory;

    protected $table = 'komoditas_hewan';

    protected $fillable = [
        'asal_wilker',
        'kode_kegiatan',
        'tgl_kegiatan',
        'jalur_komoditas',
        'asal',
        'kota_asal',
        'tujuan',
        'kota_tujuan',
        'jenis_komoditas',
        'nama_komoditas',
        'jml_komoditas',
        'satuan_komoditas',
        'harga_komoditas',
        'tot_pnbp',
    ];
}

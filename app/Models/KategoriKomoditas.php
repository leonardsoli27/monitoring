<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKomoditas extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'jenis_komoditas',
        'kategori_komoditas'
    ];
}

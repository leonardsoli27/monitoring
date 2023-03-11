<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalurKomoditas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_jalur',
        'nama_jalur',
    ];
}

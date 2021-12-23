<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori_komoditas')->insert([
            'jenis_komoditas' => 'Tumbuhan',
            'kategori_komoditas' => 'Bibit Tanaman'
        ]);

        DB::table('kategori_komoditas')->insert([
            'jenis_komoditas' => 'Tumbuhan',
            'kategori_komoditas' => 'Hasil Tanaman Mati'
        ]);

        DB::table('kategori_komoditas')->insert([
            'jenis_komoditas' => 'Tumbuhan',
            'kategori_komoditas' => 'Hasil Tanaman Hidup'
        ]);

        DB::table('kategori_komoditas')->insert([
            'jenis_komoditas' => 'Hewan',
            'kategori_komoditas' => 'Hewan'
        ]);

        DB::table('kategori_komoditas')->insert([
            'jenis_komoditas' => 'Hewan',
            'kategori_komoditas' => 'B.A.H.'
        ]);

        DB::table('kategori_komoditas')->insert([
            'jenis_komoditas' => 'Hewan',
            'kategori_komoditas' => 'H.B.A.H.'
        ]);
    }
}

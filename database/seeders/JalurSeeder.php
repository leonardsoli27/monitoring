<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JalurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jalur_komoditas')->insert([
            'kode_jalur' => 'DOMAS',
            'nama_jalur' => 'Domestik Masuk'
        ]);

        DB::table('jalur_komoditas')->insert([
            'kode_jalur' => 'DOKEL',
            'nama_jalur' => 'Domestik Keluar'
        ]);

        DB::table('jalur_komoditas')->insert([
            'kode_jalur' => 'EKSPOR',
            'nama_jalur' => 'Ekspor'
        ]);

        DB::table('jalur_komoditas')->insert([
            'kode_jalur' => 'IMPOR',
            'nama_jalur' => 'Impor'
        ]);
    }
}

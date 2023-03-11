<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'lokasi' => 'Wilker Pusat',
            'admin_wilker' => 'Leonard Onnanda Soli',
            'email' => 'karantinapusat@gmail.com',
            'username' => 'superviser',
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ]);

        DB::table('users')->insert([
            'lokasi' => 'Wilker Pelabuhan Laut Ahmad Yani, Ternate',
            'admin_wilker' => 'R. Danang Setyo Pambudi',
            'email' => 'karantinapelabuhan@gmail.com',
            'username' => 'admin_pelabuhanTernate',
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ]);

        DB::table('users')->insert([
            'lokasi' => 'Wilker Bandara Sultan Babullah',
            'admin_wilker' => 'M. Rusli Samma',
            'email' => 'karantinabandara@gmail.com',
            'username' => 'admin_bandaraTernate',
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ]);

        DB::table('users')->insert([
            'lokasi' => 'Wilker Kantor Pos Ternate',
            'admin_wilker' => 'Artini',
            'email' => 'karantinapos@gmail.com',
            'username' => 'admin_posTernate',
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ]);

        DB::table('users')->insert([
            'lokasi' => 'Wilker Pelabuhan Laut Morotai',
            'admin_wilker' => 'M. Taufik Adjam',
            'email' => 'karantinamorotai@gmail.com',
            'username' => 'admin_morotai',
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ]);

        DB::table('users')->insert([
            'lokasi' => 'Wilker Pelabuhan Laut Tobelo',
            'admin_wilker' => 'Haris',
            'email' => 'karantinatobelo@gmail.com',
            'username' => 'admin_tobelo',
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ]);

        DB::table('users')->insert([
            'lokasi' => 'Wilker Pelabuhan Laut Bacan',
            'admin_wilker' => 'Apirman',
            'email' => 'karantinabacan@gmail.com',
            'username' => 'admin_bacan',
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ]);

        DB::table('users')->insert([
            'lokasi' => 'Wilker Pelabuhan Laut Sanana',
            'admin_wilker' => 'drh. Manifatur Rosjidah',
            'email' => 'karantinasanana@gmail.com',
            'username' => 'admin_sanana',
            'password' => bcrypt('password'),
            'remember_token' => \Str::random(10),
        ]);

    }
}

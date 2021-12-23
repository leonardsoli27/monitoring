<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomoditasHewanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komoditas_hewan', function (Blueprint $table) {
            $table->id('id_komoditas_hewan');
            $table->string('kode_kegiatan')->unique();
            $table->string('asal_wilker');
            $table->date('tgl_kegiatan');
            $table->string('jalur_komoditas'); // domas, dokel, import, ekspor
            $table->string('asal');
            $table->string('kota_asal');
            $table->string('tujuan');
            $table->string('kota_tujuan');
            $table->string('jenis_komoditas'); // Hewan, BAH, HBAH
            $table->string('nama_komoditas');
            $table->integer('jml_komoditas');
            $table->string('satuan_komoditas');
            $table->integer('harga_komoditas')->nullable();
            $table->integer('tot_pnbp');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komoditas_hewan');
    }
}

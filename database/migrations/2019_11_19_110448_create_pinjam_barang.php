<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('kegiatan');
            $table->integer('id_barang');
            $table->integer('jumlah');
            $table->unsignedInteger('id_satuan');
            $table->unsignedInteger('id_laporan');

            // $table->foreign('id_barang')->references('id')->on('barang');
            // $table->foreign('id_satuan')->references('id')->on('satuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjam_barang');
    }
}

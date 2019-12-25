<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_barang');
            $table->string('spesifikasi');
            $table->integer('jumlah');
            $table->integer('id_satuan')->unsigned()->nullable();
            $table->integer('harga');
            $table->integer('id_laporan')->unsigned()->nullable();

            $table->foreign('id_satuan')->references('id')->on('satuan')->onDelete('set null');
            $table->foreign('id_laporan')->references('id')->on('laporan_pengadaan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaan');
    }
}

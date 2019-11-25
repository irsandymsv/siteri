<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePinjamRuang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_ruang', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('kegiatan');
            $table->integer('id_ruang');
            $table->unsignedInteger('id_laporan');

            // $table->foreign('id_barang')->references('id')->on('ruang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjam_ruang');
    }
}

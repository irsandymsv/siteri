<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataRuang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ruang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_ruang');
            $table->string('nama_ruang');
            $table->integer('kuota');
            $table->integer('idstatus_fk')->unsigned()->nullable();
            // keterangan
            // 1 => tetap (tidak mungkin dipinjam)
            // 2 => bergerak (mungkin dipinjam)

            $table->foreign('idstatus_fk')->references('id')->on('status_barang_ruang')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_ruang');
    }
}

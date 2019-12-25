<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailDataBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_data_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal');
            $table->integer('idbarang_fk')->unsigned()->nullable();
            $table->string('merk_barang');
            $table->integer('nup');
            $table->integer('idruang_fk')->unsigned()->nullable();
            $table->integer('idstatus_fk')->unsigned()->nullable();
            // keterangan
            // 1 => tetap (tidak mungkin dipinjam)
            // 2 => bergerak (mungkin dipinjam)


            $table->foreign('idbarang_fk')->references('id')->on('data_barang')->onDelete('set null');
            $table->foreign('idruang_fk')->references('id')->on('data_ruang')->onDelete('set null');
            $table->foreign('idstatus_fk')->references('id')->on('status_barang_ruang')->onDelete('set null');
        });
    }
    public function down()
    {
        Schema::dropIfExists('detail_data_barang');
    }
}

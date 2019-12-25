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
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->time('jam_mulai');
            $table->time('jam_berakhir');
            $table->string('kegiatan');
            $table->integer('iddetail_data_barang_fk')->unsigned()->nullable();
            $table->integer('jumlah');
            $table->integer('idsatuan_fk')->unsigned()->nullable();

            $table->foreign('iddetail_data_barang_fk')->references('id')->on('detail_data_barang')->onDelete('set null');
            $table->foreign('idsatuan_fk')->references('id')->on('satuan')->onDelete('set null');
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

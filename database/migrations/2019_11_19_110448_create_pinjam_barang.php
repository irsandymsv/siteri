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
            $table->integer('iddatadetail_barang_fk')->unsigned()->nullable();
            $table->integer('jumlah');
            $table->integer('idsatuan_fk')->unsigned()->nullable();

            $table->foreign('iddatadetail_barang_fk')->references('id')->on('datadetail_barang')->onDelete('set null');
            $table->foreign('idsatuan_fk')->references('id')->on('satuan')->onDelete('set null');

            //SELECT `tanggal mulai`, `tanggal berakhir`, `jam mulai`, `jam berakhir`, `kegiatan`, dbrg.namabarang, ddbrg.merk_barang, `jumlah`, satuan.satuan FROM `pinjam_barang` JOIN datadetail_barang ddbrg ON iddatadetail_barang_fk = ddbrg.id JOIN databarang dbrg ON ddbrg.idbarang_fk = dbrg.id JOIN satuan ON idsatuan_fk=satuan.id WHERE pinjam_barang.id=1
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

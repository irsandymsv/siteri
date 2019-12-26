<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPinjamBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pinjam_barang', function (Blueprint $table) {
            $table->integer('idpinjam_barang_fk')->unsigned()->nullable();
            $table->integer('iddetail_data_barang_fk')->unsigned()->nullable();
            $table->integer('jumlah');
            $table->integer('idsatuan_fk')->unsigned()->nullable();

            $table->foreign('idpinjam_barang_fk')->references('id')->on('pinjam_barang')->onDelete('set null');
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
        Schema::dropIfExists('detail_pinjam_barang');
    }
}

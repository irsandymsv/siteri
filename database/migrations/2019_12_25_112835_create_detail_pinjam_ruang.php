<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPinjamRuang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pinjam_ruang', function (Blueprint $table) {
            $table->integer('idpinjam_ruang_fk')->unsigned()->nullable();
            $table->integer('idruang_fk')->unsigned()->nullable();

            $table->foreign('idpinjam_ruang_fk')->references('id')->on('pinjam_ruang')->onDelete('set null');
            $table->foreign('idruang_fk')->references('id')->on('data_ruang')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_pinjam_ruang');
    }
}

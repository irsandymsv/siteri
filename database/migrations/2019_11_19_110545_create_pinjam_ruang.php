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
            $table->date('tanggal mulai');
            $table->date('tanggal berakhir');
            $table->time('jam mulai');
            $table->time('jam berakhir');
            $table->string('kegiatan');
            $table->integer('jumlahpeserta');
            $table->integer('idruang_fk')->unsigned()->nullable();

            $table->foreign('idruang_fk')->references('id')->on('dataruang')->onDelete('set null');
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

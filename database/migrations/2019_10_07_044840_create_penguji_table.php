<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengujiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penguji', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_detail_sk');
            $table->string('id_penguji_utama')->length(25);
            $table->string('id_penguji_pendamping')->length(25);

            $table->foreign('id_detail_sk')->references('id')->on('detail_sk')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_penguji_utama')->references('no_pegawai')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_penguji_pendamping')->references('no_pegawai')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penguji');
    }
}

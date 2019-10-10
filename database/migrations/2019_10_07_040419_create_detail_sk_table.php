<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sk', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_sk_akademik')->nullable();
            $table->string('nama_mhs')->length(40);
            $table->string('nim', 20);
            $table->unsignedInteger('id_bagian')->nullable();
            $table->string('judul');
            $table->string('id_pembimbing_utama')->length(25)->nullable();
            $table->string('id_pembimbing_pendamping')->length(25)->nullable();
            $table->string('id_penguji_utama')->length(25)->nullable();
            $table->string('id_penguji_pendamping')->length(25)->nullable();

            $table->foreign('id_sk_akademik')->references('id')->on('sk_akademik')->onDelete('cascade');
            $table->foreign('id_bagian')->references('id')->on('bagian')->onDelete('set  null');
            $table->foreign('id_pembimbing_utama')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_pembimbing_pendamping')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_penguji_utama')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_penguji_pendamping')->references('no_pegawai')->on('users')->onDelete('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_sk');
    }
}

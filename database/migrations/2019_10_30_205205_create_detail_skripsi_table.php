<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_skripsi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('judul')->nullable();
            $table->text('judul_inggris')->nullable();
            $table->string('nim')->length(14)->nullable();
            $table->string('id_sk_sempro')->length(25)->nullable();
            $table->string('id_sk_skripsi')->length(25)->nullable();
            $table->string('id_pembimbing_utama')->length(25)->nullable();
            $table->string('id_pembimbing_pendamping')->length(25)->nullable();
            $table->string('id_penguji_utama')->length(25)->nullable();
            $table->string('id_penguji_pendamping')->length(25)->nullable();
            $table->string('id_pembahas1')->length(25)->nullable();
            $table->string('id_pembahas2')->length(25)->nullable();
            $table->UnsignedInteger('id_keris')->nullable();
            $table->UnsignedInteger('id_sk_honor')->nullable();
            $table->UnsignedInteger('id_surat_tugas_pembimbing')->nullable();
            $table->UnsignedInteger('id_surat_tugas_pembahas')->nullable();
            $table->UnsignedInteger('id_surat_tugas_penguji')->nullable();

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('set null');
            $table->foreign('id_sk_sempro')->references('no_surat')->on('sk_sempro')->onDelete('set null');
            $table->foreign('id_sk_skripsi')->references('no_surat')->on('sk_skripsi')->onDelete('set null');
            $table->foreign('id_pembimbing_utama')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_pembimbing_pendamping')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_penguji_utama')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_penguji_pendamping')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_pembahas1')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_pembahas2')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_keris')->references('id')->on('keris')->onDelete('set null');
            $table->foreign('id_sk_honor')->references('id')->on('sk_honor')->onDelete('set null');
            $table->foreign('id_surat_tugas_pembimbing')->references('id')->on('surat_tugas')->onDelete('set null');
            $table->foreign('id_surat_tugas_pembahas')->references('id')->on('surat_tugas')->onDelete('set null');
            $table->foreign('id_surat_tugas_penguji')->references('id')->on('surat_tugas')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_skripsi');
    }
}

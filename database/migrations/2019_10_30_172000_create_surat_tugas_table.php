<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_tugas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger("id_tipe_surat_tugas")->nullable();
            $table->unsignedInteger("id_status_surat_tugas")->nullable();
            $table->string('no_surat')->length(25);
            $table->tinyInteger('verif_ktu')->default(0);
            $table->string('id_dosen1')->length(25)->nullable();
            $table->string('id_dosen2')->length(25)->nullable();
            $table->unsignedBigInteger('id_detail_skripsi')->nullable();
            $table->dateTime('tanggal')->nullable();
            $table->string('tempat')->length(50)->nullable();
            $table->text("pesan_revisi")->nullable();
            $table->timestamps();

            $table->foreign('id_tipe_surat_tugas')->references('id')->on('tipe_surat_tugas')->onDelete('set null');
            $table->foreign('id_dosen1')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_dosen2')->references('no_pegawai')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_tugas');
    }
}

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
            $table->increments('id');
            $table->unsignedInteger("id_tipe_surat_tugas")->nullable();
            $table->unsignedInteger("id_status_surat_tugas")->nullable();
            $table->string('no_surat')->length(25);
            $table->tinyInteger('verif_ktu')->default(0);
            $table->text("pesan_revisi")->nullable();
            $table->timestamps();

            $table->foreign('id_tipe_surat_tugas')->references('id')->on('tipe_surat_tugas')->onDelete('set null');
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

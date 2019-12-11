<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_skripsi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_surat_penguji')->length(25);
            $table->string('no_surat_pembimbing')->length(25);
            $table->unsignedSmallInteger('id_status_sk')->nullable();
            $table->date('tgl_sk_pembimbing')->nullable();
            $table->date('tgl_sk_penguji')->nullable();
            $table->tinyInteger('verif_ktu')->nullable();
            $table->text("pesan_revisi")->nullable();
            $table->unsignedInteger('id_template_penguji')->nullable();
            $table->unsignedInteger('id_template_pembimbing')->nullable();
            $table->UnsignedInteger('id_sk_honor')->nullable();
            $table->timestamps();

            $table->foreign('id_status_sk')->references('id')->on('status_sk')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sk_skripsi');
    }
}

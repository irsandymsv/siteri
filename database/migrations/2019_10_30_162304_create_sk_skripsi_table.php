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
            $table->string('no_surat')->length(25)->primary();
            $table->unsignedSmallInteger('id_status_sk')->nullable();
            $table->date('tgl_sk_pembimbing')->nullable();
            $table->date('tgl_sk_penguji')->nullable();
            $table->tinyInteger('verif_ktu')->nullable();
            $table->string('pesan_revisi')->nullable();
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

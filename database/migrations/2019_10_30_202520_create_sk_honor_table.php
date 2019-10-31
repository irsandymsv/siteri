<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkHonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_honor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_tipe_sk')->nullable();
            $table->unsignedSmallInteger('id_status_sk_honor')->nullable();
            $table->unsignedInteger('id_honor_pembimbing1')->nullable();
            $table->unsignedInteger('id_honor_pembimbing2')->nullable();
            $table->unsignedInteger('id_honor_penguji')->nullable();
            $table->unsignedInteger('id_honor_pembahas')->nullable();
            $table->tinyInteger('verif_bpp')->nullable();
            $table->tinyInteger('verif_ktu')->nullable();
            $table->tinyInteger('verif_wadek2')->nullable();
            $table->timestamps();

            $table->foreign('id_tipe_sk')->references('id')->on('tipe_sk')->onDelete('set null');
            $table->foreign('id_status_sk_honor')->references('id')->on('status_sk_honor')->onDelete('set null');
            $table->foreign('id_honor_pembimbing1')->references('id')->on('histori_besaran_honor')->onDelete('set null');
            $table->foreign('id_honor_pembimbing2')->references('id')->on('histori_besaran_honor')->onDelete('set null');
            $table->foreign('id_honor_penguji')->references('id')->on('histori_besaran_honor')->onDelete('set null');
            $table->foreign('id_honor_pembahas')->references('id')->on('histori_besaran_honor')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sk_honor');
    }
}

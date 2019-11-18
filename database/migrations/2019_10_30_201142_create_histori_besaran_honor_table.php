<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriBesaranHonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histori_besaran_honor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_nama_honor')->nullable();
            $table->unsignedBigInteger('jumlah_honor');
            $table->timestamps();

            $table->foreign('id_nama_honor')->references('id')->on('nama_honor')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histori_besaran_honor');
    }
}

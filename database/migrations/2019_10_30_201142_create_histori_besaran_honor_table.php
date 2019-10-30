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
            $table->unsignedInteger('id_besaran_honor')->nullabel();
            $table->unsignedBigInteger('jumlah_honor');
            $table->timestamps();

            $table->foreign('id_besaran_honor')->references('id')->on('besaran_honor')->onDelete('set null');
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

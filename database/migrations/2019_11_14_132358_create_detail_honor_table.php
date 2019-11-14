<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailHonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_honor', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_sk_honor')->nullable();
            $table->unsignedInteger('id_histori_besaran_honor')->nullable();
            $table->timestamps();

            $table->foreign('id_sk_honor')->references('id')->on('sk_honor')->onDelete('set null');
            $table->foreign('id_histori_besaran_honor')->references('id')->on('histori_besaran_honor')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_honor');
    }
}

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
            $table->unsignedSmallInteger('id_status_sk_honor')->default(1)->nullable();
            $table->tinyInteger('verif_bpp')->nullable()->default(0);
            $table->tinyInteger('verif_ktu')->nullable()->default(0);
            $table->tinyInteger('verif_wadek2')->nullable()->default(0);
            $table->timestamps();


            $table->foreign('id_status_sk_honor')->references('id')->on('status_sk_honor')->onDelete('set null');
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

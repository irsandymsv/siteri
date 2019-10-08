<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sk', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_sk_akademik');
            $table->string('nama_mhs')->length(40);
            $table->string('nim', 20);
            $table->unsignedTinyInteger('id_bagian');
            $table->string('judul');

            $table->foreign('id_sk_akademik')->references('id')->on('sk_akademik')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_bagian')->references('id')->on('bagian')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_sk');
    }
}

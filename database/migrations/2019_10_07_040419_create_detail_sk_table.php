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
            $table->unsignedInteger('id_sk_akademik')->nullable();
            $table->string('nama_mhs')->length(40);
            $table->string('nim', 20);
            $table->unsignedInteger('id_bagian')->nullable();
            $table->string('judul');

            $table->foreign('id_sk_akademik')->references('id')->on('sk_akademik')->onDelete('cascade');
            $table->foreign('id_bagian')->references('id')->on('bagian')->onDelete('set null');
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

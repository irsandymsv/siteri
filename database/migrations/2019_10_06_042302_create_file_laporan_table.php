<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('dir');
            $table->unsignedInteger('id_laporan')->nullable();

            $table->foreign('id_laporan')->references('id')->on('laporan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_laporan');
    }
}

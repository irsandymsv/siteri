<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skripsi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nim')->length(14)->nullable();
            $table->unsignedInteger('id_status_skripsi')->nullable();

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('set null');
            $table->foreign('id_status_skripsi')->references('id')->on('status_skripsi')->onDelete('set null');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skripsi');
    }
}

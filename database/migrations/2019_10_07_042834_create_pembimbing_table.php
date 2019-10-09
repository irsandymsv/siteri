<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembimbingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembimbing', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_detail_sk');
            $table->string('id_pembimbing_utama')->length(25)->nullable();
            $table->string('id_pembimbing_pendamping')->length(25)->nullable();

            $table->foreign('id_detail_sk')->references('id')->on('detail_sk')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pembimbing_utama')->references('no_pegawai')->on('users')->onDelete('set null');
            $table->foreign('id_pembimbing_pendamping')->references('no_pegawai')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembimbing');
    }
}

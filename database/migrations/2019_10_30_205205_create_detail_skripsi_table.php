<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_skripsi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('judul')->nullable();
            $table->text('judul_inggris')->nullable();
            $table->string('id_sk_sempro')->length(25)->nullable();
            $table->UnsignedBigInteger('id_sk_skripsi')->nullable();
            $table->UnsignedInteger('id_keris')->nullable();
            $table->UnsignedInteger('id_skripsi')->nullable();
            $table->timestamps();

            $table->foreign('id_sk_sempro')->references('no_surat')->on('sk_sempro')->onDelete('set null');
            $table->foreign('id_sk_skripsi')->references('id')->on('sk_skripsi')->onDelete('set null');
            $table->foreign('id_keris')->references('id')->on('keris')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_skripsi');
    }
}

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
            $table->unsignedTinyInteger('id_tipe_sk')->nullable();
            $table->unsignedInteger('id_status_sk_honor')->nullable();
            $table->unsignedBigInteger('honor_pembimbing');
            $table->unsignedBigInteger('honor_penguji');
            $table->boolean('verif_ktu')->default(false);
            $table->boolean('verif_kebag_keuangan')->default(false);
            $table->boolean('verif_wadek2')->default(false);            
            $table->boolean('verif_dekan')->default(false);
            $table->text('pesan_revisi')->nullable();
            $table->timestamps();

            $table->foreign('id_tipe_sk')->references('id')->on('tipe_sk')->onDelete('set null');

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

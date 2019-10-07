<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkAkademikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_akademik', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('id_tipe_sk');
            $table->string('jenis', 30);
            $table->string('status', 100);
            $table->boolean('verif_ktu')->default(false);
            $table->boolean('verif_dekan')->default(false);
            $table->timestamps();

            $table->foreign('id_tipe_sk')->references('id')->on('tipe_sk')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sk_akademik');
    }
}

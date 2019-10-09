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
            $table->unsignedTinyInteger('id_tipe_sk')->nullable();
            $table->unsignedInteger('id_status_sk_akademik')->nullable();
            // $table->string('id_user', 25);
            $table->boolean('verif_ktu')->default(false);
            $table->boolean('verif_dekan')->default(false);
            $table->timestamps();

            $table->foreign('id_tipe_sk')->references('id')->on('tipe_sk')->onDelete('set null');
            // $table->foreign('id_user')->references('no_pegawai')->on('users')->onDelete('cascade')->onUpdate('cascade');
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

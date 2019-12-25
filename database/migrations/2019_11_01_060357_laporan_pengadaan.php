<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaporanPengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_pengadaan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keterangan');
            $table->boolean('verif_wadek2')->default(false);
            $table->timestamp('dibuat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_pengadaan');
    }
}

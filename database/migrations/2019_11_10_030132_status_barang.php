<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class StatusBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
        });

        DB::table('status_barang')->insert(
            array(
                array(
                    'status' => 'Tetap (tidak mungkin dipinjam)'
                ),
                array(
                    'status' => 'Bergerak (mungkin dipinjam)'
                )
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_barang');
    }
}

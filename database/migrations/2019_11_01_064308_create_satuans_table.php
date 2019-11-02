<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSatuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satuan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('satuan');
        });

        DB::table('satuan')->insert(
            array(
                array(
                    'satuan' => 'Buah'
                ),
                array(
                    'satuan' => 'Lusin'
                ),
                array(
                    'satuan' => 'Kodi'
                ),
                array(
                    'satuan' => 'Gross'
                ),
                array(
                    'satuan' => 'Rim'
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
        Schema::dropIfExists('satuan');
    }
}

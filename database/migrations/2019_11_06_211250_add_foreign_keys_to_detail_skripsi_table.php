<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDetailSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_skripsi', function (Blueprint $table) {
            $table->foreign('id_skripsi')->references('id')->on('skripsi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_skripsi', function (Blueprint $table) {
            $table->dropForeign('skripsi_id_skripsi_foreign');
        });
    }
}

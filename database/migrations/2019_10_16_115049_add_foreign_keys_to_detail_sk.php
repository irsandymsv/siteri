<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToDetailSk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_sk', function (Blueprint $table) {
            $table->foreign('id_sk_honor')->references('id')->on('sk_honor')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_sk', function (Blueprint $table) {
            $table->dropForeign('detail_sk_id_sk_honor_foreign');
        });
    }
}

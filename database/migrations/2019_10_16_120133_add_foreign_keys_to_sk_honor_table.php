<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSkHonorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sk_honor', function (Blueprint $table) {
            $table->foreign('id_status_sk_honor')->references('id')->on('status_sk_honor')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sk_honor', function (Blueprint $table) {
            $table->dropForeign('sk_honor_id_status_sk_honor_foreign');
        });
    }
}

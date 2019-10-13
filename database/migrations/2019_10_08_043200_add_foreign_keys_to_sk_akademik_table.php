<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSkAkademikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sk_akademik', function (Blueprint $table) {
            $table->foreign('id_status_sk_akademik')->references('id')->on('status_sk_akademik')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sk_akademik', function (Blueprint $table) {
            $table->dropForeign('sk_akademik_id_status_sk_akademik_foreign');
        });
    }
}

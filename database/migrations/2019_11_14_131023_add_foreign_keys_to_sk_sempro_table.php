<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSkSemproTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sk_sempro', function (Blueprint $table) {
            $table->foreign('id_template')->references('id')->on('template')->onDelete('set null');
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
        Schema::table('sk_sempro', function (Blueprint $table) {
            $table->dropForeign('sk_sempro_id_template_foreign');
            $table->dropForeign('sk_sempro_id_sk_honor_foreign');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSkSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sk_skripsi', function (Blueprint $table) {
            $table->foreign('id_template_pembimbing')->references('id')->on('template')->onDelete('set null');
            $table->foreign('id_template_penguji')->references('id')->on('template')->onDelete('set null');
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
        Schema::table('sk_skripsi', function (Blueprint $table) {
            $table->dropForeign('sk_skripsi_id_template_pembimbing_foreign');
            $table->dropForeign('sk_skripsi_id_template_penguji_ foreign');
            $table->dropForeign('sk_skripsi_id_sk_honor_foreign');
        });
    }
}

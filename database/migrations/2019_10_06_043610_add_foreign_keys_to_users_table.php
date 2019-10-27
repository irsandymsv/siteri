<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('id_jabatan')->references('id')->on('jabatan')->onDelete('set null');
            $table->foreign('id_bagian')->references('id')->on('bagian')->onDelete('set null');
            $table->foreign('id_pangkat')->references('id')->on('pangkat')->onDelete('set null');
            $table->foreign('id_golongan')->references('id')->on('golongan')->onDelete('set null');
            $table->foreign('id_fungsional')->references('id')->on('fungsional')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_id_jabatan_foreign');
            $table->dropForeign('users_id_bagian_foreign');
            $table->dropForeign('users_id_pangkat_foreign');
            $table->dropForeign('users_id_golongan_foreign');
            $table->dropForeign('users_id_fungsional_foreign');
        });
    }
}

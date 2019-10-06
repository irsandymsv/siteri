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
            $table->foreign('id_jabatan')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_bagian')->references('id')->on('bagian')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pangkat')->references('id')->on('pangkat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_golongan')->references('id')->on('golongan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_fungsional')->references('id')->on('fungsional')->onDelete('cascade')->onUpdate('cascade');
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

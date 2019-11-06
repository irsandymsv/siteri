<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToSuratTugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('surat_tugas', function (Blueprint $table) {
            $table->foreign('id_status_surat_tugas')->references('id')->on('status_surat_tugas')->onDelete('set null');
            $table->foreign('id_detail_skripsi')->references('id')->on('detail_skripsi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('surat_tugas', function (Blueprint $table) {
            $table->dropForeign('status_surat_tugas_id_status_surat_tugas_foreign');
            $table->dropForeign('detail_skripsi_id_detail_skripsi_foreign');

        });
    }
}

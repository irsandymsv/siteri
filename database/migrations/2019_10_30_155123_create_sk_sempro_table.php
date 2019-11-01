<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkSemproTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sk_sempro', function (Blueprint $table) {
            $table->string('no_surat')->length(25)->primary();
            $table->unsignedSmallInteger('id_status_sk')->nullable();
            $table->date('tgl_sempro1')->nullable();
            $table->date('tgl_sempro2')->nullable();
            $table->tinyInteger('verif_ktu')->nullable();
            $table->text("pesan_revisi")->nullable();
            $table->timestamps();

            $table->foreign('id_status_sk')->references('id')->on('status_sk')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sk_sempro');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->string('no_pegawai', 25)->primary();
            $table->string('nama', 40);
            $table->string('npwp', 15)->nullable();
            $table->string('bpjs', 13)->nullable();
            $table->tinyInteger('is_dosen')->length(1)->nullable();
            $table->unsignedInteger('id_jabatan')->nullable();
            $table->unsignedInteger('id_bagian')->nullable();
            $table->unsignedInteger('id_pangkat')->nullable();
            $table->unsignedInteger('id_golongan')->nullable();
            $table->unsignedInteger('id_fungsional')->nullable();
            $table->rememberToken();
            
            // $table->bigIncrements('id');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

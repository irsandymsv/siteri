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
            $table->unsignedInteger('id_jabatan');
            $table->unsignedInteger('id_bagian');
            $table->unsignedInteger('id_pangkat');
            $table->unsignedInteger('id_golongan');
            $table->unsignedInteger('id_fungsional');
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

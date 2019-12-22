<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataruang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataruang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('koderuang');
            $table->string('namaruang');
            $table->integer('kuota');
            $table->integer('idstatus_fk')->unsigned()->nullable();
            // keterangan
            // 1 => tetap (tidak mungkin dipinjam)
            // 2 => bergerak (mungkin dipinjam)

            $table->foreign('idstatus_fk')->references('id')->on('status_barang_ruang')->onDelete('set null');
        });

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1014',
            'namaruang' => 'UMUM & PERLENGKAPAN',
            'kuota' => '0'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2010',
            'namaruang' => 'LABORATORIUM GIS',
            'kuota' => '0'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1008',
            'namaruang' => 'UMUM & PERLENGKAPAN 1',
            'kuota' => '0'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1009',
            'namaruang' => 'KEUANGAN DAN KEPEGAWAIAN',
            'kuota' => '0'

        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1007',
            'namaruang' => 'AKADEMIK DAN KEMAHASISWAAN',
            'kuota' => '0'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2006',
            'namaruang' => 'LABORATORIUM BASIS DATA',
            'kuota' => '40'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1005',
            'namaruang' => 'LABORATORIUM RPL',
            'kuota' => '40'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2005',
            'namaruang' => 'LABORATORIUM SELF ACCESS CENTER',
            'kuota' => '40'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1017',
            'namaruang' => 'RUANG BACA',
            'kuota' => '0'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => 'R.XXXX',
            'namaruang' => 'RUANGAN BELUM ADA',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1002',
            'namaruang' => 'RUANG SEKRETARIS',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1010',
            'namaruang' => 'RUANG KASIE. TATA USAHA',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1011',
            'namaruang' => 'LABORATORIUM PEMROGRAMAN',
            'kuota' => '20'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A12007',
            'namaruang' => 'BEM PSSI',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1016',
            'namaruang' => 'RUANG DOSEN',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1013',
            'namaruang' => 'LANTAI 1',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2009',
            'namaruang' => 'LANTAI 2',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2008',
            'namaruang' => 'GUDANG',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2001',
            'namaruang' => 'KULIAH 1B',
            'kuota' => '50'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2003',
            'namaruang' => 'KULIAH 3',
            'kuota' => '40'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2004',
            'namaruang' => 'KULIAH 4',
            'kuota' => '40'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1015',
            'namaruang' => 'KULIAH 5',
            'kuota' => '50'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1001',
            'namaruang' => 'DEKAN',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2011',
            'namaruang' => 'KULIAH 1A',
            'kuota' => '50'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1012',
            'namaruang' => 'SERVER',
            'kuota' => '0'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2002',
            'namaruang' => 'KULIAH 2',
            'kuota' => '40'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1004',
            'namaruang' => 'RUANG RAPAT/SIDANG',
            'kuota' => '20'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dataruang');
    }
}

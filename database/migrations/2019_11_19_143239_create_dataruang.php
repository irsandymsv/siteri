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
        });

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1014',
            'namaruang' => 'UMUM & PERLENGKAPAN'
        ));

        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2010',
            'namaruang' => 'LABORATORIUM GIS'
        )); 
        
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1008',
            'namaruang' => 'UMUM & PERLENGKAPAN 1'
        ));
        
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1009',
            'namaruang' => 'KEUANGAN DAN KEPEGAWAIAN'
        ));
        
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1007',
            'namaruang' => 'AKADEMIK DAN KEMAHASISWAAN'
        ));
        
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2006',
            'namaruang' => 'LABORATORIUM BASIS DATA'
        ));
        
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1005',
            'namaruang' => 'LABORATORIUM RPL'
        ));
        
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2005',
            'namaruang' => 'LABORATORIUM SELF ACCESS CENTER'
        ));
        
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1017',
            'namaruang' => 'RUANG BACA'
        ));
        
        DB::table('dataruang')->insert(array(
            'koderuang' => 'R.XXXX',
            'namaruang' => 'RUANGAN BELUM ADA'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1002',
            'namaruang' => 'RUANG SEKRETARIS'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1010',
            'namaruang' => 'RUANG KASIE. TATA USAHA'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1011',
            'namaruang' => 'LABORATORIUM PEMROGRAMAN'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A12007',
            'namaruang' => 'BEM PSSI'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1016',
            'namaruang' => 'RUANG DOSEN'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1013',
            'namaruang' => 'LANTAI 1'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2009',
            'namaruang' => 'LANTAI 2'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2008',
            'namaruang' => 'GUDANG'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2001',
            'namaruang' => 'KULIAH 1B'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2003',
            'namaruang' => 'KULIAH 3'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2004',
            'namaruang' => 'KULIAH 4'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1015',
            'namaruang' => 'KULIAH 5'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1001',
            'namaruang' => 'DEKAN'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2011',
            'namaruang' => 'KULIAH 1A'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A1012',
            'namaruang' => 'SERVER'
        ));
        DB::table('dataruang')->insert(array(
            'koderuang' => '024A2002',
            'namaruang' => 'KULIAH 2'
        ));
        
        DB::table('dataruang')->insert(
            array(
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '30'
                ),
                array(
                    'kuota' => '40'
                ),
                array(
                    'kuota' => '40'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '30'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '50'
                ),
                array(
                    'kuota' => '40'
                ),
                array(
                    'kuota' => '40'
                ),
                array(
                    'kuota' => '50'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '50'
                ),
                array(
                    'kuota' => '0'
                ),
                array(
                    'kuota' => '40'
                ),
            )
        );
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

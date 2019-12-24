<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataRuangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1014',
            'nama_ruang' => 'UMUM & PERLENGKAPAN',
            'kuota' => '0'
        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2010',
            'nama_ruang' => 'LABORATORIUM GIS',
            'kuota' => '0'
        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1008',
            'nama_ruang' => 'UMUM & PERLENGKAPAN 1',
            'kuota' => '0'
        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1009',
            'nama_ruang' => 'KEUANGAN DAN KEPEGAWAIAN',
            'kuota' => '0'

        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1007',
            'nama_ruang' => 'AKADEMIK DAN KEMAHASISWAAN',
            'kuota' => '0'
        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2006',
            'nama_ruang' => 'LABORATORIUM BASIS DATA',
            'kuota' => '40'
        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1005',
            'nama_ruang' => 'LABORATORIUM RPL',
            'kuota' => '40'
        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2005',
            'nama_ruang' => 'LABORATORIUM SELF ACCESS CENTER',
            'kuota' => '40'
        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1017',
            'nama_ruang' => 'RUANG BACA',
            'kuota' => '0'
        ));

        DB::table('data_ruang')->insert(array(
            'kode_ruang' => 'R.XXXX',
            'nama_ruang' => 'RUANGAN BELUM ADA',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1002',
            'nama_ruang' => 'RUANG SEKRETARIS',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1010',
            'nama_ruang' => 'RUANG KASIE. TATA USAHA',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1011',
            'nama_ruang' => 'LABORATORIUM PEMROGRAMAN',
            'kuota' => '20'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A12007',
            'nama_ruang' => 'BEM PSSI',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1016',
            'nama_ruang' => 'RUANG DOSEN',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1013',
            'nama_ruang' => 'LANTAI 1',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2009',
            'nama_ruang' => 'LANTAI 2',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2008',
            'nama_ruang' => 'GUDANG',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2001',
            'nama_ruang' => 'KULIAH 1B',
            'kuota' => '50'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2003',
            'nama_ruang' => 'KULIAH 3',
            'kuota' => '40'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2004',
            'nama_ruang' => 'KULIAH 4',
            'kuota' => '40'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1015',
            'nama_ruang' => 'KULIAH 5',
            'kuota' => '50'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1001',
            'nama_ruang' => 'DEKAN',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2011',
            'nama_ruang' => 'KULIAH 1A',
            'kuota' => '50'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1012',
            'nama_ruang' => 'SERVER',
            'kuota' => '0'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A2002',
            'nama_ruang' => 'KULIAH 2',
            'kuota' => '40'
        ));
        DB::table('data_ruang')->insert(array(
            'kode_ruang' => '024A1004',
            'nama_ruang' => 'RUANG RAPAT/SIDANG',
            'kuota' => '20'
        ));
    }
}

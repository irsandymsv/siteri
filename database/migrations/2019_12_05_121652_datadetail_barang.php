<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatadetailBarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datadetail_barang', function (Blueprint $table) {

            $table->date('tanggal');
            $table->integer('idbarang_fk')->unsigned()->nullable();
            $table->string('merk_barang');
            $table->integer('nup');
            $table->integer('idruang_fk')->unsigned()->nullable();


            $table->foreign('idbarang_fk')->references('id')->on('databarang')->onDelete('set null');
            $table->foreign('idruang_fk')->references('id')->on('dataruang')->onDelete('set null');
        });

        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-22',
            'idbarang_fk' => '1',
            'merk_barang' => 'Single, AMP Single',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2012-12-13',
            'idbarang_fk' => '2',
            'merk_barang' => 'Media Stand HP Designjet 110/500 series 24',
            'nup' => '1',
            'idruang_fk' => '2'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '3',
            'merk_barang' => 'Royal R775-18',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2017-03-01',
            'idbarang_fk' => '4',
            'merk_barang' => 'Mesin Ketik Brother GX6750',
            'nup' => '1',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2014-11-03',
            'idbarang_fk' => '5',
            'merk_barang' => 'Newmark NM - 03C',
            'nup' => '1',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-22',
            'idbarang_fk' => '1',
            'merk_barang' => 'Single, AMP Single',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-204',
            'nup' => '2',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-204',
            'nup' => '3',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-204',
            'nup' => '4',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-204',
            'nup' => '5',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-204',
            'nup' => '6',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-204',
            'nup' => '7',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '6',
            'merk_barang' => 'DATASCRIP C13LG-7',
            'nup' => '8',
            'idruang_fk' => '6'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '6',
            'merk_barang' => 'DATASCRIP C13LG-7',
            'nup' => '9',
            'idruang_fk' => '6'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '6',
            'merk_barang' => 'DATASCRIP LTC 22',
            'nup' => '10',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '6',
            'merk_barang' => 'DATASCRIP C13LG-7',
            'nup' => '11',
            'idruang_fk' => '7'
        ));

        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-28',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B204',
            'nup' => '12',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2012-12-13',
            'idbarang_fk' => '6',
            'merk_barang' => 'Cupboard datascrip CBRG/LF05',
            'nup' => '13',
            'idruang_fk' => '2'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2012-12-13',
            'idbarang_fk' => '6',
            'merk_barang' => 'Cupboard datascrip CBRG/LF05',
            'nup' => '14',
            'idruang_fk' => '2'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2012-12-13',
            'idbarang_fk' => '6',
            'merk_barang' => 'Cupboard datascrip CBRG/ET C22',
            'nup' => '15',
            'idruang_fk' => '2'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2014-12-04',
            'idbarang_fk' => '6',
            'merk_barang' => 'Lemari Arsip Brother B-20',
            'nup' => '16',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2014-12-04',
            'idbarang_fk' => '6',
            'merk_barang' => 'Lemari Arsip Brother B-20',
            'nup' => '17',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2014-12-04',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother cardek',
            'nup' => '18',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2014-12-04',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother Cardek',
            'nup' => '19',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2016-12-19',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-204',
            'nup' => '20',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2016-12-19',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-304',
            'nup' => '21',
            'idruang_fk' => '8'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2016-12-19',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-304',
            'nup' => '22',
            'idruang_fk' => '9'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2016-12-19',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-304',
            'nup' => '23',
            'idruang_fk' => '9'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2017-11-21',
            'idbarang_fk' => '6',
            'merk_barang' => 'lemari Sliding door Brother B-304',
            'nup' => '24',
            'idruang_fk' => '8'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2017-11-21',
            'idbarang_fk' => '6',
            'merk_barang' => 'lemari Arsip Brother B-203',
            'nup' => '25',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2017-11-28',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-203',
            'nup' => '26',
            'idruang_fk' => '10'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2017-11-28',
            'idbarang_fk' => '6',
            'merk_barang' => 'Brother B-203',
            'nup' => '27',
            'idruang_fk' => '10'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '2',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '3',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '4',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '5',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '6',
            'idruang_fk' => '11'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '7',
            'idruang_fk' => '11'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '8',
            'idruang_fk' => '11'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '9',
            'idruang_fk' => '12'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '10',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B-104',
            'nup' => '11',
            'idruang_fk' => 'belum nemu ruang'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '7',
            'merk_barang' => 'DATASCRIP FCD4-7',
            'nup' => '12',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '7',
            'merk_barang' => 'DATASCRIP FCD4-7',
            'nup' => '13',
            'idruang_fk' => '6'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-28',
            'idbarang_fk' => '7',
            'merk_barang' => 'Brother B104',
            'nup' => '14',
            'idruang_fk' => '13'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2014-12-04',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner  B-104',
            'nup' => '15',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2014-12-04',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner  B-104',
            'nup' => '16',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2014-12-04',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner  B-104',
            'nup' => '17',
            'idruang_fk' => '14'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2017-11-21',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner Brother B-104',
            'nup' => '18',
            'idruang_fk' => '10'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2017-11-21',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner Brother B-104',
            'nup' => '19',
            'idruang_fk' => '10'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2017-11-21',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner Brother B-104',
            'nup' => '20',
            'idruang_fk' => '10'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2019-04-05',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner  Brother B-103',
            'nup' => '21',
            'idruang_fk' => 'ruang belum ada (26)'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2019-04-05',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner  Brother B-103',
            'nup' => '22',
            'idruang_fk' => 'ruang belum ada (26)'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2019-04-05',
            'idbarang_fk' => '7',
            'merk_barang' => 'Filing Cabiner  Brother B-103',
            'nup' => '23',
            'idruang_fk' => 'ruang belum ada (26)'
        ));
        DB::table('datadetail_barang')->insert(array(
            // brangkas
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '8',
            'merk_barang' => 'Dragon DR-A1',
            'nup' => '1',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            // locker

            'tanggal' => '2011-12-01',
            'idbarang_fk' => '9',
            'merk_barang' => 'DATASCRIP LC3-7',
            'nup' => '1',
            'idruang_fk' => '6'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '9',
            'merk_barang' => 'DATASCRIP LC3-7',
            'nup' => '2',
            'idruang_fk' => '6'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '9',
            'merk_barang' => 'DATASCRIP LC3-7',
            'nup' => '3',
            'idruang_fk' => '6'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '9',
            'merk_barang' => 'DATASCRIP LC3-7',
            'nup' => '4',
            'idruang_fk' => '6'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '9',
            'merk_barang' => 'DATASCRIP LC3-7',
            'nup' => '5',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '9',
            'merk_barang' => 'DATASCRIP LC3-7',
            'nup' => '6',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '9',
            'merk_barang' => 'DATASCRIP LC3-7',
            'nup' => '7',
            'idruang_fk' => '7'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2012-12-13',
            'idbarang_fk' => '9',
            'merk_barang' => 'Alba LC-506',
            'nup' => '8',
            'idruang_fk' => '2'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2012-12-13',
            'idbarang_fk' => '9',
            'merk_barang' => 'Alba LC-506',
            'nup' => '9',
            'idruang_fk' => '2'
        ));
        DB::table('datadetail_barang')->insert(array(
            // lemari display
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '10',
            'merk_barang' => 'BROTHER B-304',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '10',
            'merk_barang' => 'BROTHER B-304',
            'nup' => '2',
            'idruang_fk' => '9'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '10',
            'merk_barang' => 'BROTHER B-304',
            'nup' => '3',
            'idruang_fk' => '9'
        ));
        DB::table('datadetail_barang')->insert(array(
            // CCTV
            'tanggal' => '2017-10-05',
            'idbarang_fk' => '11',
            'merk_barang' => 'Paket CCTV ANALOG 1 MP 720P, 1 DVR BCH',
            'nup' => '1',
            'idruang_fk' => '16'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2018-11-29',
            'idbarang_fk' => '11',
            'merk_barang' => 'CCTV 9 Kamera',
            'nup' => '2',
            'idruang_fk' => '17'
        ));
        DB::table('datadetail_barang')->insert(array(
            // white board
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '12',
            'merk_barang' => '120X240',
            'nup' => '1',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '12',
            'merk_barang' => '120X240',
            'nup' => '2',
            'idruang_fk' => 'ruang belum ada (RK2)'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '12',
            'merk_barang' => '120X240',
            'nup' => '3',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '12',
            'merk_barang' => '90X120',
            'nup' => '4',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '12',
            'merk_barang' => '90X120',
            'nup' => '5',
            'idruang_fk' => '12'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2010-03-18',
            'idbarang_fk' => '12',
            'merk_barang' => '90X120',
            'nup' => '6',
            'idruang_fk' => '7'
        ));
        DB::table('datadetail_barang')->insert(array(

            'tanggal' => '2012-12-18',
            'idbarang_fk' => '12',
            'merk_barang' => 'GM Economi DF',
            'nup' => '7',
            'idruang_fk' => '19'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2012-12-18',
            'idbarang_fk' => '12',
            'merk_barang' => 'GM Economi DF',
            'nup' => '8',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2013-02-15',
            'idbarang_fk' => '12',
            'merk_barang' => 'Nusantara',
            'nup' => '9',
            'idruang_fk' => '22'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2013-02-15',
            'idbarang_fk' => '12',
            'merk_barang' => 'Nusantara',
            'nup' => '10',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2013-02-15',
            'idbarang_fk' => '12',
            'merk_barang' => 'Nusantara',
            'nup' => '11',
            'idruang_fk' => '20'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2013-02-15',
            'idbarang_fk' => '12',
            'merk_barang' => 'Nusantara',
            'nup' => '12',
            'idruang_fk' => '21'
        ));
        DB::table('datadetail_barang')->insert(array(
            // Alat penghancur Kertas
            'tanggal' => '2012-12-13',
            'idbarang_fk' => '13',
            'merk_barang' => 'Secure Maxi 24SC',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // Alat penghancur Kertas
            'tanggal' => '2012-12-13',
            'idbarang_fk' => '13',
            'merk_barang' => 'Secure Maxi 24SC',
            'nup' => '2',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // mesin absensi
            'tanggal' => '2017-12-28',
            'idbarang_fk' => '14',
            'merk_barang' => 'FINGERSPOT REVO DUO 128BNC',
            'nup' => '1',
            'idruang_fk' => ''
        ));
        DB::table('datadetail_barang')->insert(array(
            // lASER POINTER
            'tanggal' => '2017-10-16',
            'idbarang_fk' => '15',
            'merk_barang' => 'Logitech Wireless Presenter R400',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // lASER POINTER
            'tanggal' => '2017-10-16',
            'idbarang_fk' => '15',
            'merk_barang' => 'Logitech Wireless Presenter R400',
            'nup' => '2',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2016-11-24',
            'idbarang_fk' => '16',
            'merk_barang' => 'SONY VPL EX 230',
            'nup' => '19',
            'idruang_fk' => '13'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2016-11-24',
            'idbarang_fk' => '16',
            'merk_barang' => 'SONY VPL EX 230',
            'nup' => '20',
            'idruang_fk' => '2'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2016-11-24',
            'idbarang_fk' => '16',
            'merk_barang' => 'SONY VPL EX 230',
            'nup' => '21',
            'idruang_fk' => '22'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2016-11-24',
            'idbarang_fk' => '16',
            'merk_barang' => 'SONY VPL EX 230',
            'nup' => '22',
            'idruang_fk' => '8'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2016-11-24',
            'idbarang_fk' => '16',
            'merk_barang' => 'SONY VPL EX 230',
            'nup' => '23',
            'idruang_fk' => '(RUANG 2 BELUM INPUT)'
        ));
        
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2010-11-25',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ MP575',
            'nup' => '24',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2010-12-1',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ MP575',
            'nup' => '25',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2010-12-16',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ MP515',
            'nup' => '26',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2010-12-16',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ MP670',
            'nup' => '27',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2011-06-06',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ MX810 ST',
            'nup' => '28',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ MP660',
            'nup' => '29',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2011-07-26',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ MP660',
            'nup' => '30',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ 2800 Ans',
            'nup' => '31',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '16',
            'merk_barang' => 'DELL 161011D',
            'nup' => '32',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '16',
            'merk_barang' => 'DELL 161011D',
            'nup' => '33',
            'idruang_fk' => '6'
        ));

        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2011-12-01',
            'idbarang_fk' => '16',
            'merk_barang' => 'DELL 161011D',
            'nup' => '34',
            'idruang_fk' => '20'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2012-12-18',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ 2800 Ansi',
            'nup' => '35',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2012-12-18',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ 2800 Ansi',
            'nup' => '36',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2012-12-18',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ 2800 Ansi',
            'nup' => '37',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2012-12-18',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ 2800 Ansi',
            'nup' => '38',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2012-12-18',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ 2800 Ansi',
            'nup' => '39',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2012-12-18',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ 2800 Ansi',
            'nup' => '40',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2012-12-18',
            'idbarang_fk' => '16',
            'merk_barang' => 'BENQ 2800 Ansi',
            'nup' => '41',
            'idruang_fk' => '21'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2017-10-16',
            'idbarang_fk' => '16',
            'merk_barang' => 'Infocus Projector(IN226)',
            'nup' => '42',
            'idruang_fk' => '8'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2017-10-16',
            'idbarang_fk' => '16',
            'merk_barang' => 'Infocus Projector(IN226)',
            'nup' => '43',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2017-10-16',
            'idbarang_fk' => '16',
            'merk_barang' => 'Infocus Projector(IN226)',
            'nup' => '44',
            'idruang_fk' => '8'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2017-10-16',
            'idbarang_fk' => '16',
            'merk_barang' => 'Infocus Projector(IN226)',
            'nup' => '45',
            'idruang_fk' => '8'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2017-10-16',
            'idbarang_fk' => '16',
            'merk_barang' => 'Infocus Projector(IN226)',
            'nup' => '46',
            'idruang_fk' => '8'
        ));
        DB::table('datadetail_barang')->insert(array(
            // LCD Projector/Infocus
            'tanggal' => '2017-10-16',
            'idbarang_fk' => '16',
            'merk_barang' => 'Infocus Projector(IN226)',
            'nup' => '47',
            'idruang_fk' => '8'
        ));
        DB::table('datadetail_barang')->insert(array(
            // Focusing Screen
            'tanggal' => '2017-11-14',
            'idbarang_fk' => '17',
            'merk_barang' => 'Screen Prokector G-lite Tripot 70" Size 180x180',
            'nup' => '1',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // Focusing Screen
            'tanggal' => '2017-11-14',
            'idbarang_fk' => '17',
            'merk_barang' => 'Screen Prokector G-lite Tripot 70" Size 180x180',
            'nup' => '2',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // Focusing Screen
            'tanggal' => '2017-11-24',
            'idbarang_fk' => '17',
            'merk_barang' => 'Screen Prokector G-lite Tripot 84" Size 213x213',
            'nup' => '3',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // Focusing Screen
            'tanggal' => '2017-11-14',
            'idbarang_fk' => '17',
            'merk_barang' => 'Screen Prokector G-lite Tripot 84" Size 213x213',
            'nup' => '4',
            'idruang_fk' => '18'
        ));
        DB::table('datadetail_barang')->insert(array(
            // papan pengumuman
            'tanggal' => '2011-12-28',
            'idbarang_fk' => '18',
            'merk_barang' => 'GM Announcement Board',
            'nup' => '1',
            'idruang_fk' => '16'
        ));
        DB::table('datadetail_barang')->insert(array(
            // papan pengumuman
            'tanggal' => '2011-12-28',
            'idbarang_fk' => '18',
            'merk_barang' => 'GM Announcement Board',
            'nup' => '2',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2016-07-28',
            'idbarang_fk' => '19',
            'merk_barang' => 'Meja Active MTO 120',
            'nup' => '33',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2016-07-28',
            'idbarang_fk' => '19',
            'merk_barang' => 'Meja Active MTO 120',
            'nup' => '34',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2016-07-28',
            'idbarang_fk' => '19',
            'merk_barang' => 'Meja Active MTO 120',
            'nup' => '35',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2016-07-28',
            'idbarang_fk' => '19',
            'merk_barang' => 'Meja Active MTO 120',
            'nup' => '36',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2016-07-28',
            'idbarang_fk' => '19',
            'merk_barang' => 'Meja Active MTO 120',
            'nup' => '37',
            'idruang_fk' => '15'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Profil',
            'nup' => '38',
            'idruang_fk' => '12'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '39',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '40',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '41',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '42',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '43',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '44',
            'idruang_fk' => '5'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '45',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '46',
            'idruang_fk' => '3'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '47',
            'idruang_fk' => '3'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '48',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '49',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '50',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '51',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '52',
            'idruang_fk' => '4'
        ));

        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '53',
            'idruang_fk' => '4'
        ));
        DB::table('datadetail_barang')->insert(array(
            // meja kerja kayu
            'tanggal' => '2009-12-17',
            'idbarang_fk' => '19',
            'merk_barang' => 'Kayu Jati',
            'nup' => '54',
            'idruang_fk' => '4'
        ));
//meja kayu sekretarsi







        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-22',
            'idbarang_fk' => '1',
            'merk_barang' => 'Single, AMP Single',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        DB::table('datadetail_barang')->insert(array(
            'tanggal' => '2011-12-22',
            'idbarang_fk' => '1',
            'merk_barang' => 'Single, AMP Single',
            'nup' => '1',
            'idruang_fk' => '1'
        ));
        // DB::table('datadetail_barang')->insert(array(
        // 'tanggal' => '2011-12-22',
        //     'idbarang_fk' => '1',
        //     'merk_barang' => 'Single, AMP Single',
        //     'nup' => '1',
        // ));

    }
    public function down()
    {
        Schema::dropIfExists('datadetail_barang');
    }
}

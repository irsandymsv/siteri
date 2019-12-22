<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabarang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('databarang', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kodebarang');
            $table->string('namabarang');

        });
        DB::table('databarang')->insert(array(
            'kodebarang' => '3030205014',
            'namabarang' => 'Crimping Tools'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3040104003',
            'namabarang' => 'Rak-Rak Penyimpan'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050101003',
            'namabarang' => 'Mesin Ketik Manual Langewangon'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050101004',
            'namabarang' => 'Mesin Ketik Listrik'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050102007',
            'namabarang' => 'Mesin Penghitung Uang'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050104001',
            'namabarang' => 'Lemari Besi/Metal'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050104005',
            'namabarang' => 'Filing Cabinet Besi'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050104007',
            'namabarang' => 'Brangkas'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050104015',
            'namabarang' => 'Locker'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050104020',
            'namabarang' => 'Lemari Display'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050105007',
            'namabarang' => 'CCTV'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050105010',
            'namabarang' => 'White Board'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050105015',
            'namabarang' => 'Alat Penghancur Kertas'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050105017',
            'namabarang' => 'Mesin Absensi'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050105038',
            'namabarang' => 'Laser Pointer'
        ));

        DB::table('databarang')->insert(array(
            'kodebarang' => '3050105048',
            'namabarang' => 'LCD Projector/Infocus'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050105058',
            'namabarang' => 'Focussing Screen'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050105081',
            'namabarang' => 'Papan Pengumuman'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050201002',
            'namabarang' => 'Meja Kerja Kayu'
        ));

        DB::table('databarang')->insert(array(
            'kodebarang' => '3050201003',
            'namabarang' => 'Kursi Besi/Metal'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050201005',
            'namabarang' => 'Sice'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050201008',
            'namabarang' => 'Meja Rapat'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050201009',
            'namabarang' => 'Meja Komputer'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050204001',
            'namabarang' => 'Lemari Es'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050204002',
            'namabarang' => 'A.C. Sentral'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050204004',
            'namabarang' => 'A.C. Split'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050205015',
            'namabarang' => 'tandon Air'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206002',
            'namabarang' => 'televisi'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206005',
            'namabarang' => 'Amplifier'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206007',
            'namabarang' => 'Loudspeaker'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206008',
            'namabarang' => 'Sound System'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206012',
            'namabarang' => 'Wireless'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206034',
            'namabarang' => 'tangga Alumunium'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206036',
            'namabarang' => 'Dispenser'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206037',
            'namabarang' => 'Mimbar/Podium'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3050206071',
            'namabarang' => 'Kabel'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060101036',
            'namabarang' => 'Microphone/Wireless Mic'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060101048',
            'namabarang' => 'Uninterruptible Power Supply  (UPS)'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060101083',
            'namabarang' => 'Video Presenter'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060102132',
            'namabarang' => 'Video Conference'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060105037',
            'namabarang' => 'teropong'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060201001',
            'namabarang' => 'telephone(PABX)'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060201010',
            'namabarang' => 'Facsimile'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060201999',
            'namabarang' => 'Alat Komunikasi telephone Lainnya'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060207005',
            'namabarang' => 'Finger Printer time and Attandence  Access Control System '
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3060336999',
            'namabarang' => 'Peralatan Antena Pemancar dan Penerima LF lainnya'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3080141194',
            'namabarang' => 'Personal Computer'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3080402013',
            'namabarang' => 'Elektronic Robot'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3090402031',
            'namabarang' => 'Kamera Digital'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3090403004',
            'namabarang' => 'GPS'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3090403079',
            'namabarang' => 'Omni Single strand (Cooper) Duplex 20gauge Firing Wire'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3090409098',
            'namabarang' => 'Stavol'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100101002',
            'namabarang' => 'Mini Komputer'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100101007',
            'namabarang' => 'PC Workstation'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100102001',
            'namabarang' => 'P.C Unit'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100102002',
            'namabarang' => 'Laptop'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100102003',
            'namabarang' => 'Notebook'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100103002',
            'namabarang' => 'Monitor'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100103003',
            'namabarang' => 'Printer (Peralatan Personal Komputer)'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100103004',
            'namabarang' => 'Scanner (Peralatan Personal Komputer)'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100103017',
            'namabarang' => 'External/Portable Hardisk'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100104001',
            'namabarang' => 'Server'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100104002',
            'namabarang' => 'Router'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100104003',
            'namabarang' => 'Hub'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100104014',
            'namabarang' => 'Rak Server'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100104016',
            'namabarang' => 'Switch Rak'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100104021',
            'namabarang' => 'Kabel UtP'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100104024',
            'namabarang' => 'Switch'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3100104026',
            'namabarang' => 'Access Point'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3110201005',
            'namabarang' => 'Converter'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3170119004',
            'namabarang' => 'Jet Pump'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3170120007',
            'namabarang' => 'Storage Pile'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '3190102001',
            'namabarang' => 'Alat tenis Meja'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '6020101002',
            'namabarang' => 'Alat Musik Modern/Band'
        ));
        DB::table('databarang')->insert(array(
            'kodebarang' => '8010101001',
            'namabarang' => 'Software Komputer'
        ));
        



        
        
        

        
        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('databarang');
    }
}

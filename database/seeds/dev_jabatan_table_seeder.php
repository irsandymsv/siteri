<?php

use Illuminate\Database\Seeder;
use App\jabatan;

class dev_jabatan_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        jabatan::insert([
            ['jabatan' => 'Dekan'],         //1
            ['jabatan' => 'Wakil Dekan 1'], //2
            ['jabatan' => 'Wakil Dekan 2'], //3
            ['jabatan' => 'Dosen'],         //4

            ['jabatan' => 'KTU'],           //5
            ['jabatan' => 'BPP'],           //6
            ['jabatan' => 'Pengadministrasi Akademik'], //7
            ['jabatan' => 'PPABP'],         //8
            ['jabatan' => 'Pengadministrasi Kemahasiswaan & Alumni'],   //9
            ['jabatan' => 'Penata Dokumen Keuangan'],   //10
            ['jabatan' => 'Pemroses Mutasi Kepegawaian'], //11
            ['jabatan' => 'Pengadministrasi Akademik'], //12
            ['jabatan' => 'Pengelola Data Akademik'],   //13
            ['jabatan' => 'Pengadministrasi Layanan Kegiatan Mahasiswa'], //14
            ['jabatan' => 'Teknisi Komputer dan Operator Web'], //15
            ['jabatan' => 'Teknisi Komputer dan Operator SIMAK BMN'], //16
            ['jabatan' => 'Pengadministrasi BMN'],  //17
            ['jabatan' => 'Sekretaris Pimpinan'],   //18
            ['jabatan' => 'Pengadministrasi Persuratan dan Operator SIMAK Persediaan'], //19
            ['jabatan' => 'Pengemudi'], //20
            ['jabatan' => 'Teknisi Sarana dan Prasarana Kantor'],   //21
            ['jabatan' => 'Caraka dan Pramu Kantor'],   //22
        ]);
    }
}

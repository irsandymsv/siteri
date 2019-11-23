<?php

use Illuminate\Database\Seeder;
use App\nama_honor;

class nama_honor_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        nama_honor::insert([
            [
                'nama_honor' => 'Honor Pembimbing Utama Dengan Jabatan Fungsional'
            ],
            [
                'nama_honor' => 'Honor Pembimbing Utama Tanpa Jabatan Fungsional'
            ],
            [
                'nama_honor' => 'Honor Pembimbing Pendamping Dengan Jabatan Fungsional'
            ],
            [
                'nama_honor' => 'Honor Pembimbing Pendamping Tanpa Jabatan Fungsional'
            ],
            [
                'nama_honor' => 'Honor Pembahas Sempro'
            ],
            [
                'nama_honor' => 'Honor Penguji Utama Skripsi'
            ],
            [
                'nama_honor' => 'Honor Penguji Pendamping Skripsi'
            ]
        ]);
    }
}

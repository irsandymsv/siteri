<?php

use Illuminate\Database\Seeder;
use App\status_skripsi;

class status_skripsi_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        status_skripsi::insert([
            ['status' => 'Belum Punya Pembimbing'],
            ['status' => 'Sudah Punya Pembimbing'],
            ['status' => 'Sudah Punya Pembahas'],
            ['status' => 'Sudah Sempro'],
            ['status' => 'Sudah Punya Penguji'],
            ['status' => 'Sudah Lulus']
        ]);
    }
}

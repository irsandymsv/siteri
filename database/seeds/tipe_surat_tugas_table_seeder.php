<?php

use Illuminate\Database\Seeder;
use App\tipe_surat_tugas;

class tipe_surat_tugas_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tipe_surat_tugas::insert([
            ['tipe_surat' => 'Surat Tugas Pembimbing'],
            ['tipe_surat' => 'Surat Tugas Pembahas'],
            ['tipe_surat' => 'Surat Tugas Penguji']
        ]);
    }
}

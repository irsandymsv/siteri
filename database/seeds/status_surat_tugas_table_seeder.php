<?php

use Illuminate\Database\Seeder;
use App\status_surat_tugas;

class status_surat_tugas_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        status_surat_tugas::insert([
            ['status' => 'Draft'],
            ['status' => 'Dikirim'],
            ['status' => 'Disetujui KTU']
        ]);
    }
}

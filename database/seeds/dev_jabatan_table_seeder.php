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
            ['jabatan' => 'Dekan'],
            ['jabatan' => 'Wakil Dekan 1'],
            ['jabatan' => 'Wakil Dekan 2'],
            ['jabatan' => 'Dosen'],
            ['jabatan' => 'KTU'],
            ['jabatan' => 'BPP'],
        ]);
    }
}

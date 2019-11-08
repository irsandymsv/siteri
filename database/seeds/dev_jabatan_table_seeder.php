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
            ['jabatan' => 'Jabatan 2'],
            ['jabatan' => 'Jabatan 3'],
            ['jabatan' => 'Jabatan 4'],
        ]);
    }
}

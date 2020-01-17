<?php

use Illuminate\Database\Seeder;
use App\fungsional;

class dev_fungsional_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        fungsional::insert([
            ['jab_fungsional' => 'Guru Besar'],
            ['jab_fungsional' => 'Lektor Kepala'],
            ['jab_fungsional' => 'Lektor'],
            ['jab_fungsional' => 'Asisten Ahli'],
            ['jab_fungsional' => 'Tenaga Pengajar'],
        ]);
    }
}

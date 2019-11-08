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
            ['jab_fungsional' => 'Fungsional 1'],
            ['jab_fungsional' => 'Fungsional 2'],
            ['jab_fungsional' => 'Fungsional 3'],
            ['jab_fungsional' => 'Fungsional 4'],
        ]);
    }
}

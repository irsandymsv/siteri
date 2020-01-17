<?php

use Illuminate\Database\Seeder;
use App\pph;

class dev_pph_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pph::insert([
            ['pph' => 0],
            ['pph' => 5],
            ['pph' => 15]
        ]);
    }
}

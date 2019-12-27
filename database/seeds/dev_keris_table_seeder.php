<?php

use Illuminate\Database\Seeder;
use App\keris;

class dev_keris_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        keris::insert([
            ['nama' => 'DBI'],
            ['nama' => 'ADS'],
            ['nama' => 'Network & Security'],
            ['nama' => 'RPL'],
        ]);
    }
}

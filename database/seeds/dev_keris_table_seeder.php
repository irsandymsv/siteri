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
            ['nama' => 'keris 1'],
            ['nama' => 'keris 2'],
            ['nama' => 'keris 3'],
            ['nama' => 'keris 4'],
        ]);
    }
}

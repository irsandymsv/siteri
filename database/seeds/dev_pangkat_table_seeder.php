<?php

use Illuminate\Database\Seeder;
use App\pangkat;

class dev_pangkat_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        pangkat::insert([
            ['pangkat' => 'Pangkat 1'],
            ['pangkat' => 'Pangkat 2'],
            ['pangkat' => 'Pangkat 3'],
            ['pangkat' => 'Pangkat 4'],
            ['pangkat' => 'Pangkat 5'],
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\golongan;

class dev_golongan_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        golongan::insert([
            [
                'golongan' => 'I',
                'pph' => 5
            ],
            [
                'golongan' => 'II',
                'pph' => 10
            ],
            [
                'golongan' => 'III',
                'pph' => 15
            ],
            [
                'golongan' => 'IV',
                'pph' => 20
            ],

        ]);
    }
}

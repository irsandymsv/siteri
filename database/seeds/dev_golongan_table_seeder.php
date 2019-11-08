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
                'golongan' => 'Golongan 1',
                'pph' => 5
            ],
            [
                'golongan' => 'Golongan 2',
                'pph' => 10
            ],
            [
                'golongan' => 'Golongan 3',
                'pph' => 15
            ],
            [
                'golongan' => 'Golongan 4',
                'pph' => 20
            ],

        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\bagian;

class dev_bagian_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        bagian::insert([
            [
                'bagian' => 'Bagian 1',
                'is_jurusan' => 1
            ],
            [
                'bagian' => 'Bagian 2',
                'is_jurusan' => 1
            ],
            [
                'bagian' => 'Bagian 3',
                'is_jurusan' => 1
            ],
            [
                'bagian' => 'Bagian 4',
                'is_jurusan' => 1
            ]
        ]);
    }
}

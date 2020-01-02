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
                'bagian' => 'Sistem Informasi',
                'is_jurusan' => 1
            ],
            [
                'bagian' => 'Teknologi Informasi',
                'is_jurusan' => 1
            ],
            [
                'bagian' => 'Informatika',
                'is_jurusan' => 1
            ],
            [
                'bagian' => 'Bagian 4',
                'is_jurusan' => 0
            ]
        ]);
    }
}

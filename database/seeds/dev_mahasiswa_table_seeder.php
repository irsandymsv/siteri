<?php

use Illuminate\Database\Seeder;
use App\mahasiswa;

class dev_mahasiswa_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        mahasiswa::insert([
            [
                'nim' => 162410101035,
                'id_bagian' => 1,
                'nama' => 'Mahasiwa 1'
            ],
            [
                'nim' => 162410101050,
                'id_bagian' => 2,
                'nama' => 'Mahasiwa 2'
            ],
            [
                'nim' => 162410101015,
                'id_bagian' => 3,
                'nama' => 'Mahasiwa 3'
            ],
            [
                'nim' => 162410101020,
                'id_bagian' => 4,
                'nama' => 'Mahasiwa 4'
            ],
            [
                'nim' => 162410101070,
                'id_bagian' => 1,
                'nama' => 'Mahasiwa 5'
            ],

        ]);
    }
}

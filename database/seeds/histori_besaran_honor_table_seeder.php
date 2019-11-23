<?php

use Illuminate\Database\Seeder;
use App\histori_besaran_honor;

class histori_besaran_honor_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        histori_besaran_honor::insert([
            [
                'id_nama_honor' => 1,
                'jumlah_honor' => 400000
            ],
            [
                'id_nama_honor' => 2,
                'jumlah_honor' => 300000
            ],
            [
                'id_nama_honor' => 3,
                'jumlah_honor' => 300000
            ],
            [
                'id_nama_honor' => 4,
                'jumlah_honor' => 200000
            ],
            [
                'id_nama_honor' => 5,
                'jumlah_honor' => 50000
            ],
            [
                'id_nama_honor' => 6,
                'jumlah_honor' => 100000
            ],
            [
                'id_nama_honor' => 7,
                'jumlah_honor' => 100000
            ],
        ]);
    }
}

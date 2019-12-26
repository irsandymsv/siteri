<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satuan')->insert(
            array(
                array(
                    'satuan' => 'Buah'
                ),
                array(
                    'satuan' => 'Lusin'
                ),
                array(
                    'satuan' => 'Kodi'
                ),
                array(
                    'satuan' => 'Gross'
                ),
                array(
                    'satuan' => 'Rim'
                )
            )
        );
    }
}

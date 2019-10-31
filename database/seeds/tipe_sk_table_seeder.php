<?php

use Illuminate\Database\Seeder;
use App\tipe_sk;

class tipe_sk_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        tipe_sk::insert([
            ['tipe_sk'=>'SK sempro'],
            ['tipe_sk'=> 'SK skripsi']
        ]);
    }
}

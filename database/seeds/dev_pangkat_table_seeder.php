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
            ['pangkat' => 'Pembina TK.I'],       //1
            ['pangkat' => 'Pembina Utama Muda'], //2
            ['pangkat' => 'Penata'],             //3
            ['pangkat' => 'Pembina Utama Madya'],//4
            ['pangkat' => 'Penata TK.I'],        //5
            ['pangkat' => 'Penata Muda TK.I'],   //6
            ['pangkat' => 'Penata Muda'],        //7
            ['pangkat' => 'Tenaga Kontrak'],     //8
            ['pangkat' => 'Penata TK I'],        //9
            ['pangkat' => 'Pengatur'],           //10
            ['pangkat' => 'Pengatur TK.I '],     //11
        ]);
    }
}

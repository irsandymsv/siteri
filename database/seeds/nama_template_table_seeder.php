<?php

use Illuminate\Database\Seeder;
use App\nama_template;

class nama_template_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        nama_template::insert([
            ['nama' => 'SK Sempro'],
            ['nama' => 'Sk Skripsi'],
        ]);
    }
}

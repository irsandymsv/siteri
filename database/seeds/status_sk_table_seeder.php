<?php

use Illuminate\Database\Seeder;
use App\status_sk;

class status_sk_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        status_sk::insert([
            ['status' => 'Draft'],
            ['status' => 'Dikirim'],
            ['status' => 'Disetujui KTU']
        ]);
    }
}

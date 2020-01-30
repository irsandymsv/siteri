<?php

use Illuminate\Database\Seeder;
use App\status_sk_honor;

class status_sk_honor_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        status_sk_honor::insert([
            ['status' => 'Draft'],
            // ['status' => 'Dikirim'],
            // ['status' => 'Disetujui BPP'],
            // ['status' => 'Disetujui KTU'],
            // ['status' => 'Disetujui Wadek 2'],
            ['status' => 'Telah Dibayarkan']
        ]);
    }
}

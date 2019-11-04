<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            tipe_surat_tugas_table_seeder::class,
            tipe_sk_table_seeder::class,
            status_sk_table_seeder::class,
            status_sk_honor_table_seeder::class,
            status_surat_tugas_table_seeder::class,
        ]);
    }
}

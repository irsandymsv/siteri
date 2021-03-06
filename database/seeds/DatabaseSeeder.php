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
            status_sk_table_seeder::class,
            status_sk_honor_table_seeder::class,
            status_surat_tugas_table_seeder::class,
            status_skripsi_table_seeder::class,
            nama_template_table_seeder::class,
            nama_honor_table_seeder::class,
            histori_besaran_honor_table_seeder::class,
            template_table_seeder::class,

            dev_bagian_table_seeder::class,
            dev_keris_table_seeder::class,
            dev_jabatan_table_seeder::class,
            dev_golongan_table_seeder::class,
            dev_fungsional_table_seeder::class,
            dev_pangkat_table_seeder::class,
            dev_pph_table_seeder::class,
            // dev_mahasiswa_table_seeder::class,
            dev_users_table_seeder::class,
            // $this->call(UsersTableSeeder::class);

            SatuanSeeder::class,
            DataRuangSeeder::class,
            DataBarangSeeder::class,
            DetailDataBarangSeeder::class
        ]);
    }
}

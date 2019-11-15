<?php

use Illuminate\Database\Seeder;
use App\User;

class dev_users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'username' => 'dosen1',
                'password' => 'dosendosen',
                'no_pegawai' => 196811131994121001,
                'nama' => 'Prof. Dr. Saiful Bukhori, ST., M.Kom',
                'npwp'=> '1234567890',
                'bpjs' => '1234567890',
                'is_dosen' => 1,
                'id_jabatan' => 1,
                'id_bagian' => 1,
                'id_pangkat' => 1,
                'id_golongan' => 1,
                'id_fungsional' => 1,
            ],
            [
                'username' => 'dosen2',
                'password' => 'dosendosen',
                'no_pegawai' => 196909281993021001,
                'nama' => 'Drs. Antonius Cahya P, M. App,.Sc., Ph.D',
                'npwp' => '1234567890',
                'bpjs' => '1234567890',
                'is_dosen' => 1,
                'id_jabatan' => 2,
                'id_bagian' => 2,
                'id_pangkat' => 2,
                'id_golongan' => 2,
                'id_fungsional' => 2,
            ],
            [
                'username' => 'dosen3',
                'password' => 'dosendosen',
                'no_pegawai' => 198403052010122002,
                'nama' => 'Windi Eka Yulia Retnani, S. Kom., MT',
                'npwp' => '1234567890',
                'bpjs' => '1234567890',
                'is_dosen' => 1,
                'id_jabatan' => 3,
                'id_bagian' => 3,
                'id_pangkat' => 3,
                'id_golongan' => 3,
                'id_fungsional' => 3,
            ],
            [
                'username' => 'dosen4',
                'password' => 'dosendosen',
                'no_pegawai' => 196906151997021002,
                'nama' => 'Anang Andrianto, S.T., M.T',
                'npwp' => '1234567890',
                'bpjs' => '1234567890',
                'is_dosen' => 1,
                'id_jabatan' => 4,
                'id_bagian' => 4,
                'id_pangkat' => 4,
                'id_golongan' => 4,
                'id_fungsional' => 4,
            ],
            [
                'username' => 'dosen5',
                'password' => 'dosendosen',
                'no_pegawai' => 198410242009122008,
                'nama' => 'Nelly Oktavia Adiwijaya, S.Si., MT',
                'npwp' => '1234567890',
                'bpjs' => '1234567890',
                'is_dosen' => 1,
                'id_jabatan' => 4,
                'id_bagian' => 4,
                'id_pangkat' => 1,
                'id_golongan' => 2,
                'id_fungsional' => 3,
            ],

        ]);
    }
}

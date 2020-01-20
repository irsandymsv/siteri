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
            'no_pegawai' => '196811131994121001',
            'nama' => 'Prof. Dr. Saiful Bukhori, ST., M.Kom',
            'npwp'=> '1234567890',
            'bpjs' => '1234567890',
            'is_dosen' => 1,
            'id_jabatan' => 1,
            'id_bagian' => 2,
            'id_pangkat' => 1,
            'id_golongan' => 4,
            'id_fungsional' => 1,
            'id_pph' => 3
         ],
         [
            'username' => 'dosen2',
            'password' => 'dosendosen',
            'no_pegawai' => '196909281993021001',
            'nama' => 'Drs. Antonius Cahya P, M. App,.Sc., Ph.D',
            'npwp' => '1234567890',
            'bpjs' => '1234567890',
            'is_dosen' => 1,
            'id_jabatan' => 2,
            'id_bagian' => 2,
            'id_pangkat' => 2,
            'id_golongan' => 4,
            'id_fungsional' => 2,
            'id_pph' => 3
         ],
         [
            'username' => 'dosen3',
            'password' => 'dosendosen',
            'no_pegawai' => '198403052010122002',
            'nama' => 'Windi Eka Yulia Retnani, S. Kom., MT',
            'npwp' => '1234567890',
            'bpjs' => '1234567890',
            'is_dosen' => 1,
            'id_jabatan' => 3,
            'id_bagian' => 3,
            'id_pangkat' => 3,
            'id_golongan' => 3,
            'id_fungsional' => 3,
            'id_pph' => 2
         ],
         [
            'username' => 'dosen4',
            'password' => 'dosendosen',
            'no_pegawai' => '196906151997021002',
            'nama' => 'Anang Andrianto, S.T., M.T',
            'npwp' => '1234567890',
            'bpjs' => '1234567890',
            'is_dosen' => 1,
            'id_jabatan' => 4,
            'id_bagian' => 2,
            'id_pangkat' => 3,
            'id_golongan' => 3,
            'id_fungsional' => 3,
            'id_pph' => 2
         ],
         [
            'username' => 'dosen5',
            'password' => 'dosendosen',
            'no_pegawai' => '198410242009122008',
            'nama' => 'Nelly Oktavia Adiwijaya, S.Si., MT',
            'npwp' => '1234567890',
            'bpjs' => '1234567890',
            'is_dosen' => 1,
            'id_jabatan' => 4,
            'id_bagian' => 3,
            'id_pangkat' => 3,
            'id_golongan' => 3,
            'id_fungsional' => 3,
            'id_pph' => 2
         ],
         [
            'username' => 'dosen6',
            'password' => 'dosendosen',
            'no_pegawai' => '198511282015041002',
            'nama' => 'Fajrin Nurman Arifin, ST., M.Eng',
            'npwp' => '1234567890',
            'bpjs' => '1234567890',
            'is_dosen' => 1,
            'id_jabatan' => 4,
            'id_bagian' => 1,
            'id_pangkat' => 6,
            'id_golongan' => 3,
            'id_fungsional' => 4,
            'id_pph' => 2
         ],


         //Pegawai TU
         [
            'username' => 'ktu',
            'password' => 'tu',
            'no_pegawai' => '198104042005022012',
            'nama' => 'Siti Hosnul Hotimah, S.Si',
            'npwp' => '1234567890',
            'bpjs' => '1234567890',
            'is_dosen' => 0,
            'id_jabatan' => 5,
            'id_bagian' => 4,
            'id_pangkat' => 9,
            'id_golongan' => 3,
            'id_fungsional' => null,
            'id_pph' => 2
         ],
         [
            'username' => 'bpp',
            'password' => 'tu',
            'no_pegawai' => '198012102008102001',
            'nama' => 'Elok Zakia',
            'npwp' => '1234567890',
            'bpjs' => '1234567890',
            'is_dosen' => 0,
            'id_jabatan' => 6,
            'id_bagian' => 4,
            'id_pangkat' => 10,
            'id_golongan' => 2,
            'id_fungsional' => null,
            'id_pph' => 1
         ],
         [
            'username' => 'ayu',
            'password' => 'tu',
            'no_pegawai' => '760009201',
            'nama' => 'Ayu Aisah',
            'npwp' => null,
            'bpjs' => null,
            'is_dosen' => 0,
            'id_jabatan' => 13,
            'id_bagian' => 4,
            'id_pangkat' => null,
            'id_golongan' => null,
            'id_fungsional' => null,
            'id_pph' => null
         ],

      ]);
   }
}

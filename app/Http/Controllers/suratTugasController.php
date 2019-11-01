<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\surat_tugas;
use App\detail_skripsi;

class suratTugasController extends Controller
{
    protected function store_sutgas(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas)
    {

        $surat_tugas =  surat_tugas::create([
            'no_surat' => $request->input('no_surat'),
            'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
            'id_status_surat_tugas' => $id_status_surat_tugas
        ]);

        detail_skripsi::insert([
            'nim' => $request->input('nim'),
            'judul' => $request->input('judul'),
            'id_surat_tugas_pembimbing' => $surat_tugas->id,
            'id_pembimbing_utama' => $request->input('id_pembimbing_utama'),
            'id_pembimbing_pendamping' => $request->input('id_pembimbing_pendamping'),
            'id_keris' => $request->input('id_keris')
        ]);

        return $surat_tugas->id;
    }

    protected function update_sutgas(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas, int $id)
    {
        $sutgas = surat_tugas::find($id);
        $verif_ktu = $sutgas->verif_ktu;
        if ($id_status_surat_tugas == 2) {
            $verif_ktu = 0;
        }

        surat_tugas::where('id',$id)->update([
            'no_surat' => $request->input('no_surat'),
            'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
            'id_status_surat_tugas' => $id_status_surat_tugas,
            'verif_ktu' => $verif_ktu
        ]);
    }

    protected function update_detail_skripsi(Request $request, int $id_surat_tugas, string $nama_id_surat_tugas, string $nama_id_dosen1, string $nama_id_dosen2)
    {
        detail_skripsi::where('id', $request->input('id_detail_skripsi'))->update([
            $nama_id_surat_tugas => $id_surat_tugas,
            $nama_id_dosen1 => $request->input($nama_id_dosen1),
            $nama_id_dosen2 => $request->input($nama_id_dosen1),
        ]);
    }
}

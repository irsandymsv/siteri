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
        return $surat_tugas;
    }

    protected function update_sutgas(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas, int $id)
    {
        surat_tugas::where('id',$id)->update([
            'no_surat' => $request->input('no_surat'),
            'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
            'id_status_surat_tugas' => $id_status_surat_tugas
        ]);
    }

}

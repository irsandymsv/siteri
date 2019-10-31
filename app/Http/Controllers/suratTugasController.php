<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\surat_tugas;
use App\detail_skripsi;

class suratTugasController extends Controller
{
    public function store_sutgas(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas)
    {

        $surat_tugas =  surat_tugas::create([
            'no_surat' => $request->input('no_surat'),
            'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
            'id_status_surat_tugas' => $id_status_surat_tugas
        ]);

        detail_skripsi::insert([
            'nim' => $request->input('nim'),
            'id_surat_tugas_pembimbing' => $surat_tugas->id,
            'id_pembimbing_utama' => $request->input('id_pembimbing_utama'),
            'id_pembimbing_pendamping' => $request->input('id_pembimbing_pendamping'),
            'id_keris' => $request->input('id_keris')
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\surat_tugas;
use App\detail_skripsi;
use App\mahasiswa;
use Carbon\Carbon;

class suratTugasController extends Controller
{
    protected function store_sutgas(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas, string $tipe_id_dosen1, string $tipe_id_dosen2)
    {
        if($id_tipe_surat_tugas!=1){
            $surat_tugas =  surat_tugas::create([
                'no_surat' => $request->input('no_surat'),
                'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
                'id_status_surat_tugas' => $id_status_surat_tugas,
                'tanggal' =>carbon::parse($request->input('tanggal')),
                'tempat'=>$request->input('tempat'),
                'id_dosen1' => $request->input($tipe_id_dosen1),
                'id_dosen2' => $request->input($tipe_id_dosen2)
            ]);
        }else{
            $surat_tugas =  surat_tugas::create([
                'no_surat' => $request->input('no_surat'),
                'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
                'id_status_surat_tugas' => $id_status_surat_tugas,
                'id_dosen1' => $request->input($tipe_id_dosen1),
                'id_dosen2' => $request->input($tipe_id_dosen2)
            ]);
        }
        return $surat_tugas->id;
    }

    protected function update_sutgas(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas, int $id)
    {
        $sutgas = surat_tugas::find($id);
        $verif_ktu = $sutgas->verif_ktu;
        if ($id_status_surat_tugas == 2) {
            $verif_ktu = 0;
        }
        if ($id_tipe_surat_tugas != 1) {
            surat_tugas::where('id', $id)->update([
                'no_surat' => $request->input('no_surat'),
                'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
                'id_status_surat_tugas' => $id_status_surat_tugas,
                'tanggal' => carbon::parse($request->input('tanggal')),
                'tempat' => $request->input('tempat'),
                'verif_ktu' => $verif_ktu
            ]);
        } else {
            surat_tugas::where('id', $id)->update([
                'no_surat' => $request->input('no_surat'),
                'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
                'id_status_surat_tugas' => $id_status_surat_tugas,
                'verif_ktu' => $verif_ktu
            ]);
        }

    }

    protected function update_detail_skripsi(Request $request, int $id_surat_tugas, string $nama_id_surat_tugas, string $nama_id_dosen1, string $nama_id_dosen2)
    {
        if($nama_id_surat_tugas == "id_surat_tugas_pembahas"){
            detail_skripsi::where('nim', $request->input('nim'))->update([
                'judul_inggris' => $request->input('judul_inggris'),
                $nama_id_surat_tugas => $id_surat_tugas,
                $nama_id_dosen1 => $request->input($nama_id_dosen1),
                $nama_id_dosen2 => $request->input($nama_id_dosen2),
            ]);
        }else{
            detail_skripsi::where('nim', $request->input('nim'))->update([
                $nama_id_surat_tugas => $id_surat_tugas,
                $nama_id_dosen1 => $request->input($nama_id_dosen1),
                $nama_id_dosen2 => $request->input($nama_id_dosen2),
            ]);
        }
    }

    protected function verif($surat_tugas, int $id_status_surat_tugas, $pesan_revisi)
    {
        $surat_tugas->id_status_surat_tugas = $id_status_surat_tugas;
        $surat_tugas->pesan_revisi = $pesan_revisi;
        return $surat_tugas;
    }

    public function getPembimbing($nim = null)
    {
        if(!is_null($nim)){
            $pembimbing = array(
                'dosen1' => "",
                'dosen2' => ""
            );

            $mhs = mahasiswa::where('nim', $nim)->with([
                'skripsi.detail_skripsi.surat_tugas', 
                'skripsi.detail_skripsi.surat_tugas.dosen1',
                'skripsi.detail_skripsi.surat_tugas.dosen2',
                'skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas'
                'skripsi.detail_skripsi.surat_tugas.status_surat_tugas'
            ])
            ->whereHas('skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas', function(Builder $query)
            {
                $query->where('tipe_surat', 'Surat tugas pembimbing');
            })
            ->whereHas('skripsi.detail_skripsi.surat_tugas.status_surat_tugas', function(Builder $query)
            {
                $query->where('status', 'Diverifikasi KTU');
            })
            ->max('created_at')->first();

            $pembimbing['dosen1'] = $mhs->skripsi->detail_skripsi->surat_tugas->dosen1;
            $pembimbing['dosen2'] = $mhs->skripsi->detail_skripsi->surat_tugas->dosen2;
            return $pembimbing;
        }
    }
}

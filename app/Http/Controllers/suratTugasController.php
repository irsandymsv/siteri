<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\surat_tugas;
use App\detail_skripsi;
use App\mahasiswa;
use App\skripsi;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class suratTugasController extends Controller
{
    protected function store_sutgas(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas,int $id_detail_skripsi, string $tipe_id_dosen1, string $tipe_id_dosen2)
    {
        if($id_tipe_surat_tugas!=1){
            $surat_tugas =  surat_tugas::create([
                'no_surat' => $request->input('no_surat'),
                'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
                'id_detail_skripsi' => $id_detail_skripsi,
                'id_status_surat_tugas' => $id_status_surat_tugas,
                'tanggal' =>carbon::parse($request->input('tanggal')),
                'tempat'=>$request->input('tempat'),
                'id_dosen1' => $request->input($tipe_id_dosen1),
                'id_dosen2' => $request->input($tipe_id_dosen2)
            ]);
        }else{
            $surat_tugas =  surat_tugas::create([
                'no_surat' => $request->input('no_surat'),
                'id_detail_skripsi' => $id_detail_skripsi,
                'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
                'id_status_surat_tugas' => $id_status_surat_tugas,
                'id_dosen1' => $request->input($tipe_id_dosen1),
                'id_dosen2' => $request->input($tipe_id_dosen2)
            ]);
        }
        return $surat_tugas->id;
    }

    protected function update_sutgas(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas, int $id, string $nama_id_dosen1, string $nama_id_dosen2)
    {
        if ($id_tipe_surat_tugas != 1) {
            surat_tugas::where('id', $id)->update([
                'no_surat' => $request->input('no_surat'),
                'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
                'id_status_surat_tugas' => $id_status_surat_tugas,
                'tanggal' => carbon::parse($request->input('tanggal')),
                'tempat' => $request->input('tempat'),
                'verif_ktu' => $this->cek_verif_ktu($id_status_surat_tugas, $id),
                'id_dosen1' => $request->input($nama_id_dosen1),
                'id_dosen2' => $request->input($nama_id_dosen2)
            ]);
        } else {
            surat_tugas::where('id', $id)->update([
                'no_surat' => $request->input('no_surat'),
                'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
                'id_status_surat_tugas' => $id_status_surat_tugas,
                'verif_ktu' => $this->cek_verif_ktu($id_status_surat_tugas, $id),
                'id_dosen1' => $request->input($nama_id_dosen1),
                'id_dosen2' => $request->input($nama_id_dosen2)
            ]);
        }

    }

    protected function update_sutgas_beda_nim(Request $request, int $id_tipe_surat_tugas, int $id_status_surat_tugas, int $id, int $id_detail_skripsi, string $nama_id_dosen1, string $nama_id_dosen2)
    {

        surat_tugas::where('id', $id)->update([
            'no_surat' => $request->input('no_surat'),
            'id_tipe_surat_tugas' => $id_tipe_surat_tugas,
            'id_status_surat_tugas' => $id_status_surat_tugas,
            'tanggal' => carbon::parse($request->input('tanggal')),
            'tempat' => $request->input('tempat'),
            'verif_ktu' => $this->cek_verif_ktu($id_status_surat_tugas,$id),
            'id_detail_skripsi' => $id_detail_skripsi,
            'id_dosen1' => $request->input($nama_id_dosen1),
            'id_dosen2' => $request->input($nama_id_dosen2)
        ]);
    }

    protected function cek_verif_ktu(int $id_status_surat_tugas,int $id)
    {
        $sutgas = surat_tugas::find($id);
        $verif_ktu = $sutgas->verif_ktu;
        if ($id_status_surat_tugas == 2) {
            $verif_ktu = 0;
        }
        return $verif_ktu;
    }

    // protected function update_detail_skripsi(Request $request, int $id_surat_tugas, string $nama_id_surat_tugas)
    // {
    //     if($nama_id_surat_tugas == "id_surat_tugas_pembahas"){
    //         detail_skripsi::where('nim', $request->input('nim'))->update([
    //             'judul_inggris' => $request->input('judul_inggris'),
    //             $nama_id_surat_tugas => $id_surat_tugas,
    //         ]);
    //     }else{
    //         detail_skripsi::where('nim', $request->input('nim'))->update([
    //             $nama_id_surat_tugas => $id_surat_tugas,
    //         ]);
    //     }
    // }

    protected function verif($surat_tugas, int $id_status_surat_tugas, $pesan_revisi,$id_status_skripsi)
    {
        $surat_tugas->id_status_surat_tugas = $id_status_surat_tugas;
        $surat_tugas->pesan_revisi = $pesan_revisi;
        if($id_status_skripsi != null){
            $skripsi = skripsi::whereHas('detail_skripsi', function (Builder $query) use ($surat_tugas) {
                $query->where('id', $surat_tugas->id_detail_skripsi);
            })->update([
                'id_status_skripsi' => $id_status_skripsi
            ]);
        }
        return $surat_tugas;
    }

    public function getPembimbing($nim = null)
    {
        if(!is_null($nim)){
            $pembimbing = array(
                'dosen1' => "",
                'dosen2' => ""
            );

            $mahasiswa = mahasiswa::where('nim', $nim)->with('skripsi')->first();

            $detail = detail_skripsi::where('id_skripsi', $mahasiswa->skripsi->id)->orderBy('created_at', 'desc')->first();

            $sutgas_pembimbing = surat_tugas::where('id_detail_skripsi', $detail->id)
            ->with(['tipe_surat_tugas', 'status_surat_tugas', 'dosen1', 'dosen2'])
            ->whereHas('tipe_surat_tugas', function(Builder $query)
            {
                $query->where('tipe_surat', 'Surat Tugas Pembimbing');
            })
            ->orderBy('created_at', 'desc')->first();

            // ->whereHas('status_surat_tugas', function(Builder $query)
            // {
            //     $query->where('status', 'Disetujui KTU');
            // })

            $pembimbing['dosen1'] = $sutgas_pembimbing->dosen1;
            $pembimbing['dosen2'] = $sutgas_pembimbing->dosen2;
            return $pembimbing;
        }
    }
}

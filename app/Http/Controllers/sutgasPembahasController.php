<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\surat_tugas;
use App\detail_skripsi;
use PDF;
use Exception;
use App\User;
use App\keris;
use App\mahasiswa;
use Carbon\Carbon;

class sutgasPembahasController extends suratTugasController
{

    public function index()
    {
        $surat_tugas = surat_tugas::with(['tipe_surat_tugas', 'status_surat_tugas', 'surat_tugas_pembahas', 'surat_tugas_pembahas.mahasiswa'])
            ->whereHas('tipe_surat_tugas',function(Builder $query){
                $query->where('tipe_surat','Surat Tugas pembahas');
            })->orderBy('created_at', 'desc')->get();
            // dd($surat_tugas);
        return view('akademik.sutgas_pembahas.index', ['surat_tugas' => $surat_tugas]);
    }

    public function create()
    {
        $mahasiswa = mahasiswa::with('detail_skripsi')
        ->whereHas('detail_skripsi', function(Builder $query)
        {
            $query->where([
                ['id_surat_tugas_pembimbing', '<>', null],
                ['id_surat_tugas_pembahas', null]
            ]);
        })->get();
        $dosen = user::where('is_dosen', 1)->get();
        // dd($mahasiswa);
        return view('akademik.sutgas_pembahas.create', ['mahasiswa' => $mahasiswa, 'dosen' => $dosen]);
    }

    public function store(Request $request)
    {
        dd($request);
        $this->validate($request, [
            'nim' => 'required',
            'no_surat' => 'required',
            'id_pembahas1' => 'required',
            'id_pembahas2' => 'required',
            'status' => 'required'
        ]);
        try {
            $id_surat = $this->store_sutgas($request, 2, $request->status);
            $this->update_detail_skripsi(
                $request,
                $id_surat,
                'id_surat_tugas_pembahas',
                'id_pembahas1',
                'id_pembahas2'
            );
            return redirect()->route('akademik.sutgas-pembahas.index')->with('success', 'Data Surat Tugas Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('akademik.sutgas-pembahas.create')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $surat_tugas = surat_tugas::where('id', $id)
        ->with([
            "status_surat_tugas",
            "surat_tugas_pembahas",
            "surat_tugas_pembahas.mahasiswa",
            "surat_tugas_pembahas.keris",
            "surat_tugas_pembahas.pembahas1:no_pegawai,nama",
            "surat_tugas_pembahas.pembahas2:no_pegawai,nama"
        ])->first();
        // dd($surat_tugas);
      return view('akademik.sutgas_pembahas.show', [
        'surat_tugas' => $surat_tugas
      ]);
    }

    public function edit($id)
    {
        $surat_tugas = surat_tugas::where('id', $id)
        ->with([
            "surat_tugas_pembahas",
            "surat_tugas_pembahas.mahasiswa",
            "surat_tugas_pembahas.keris",
            "surat_tugas_pembahas.pembahas1:no_pegawai,nama",
            "surat_tugas_pembahas.pembahas2:no_pegawai,nama"
        ])->first();

        $mahasiswa = mahasiswa::with('detail_skripsi')
        ->whereHas('detail_skripsi', function(Builder $query)
        {
            $query->where([
                ['id_surat_tugas_pembimbing', '<>', null],
                ['id_surat_tugas_pembahas', null]
            ]);
        })->orWhere("nim", $surat_tugas->surat_tugas_pembahas->nim)->get();
        $dosen = user::where('is_dosen', 1)->get();
        // dd($mahasiswa);

        return view('akademik.sutgas_pembahas.edit', [
            'surat_tugas' => $surat_tugas,
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_detail_skripsi' => 'required',
            'no_surat' => 'required',
            'id_pembahas1' => 'required',
            'id_pembahas2' => 'required',
            'status' => 'required'
        ]);
        try {
            $this->update_sutgas($request, 2, $request->status, $id);
            $this->update_detail_skripsi(
                $request,
                $id,
                'id_surat_tugas_pembahas',
                'id_pembahas1',
                'id_pembahas2'
            );
            return redirect()->route('akademik.sutgas-pembahas.edit', $id)->with('success', 'Data Surat Tugas Berhasil Dirubah');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('akademik.sutgas-pembahas.edit', $id)->with('error', $e->getMessage());
        }
    }

    public function cetak_pdf($id)
    {
        $surat_tugas = surat_tugas::where('id', $id)
        ->with([
            "surat_tugas_pembahas",
            "surat_tugas_pembahas.mahasiswa",
            "surat_tugas_pembahas.keris",
            "surat_tugas_pembahas.pembahas1:no_pegawai,nama,id_fungsional",
            "surat_tugas_pembahas.pembahas1.fungsional",
            "surat_tugas_pembahas.pembahas2:no_pegawai,nama,id_fungsional",
            "surat_tugas_pembahas.pembahas2.fungsional",
            "surat_tugas_pembahas.pembimbing_utama:no_pegawai,nama,id_fungsional",
            "surat_tugas_pembahas.pembimbing_utama.fungsional",
            "surat_tugas_pembahas.pembimbing_pendamping:no_pegawai,nama,id_fungsional",
            "surat_tugas_pembahas.pembimbing_pendamping.fungsional"
        ])->first();
        $dekan = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Dekan");
        })->first();

        // return view('akademik.sutgas_pembimbing.pdf', ['surat_tugas' => $surat_tugas, 'dekan' => $dekan]);

        $pdf = PDF::loadview('akademik.sutgas_pembahas.pdf', ['surat_tugas' => $surat_tugas, 'dekan' => $dekan])->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download("Sutgas_Pembahas-" . $surat_tugas->no_surat);
    }

    //KTU
    public function ktu_index()
    {
        $surat_tugas = surat_tugas::with(['tipe_surat_tugas', 'status_surat_tugas', 'surat_tugas_pembahas', 'surat_tugas_pembahas.mahasiswa'])
            ->whereHas('tipe_surat_tugas',function(Builder $query){
                $query->where('tipe_surat','Surat Tugas Pembahas');
            })
            ->whereHas('status_surat_tugas', function (Builder $query){
                $query->whereIn('status', ['Dikirim', 'Disetujui KTU']);
            })
            ->orderBy('updated_at', 'desc')->get();

        // dd($surat_tugas);
        return view('ktu.sutgas_akademik.index', [
            'surat_tugas' => $surat_tugas,
            'tipe' => 'surat tugas pembahas'
        ]);
    }

    public function ktu_show($id)
    {
        $surat_tugas = surat_tugas::where('id', $id)
        ->with([
            "surat_tugas_pembahas",
            "surat_tugas_pembahas.mahasiswa",
            "surat_tugas_pembahas.mahasiswa.bagian",
            "surat_tugas_pembahas.keris",
            "surat_tugas_pembahas.pembahas1:no_pegawai,nama,id_fungsional",
            "surat_tugas_pembahas.pembahas1.fungsional",
            "surat_tugas_pembahas.pembahas2:no_pegawai,nama,id_fungsional",
            "surat_tugas_pembahas.pembahas2.fungsional",
            "surat_tugas_pembahas.pembimbing_utama:no_pegawai,nama,id_fungsional",
            "surat_tugas_pembahas.pembimbing_utama.fungsional",
            "surat_tugas_pembahas.pembimbing_pendamping:no_pegawai,nama,id_fungsional",
            "surat_tugas_pembahas.pembimbing_pendamping.fungsional"
        ])->first();

        $dekan = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Dekan");
        })->first();
        // dd($surat_tugas);
      return view('ktu.sutgas_akademik.show_pembahas', [
        'surat_tugas' => $surat_tugas,
        'dekan' => $dekan,
        'tipe' => 'surat tugas pembahas'
      ]);
    }
}

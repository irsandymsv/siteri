<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\surat_tugas;
use App\detail_skripsi;
use App\mahasiswa;
use App\skripsi;
use App\keris;
use App\User;
use PDF;
use Exception;
use Carbon\Carbon;
use App\Rules\id_dosen_tidak_boleh_sama;

class sutgasPengujiController extends suratTugasController
{
    public function index()
    {
        $surat_tugas = surat_tugas::with(['tipe_surat_tugas', 'status_surat_tugas', 'detail_skripsi', 'detail_skripsi.skripsi.mahasiswa'])
            ->whereHas('tipe_surat_tugas',function(Builder $query){
                $query->where('tipe_surat','Surat Tugas Penguji');
            })->orderBy('created_at', 'desc')->get();
            // dd($surat_tugas);
        return view('akademik.sutgas_penguji.index', ['surat_tugas' => $surat_tugas]);
    }

    public function create()
    {
        $mahasiswa = mahasiswa::with(['skripsi', 'skripsi.status_skripsi', 'skripsi.detail_skripsi','skripsi.detail_skripsi.surat_tugas'])
        // ->whereDoesntHave('skripsi.detail_skripsi.surat_tugas', function(Builder $query)
        // {
        //     $query->where('id_tipe_surat_tugas', 3);
        // })
        ->whereHas('skripsi.status_skripsi', function(Builder $query)
        {
            $query->where('status', 'Sudah Sempro');
        })
        ->get();

        $dosen1 = user::where('is_dosen', 1)
        ->whereHas('fungsional', function(Builder $query)
        {
            $query->whereIn('jab_fungsional', [
                'Guru Besar',
                'Lektor Kepala',
                'Lektor'
            ]);
        })->get();
        $dosen2 = user::where('is_dosen', 1)->get();
        // dd($mahasiswa);
        return view('akademik.sutgas_penguji.create', [
            'mahasiswa' => $mahasiswa,
            'dosen1' => $dosen1,
            'dosen2' => $dosen2,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'no_surat' => 'required|unique:surat_tugas,no_surat|unique:sk_skripsi,no_surat_pembimbing|unique:sk_skripsi,no_surat_penguji|unique:sk_sempro,no_surat|',
            'id_penguji1' => ['required', new id_dosen_tidak_boleh_sama($request->input("id_penguji2"))],
            'id_penguji2' => 'required',
            'tanggal' => 'required',
            'tempat' => 'required',
            'status' => 'required'
        ]);
        try {
            $nim = $request->input('nim');
            $detail_skripsi = detail_skripsi::select('id')->whereHas('skripsi',function (Builder $query) use ($nim){
                                    $query->where('nim',$nim);
                                })->orderBy('created_at','desc')->first();
            $id_baru = $this->store_sutgas(
                $request,
                3,
                $request->status,
                $detail_skripsi->id,
                'id_penguji1',
                'id_penguji2'
            );
            return redirect()->route('akademik.sutgas-penguji.show', $id_baru)->with('success', 'Data Surat Tugas Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('akademik.sutgas-penguji.create')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $surat_tugas = surat_tugas::where('id', $id)
        ->with([
            "status_surat_tugas",
            "detail_skripsi",
            "detail_skripsi.skripsi.mahasiswa",
            "detail_skripsi.keris",
            "dosen1:no_pegawai,nama",
            "dosen2:no_pegawai,nama"
        ])->first();

        $sutgas_pembimbing = surat_tugas::where('id_detail_skripsi', $surat_tugas->id_detail_skripsi)
        ->with(['dosen1:no_pegawai,nama', 'dosen2:no_pegawai,nama'])
        ->whereHas('tipe_surat_tugas', function(Builder $query)
        {
            $query->where('tipe_surat', 'Surat Tugas pembimbing');
        })
        ->wherehas('status_surat_tugas', function(Builder $query)
        {
            $query->where('status', 'Disetujui KTU');
        })->orderBy('created_at')->first();

        $pembimbing = array(
            'dosen1' => $sutgas_pembimbing->dosen1,
            'dosen2' => $sutgas_pembimbing->dosen2
        );
        // dd($pembimbing);
      return view('akademik.sutgas_penguji.show', [
        'surat_tugas' => $surat_tugas,
        'pembimbing' =>$pembimbing
      ]);
    }

    public function edit($id)
    {
        $surat_tugas = surat_tugas::where('id', $id)
        ->with([
            "detail_skripsi",
            "detail_skripsi.skripsi.mahasiswa",
            "detail_skripsi.keris",
            "dosen1:no_pegawai,nama",
            "dosen2:no_pegawai,nama"
        ])->first();

        $pembimbing = $this->getPembimbing($surat_tugas->detail_skripsi->skripsi->nim);

        $t = carbon::parse($surat_tugas->tanggal)->toDateString();
        $j = carbon::parse($surat_tugas->tanggal)->format('h:i');
        $tanggal = $t.'T'.$j;
        $mahasiswa = mahasiswa::with(['skripsi', 'skripsi.status_skripsi'])
        ->whereDoesntHave('skripsi.detail_skripsi.surat_tugas', function(Builder $query)
        {
            $query->where('id_tipe_surat_tugas', 3);
        })
        ->whereHas('skripsi.status_skripsi', function(Builder $query)
        {
            $query->where('status', 'Sudah Sempro');
        })
        ->orWhere("nim", $surat_tugas->detail_skripsi->skripsi->nim)->get();

        $dosen1 = user::where('is_dosen', 1)
        ->whereHas('fungsional', function(Builder $query)
        {
            $query->whereIn('jab_fungsional', [
                'Guru Besar',
                'Lektor Kepala',
                'Lektor'
            ]);
        })->get();
        $dosen2 = user::where('is_dosen', 1)->get();
        // dd($mahasiswa);

        return view('akademik.sutgas_penguji.edit', [
            'surat_tugas' => $surat_tugas,
            'mahasiswa' => $mahasiswa,
            'dosen1' => $dosen1,
            'dosen2' => $dosen2,
            'tanggal' => $tanggal,
            'pembimbing' => $pembimbing
        ]);
    }

    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'no_surat' => 'required|unique:surat_tugas,no_surat|unique:sk_skripsi,no_surat_pembimbing|unique:sk_skripsi,no_surat_penguji|unique:sk_sempro,no_surat|',
        //     'tanggal' => 'required',
        //     'tempat' => 'required',
        //     'id_penguji1' => 'required',
        //     'id_penguji2' => 'required',
        //     'nim' => 'required'
        // ]);

        $validator = Validator::make($request->all(), [
            'no_surat' => [
                'required',
                Rule::unique('surat_tugas', 'no_surat')->ignore($id),
                'unique:sk_skripsi,no_surat_pembimbing',
                'unique:sk_skripsi,no_surat_penguji',
                'unique:sk_sempro,no_surat'

            ],
            'tanggal' => 'required',
            'tempat' => 'required',
            'id_penguji1' => ['required', new id_dosen_tidak_boleh_sama($request->input("id_penguji2"))],
            'id_penguji2' => 'required',
            'nim' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('akademik.sutgas-penguji.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            if ($request->input('nim') != $request->input('original_nim')) {
                $nim = $request->input('nim');
                $detail_skripsi = detail_skripsi::select('id')->whereHas('skripsi', function (Builder $query) use ($nim) {
                    $query->where('nim', $nim);
                })->orderBy('created_at', 'desc')->first();
                $this->update_sutgas_beda_nim(
                    $request,
                    3,
                    $request->status,
                    $id,
                    $detail_skripsi->id,
                    'id_penguji1',
                    'id_penguji2'
                );
            } else {
                $this->update_sutgas(
                    $request,
                    3,
                    $request->status,
                    $id,
                    'id_penguji1',
                    'id_penguji2'
                );
            }
            return redirect()->route('akademik.sutgas-penguji.show', $id)->with('success', 'Data Surat Tugas Berhasil Dirubah');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('akademik.sutgas-penguji.edit', $id)->with('error', $e->getMessage());
        }
    }

    public function cetak_pdf($id)
    {
        $surat_tugas = surat_tugas::where('id', $id)
        ->with([
            "detail_skripsi",
            "detail_skripsi.skripsi.mahasiswa",
            "detail_skripsi.skripsi.mahasiswa.bagian",
            "detail_skripsi.keris",
            "dosen1:no_pegawai,nama,id_fungsional",
            "dosen1.fungsional",
            "dosen2:no_pegawai,nama,id_fungsional",
            "dosen2.fungsional"
        ])->first();

        $sutgas_pembimbing = surat_tugas::where('id_detail_skripsi', $surat_tugas->id_detail_skripsi)
        ->with([
            "status_surat_tugas",
            "tipe_surat_tugas",
            "detail_skripsi",
            "dosen1:no_pegawai,nama,id_fungsional",
            "dosen1.fungsional",
            "dosen2:no_pegawai,nama,id_fungsional",
            "dosen2.fungsional"
        ])
        ->whereHas('tipe_surat_tugas', function(Builder $query)
        {
            $query->where('tipe_surat', 'Surat tugas pembimbing');
        })
        ->orderBy('created_at','desc')->first();

        $dekan = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Dekan");
        })->first();

        // return view('akademik.sutgas_pembimbing.pdf', ['surat_tugas' => $surat_tugas, 'dekan' => $dekan]);

        $pdf = PDF::loadview('akademik.sutgas_penguji.pdf', [
            'surat_tugas' => $surat_tugas,
            'sutgas_pembimbing' => $sutgas_pembimbing,
            'dekan' => $dekan
        ])->setPaper('folio', 'portrait')->setWarnings(false);
        return $pdf->download("Sutgas_Penguji-" . $surat_tugas->no_surat . ".pdf");
    }

     //KTU
    public function ktu_index()
    {
        $surat_tugas = surat_tugas::with(['tipe_surat_tugas', 'status_surat_tugas', 'detail_skripsi', 'detail_skripsi.skripsi.mahasiswa'])
            ->whereHas('tipe_surat_tugas',function(Builder $query){
                $query->where('tipe_surat','Surat Tugas Penguji');
            })
            ->whereHas('status_surat_tugas', function (Builder $query){
                $query->whereIn('status', ['Dikirim', 'Disetujui KTU']);
            })
            ->orderBy('verif_ktu')
            ->orderBy('updated_at', 'desc')
            ->get();

        // dd($surat_tugas);
        return view('ktu.sutgas_akademik.index', [
            'surat_tugas' => $surat_tugas,
            'tipe' => 'surat tugas penguji'
        ]);
    }

    public function ktu_show($id)
    {
        $surat_tugas = surat_tugas::where('id', $id)
        ->with([
            "detail_skripsi",
            "detail_skripsi.skripsi.mahasiswa",
            "detail_skripsi.skripsi.mahasiswa.bagian",
            "detail_skripsi.keris",
            "dosen1:no_pegawai,nama,id_fungsional",
            "dosen1.fungsional",
            "dosen2:no_pegawai,nama,id_fungsional",
            "dosen2.fungsional"
        ])->first();

        $sutgas_pembimbing = surat_tugas::where('id_detail_skripsi', $surat_tugas->id_detail_skripsi)
        ->with([
            "status_surat_tugas",
            "tipe_surat_tugas",
            "detail_skripsi",
            "dosen1:no_pegawai,nama,id_fungsional",
            "dosen1.fungsional",
            "dosen2:no_pegawai,nama,id_fungsional",
            "dosen2.fungsional"
        ])
        ->whereHas('tipe_surat_tugas', function(Builder $query)
        {
            $query->where('tipe_surat', 'Surat tugas pembimbing');
        })
        ->orderBy('created_at','desc')->first();

        $dekan = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Dekan");
        })->first();

        // dd($sutgas_pembimbing);
      return view('ktu.sutgas_akademik.show_penguji', [
        'surat_tugas' => $surat_tugas,
        'sutgas_pembimbing' => $sutgas_pembimbing,
        'dekan' => $dekan,
        'tipe' => 'surat tugas penguji'
      ]);
    }

    public function ktu_verif(Request $request, $id)
    {
        $surat_tugas = surat_tugas::find($id);
        $surat_tugas->verif_ktu = $request->verif_ktu;
        if($request->verif_ktu == 2){
            $request->validate([
                'pesan_revisi' => 'required|string'
            ]);
            $surat_tugas = $this->verif($surat_tugas, 1, $request->pesan_revisi,null);
            $surat_tugas->save();
            return redirect()->route('ktu.sutgas-penguji.index')->with("verif_ktu", 'Surat tugas berhasil ditarik, status kembali menjadi "Draft"');
        }
        else if ($request->verif_ktu == 1) {
            $surat_tugas = $this->verif($surat_tugas,3,null,5);
            $surat_tugas->save();

            return redirect()->route('ktu.sutgas-penguji.show', $id)->with('verif_ktu', 'verifikasi surat tugas berhasil, status surat tugas saat ini "Disetujui KTU"');
        }
    }
}

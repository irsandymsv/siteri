<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Exception;
use App\bagian;
use App\User;
use App\sk_sempro;
use App\detail_skripsi;
use App\mahasiswa;
use App\Http\Controllers\Controller;
use App\status_sk_akademik;
use Carbon\Carbon;

class SkSemproController extends Controller
{
    public function index()
    {
        try {
            $sk = sk_sempro::with('status_sk')
                ->orderBy('updated_at', 'desc')
                ->get();
            // dd($sk);
            return view('akademik.SK_view.index', [
                'sk' => $sk,
                'tipe' => "SK Sempro"
            ]);
        } catch (Exception $e) {
            return view('akademik.SK_view.index');
        }
    }

    public function create(Request $request)
    {
        $old_data = [];
        $old_mahasiswa = "";
        if (array_key_exists('nim', $request->old())) {
            // dd($request->old());
            $old_data = $request->old();
            $old_mahasiswa = mahasiswa::whereIn('nim', $request->old()["nim"])
            ->with([
                "bagian",
                "skripsi",
                "skripsi.status_skripsi",
                "skripsi.detail_skripsi" => function($query)
                {
                    $query->orderBy('created_at', 'desc');
                },
                "skripsi.detail_skripsi.surat_tugas" => function($query)
                {
                    $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
                },
                "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
                "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
                "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
            ])->get();
        }

        $dosen = user::where('is_dosen', 1)->get();
        $mahasiswa = mahasiswa::with([
            "bagian",
            "skripsi",
            "skripsi.status_skripsi",
            "skripsi.detail_skripsi" => function($query)
            {
                $query->orderBy('created_at', 'desc');
            },
            "skripsi.detail_skripsi.surat_tugas" => function($query)
            {
                $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
            },
            "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
            "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
            "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
        ])
        ->whereHas("skripsi.status_skripsi", function(Builder $query)
        {
            $query->where("status", "Sudah punya pembahas");
        })->get();

        // dd($mahasiswa);
        return view('akademik.SK_view.create', [
            'dosen' => $dosen,
            'mahasiswa' => $mahasiswa,
            'old_data' => $old_data,
            'old_mahasiswa' => $old_mahasiswa,
            'tipe' => "sk sempro"
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "no_surat" => "required|unique:sk_sempro,no_surat",
            'tgl_sempro1' => "required",
            'tgl_sempro2' => "required",
            "nim" => "required|array",
            "nim.*" => "required|string"
        ]);

        try {
            $sk_sempro = sk_sempro::create([
                "no_surat" => $request->input("no_surat"),
                "tgl_sempro1" => carbon::parse($request->input("tgl_sempro1")),
                "tgl_sempro2" => carbon::parse($request->input("tgl_sempro2")),
                "id_status_sk" => $request->input("status")
            ]);

            foreach ($request->nim as $nim) {
                $this->update_id_sk_sempro($nim, $sk_sempro->no_surat);
            }
            // return redirect()->route('akademik.sempro.show', $sk_sempro->no_surat)->with('success', 'Data Berhasil Ditambahkan');
            return redirect()->route('akademik.sempro.create')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('akademik.sempro.create')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $sk = sk_sempro::find($id);
        $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
        ->with([
            'skripsi',
            'skripsi.mahasiswa',
            'skripsi.mahasiswa.bagian',
            'surat_tugas' => function($query)
            {
                $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
            },
            'surat_tugas.tipe_surat_tugas',
            'surat_tugas.dosen1:no_pegawai,nama',
            'surat_tugas.dosen2:no_pegawai,nama',
        ])->get();

        // dd($detail_sk);
        return view('akademik.SK_view.show', [
            'sk' => $sk,
            'detail_skripsi' => $detail_skripsi,
            'tipe' => 'sk sempro'
        ]);
    }

    public function edit(Request $request, $id)
    {
        $old_data = [];
        $old_mahasiswa = "";
        if (array_key_exists('nim', $request->old())) {
            // dd($request->old());
            $old_data = $request->old();
            $old_mahasiswa = mahasiswa::whereIn('nim', $request->old()["nim"])
            ->with([
                "bagian",
                "skripsi",
                "skripsi.status_skripsi",
                "skripsi.detail_skripsi" => function($query)
                {
                    $query->orderBy('created_at', 'desc');
                },
                "skripsi.detail_skripsi.surat_tugas" => function($query)
                {
                    $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
                },
                "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
                "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
                "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
            ])->get();
        }
            $sk = sk_sempro::find($id);
            $dosen = user::where('is_dosen', 1)->get();
            $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
            ->with([
                'skripsi',
                'skripsi.mahasiswa',
                'skripsi.mahasiswa.bagian',
                'surat_tugas' => function($query)
                {
                    $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
                },
                'surat_tugas.tipe_surat_tugas',
                'surat_tugas.dosen1:no_pegawai,nama',
                'surat_tugas.dosen2:no_pegawai,nama',
            ])->get();

            $nim_detail = [];
            foreach ($detail_skripsi as $val) {
                $nim_detail[] = $val->skripsi->nim;
            }

            $mahasiswa = mahasiswa::with([
                "bagian",
                "skripsi",
                "skripsi.status_skripsi",
                "skripsi.detail_skripsi" => function($query)
                {
                    $query->orderBy('created_at', 'desc');
                },
                "skripsi.detail_skripsi.surat_tugas" => function($query)
                {
                    $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
                },
                "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
                "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
                "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
            ])
            ->whereHas("skripsi.status_skripsi", function(Builder $query)
            {
                $query->where("status", "Sudah punya pembahas");
            })
            ->get();
            return view('akademik.SK_view.edit', [
                'sk' => $sk,
                'detail_skripsi' => $detail_skripsi,
                'nim_detail' => $nim_detail,
                'mahasiswa' => $mahasiswa,
                'dosen' => $dosen,
                'old_data' => $old_data,
                'old_mahasiswa' => $old_mahasiswa,
                'tipe' => 'sk sempro'
            ]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "no_surat" => "required",
            'tgl_sempro1' => "required",
            'tgl_sempro2' => "required",
            "nim" => "required|array",
            "nim.*" => "required|string"
        ]);

        try {
            $sk = sk_sempro::find($id);
            $verif_ktu = $sk->verif_ktu;
            $verif_dekan = $sk->verif_dekan;
            if($request->status == 2){
                $verif_ktu = 0;
                $verif_dekan = 0;
            }
            sk_sempro::where('no_surat', $id)->update([
                "no_surat" => $request->input("no_surat"),
                "tgl_sempro1" => carbon::parse($request->input("tgl_sempro1")),
                "tgl_sempro2" => carbon::parse($request->input("tgl_sempro2")),
                "id_status_sk" => $request->input("status")
            ]);
            foreach ($request->input('nim') as $nim){
                if($request->$ == 1 ){
                    $this->update_id_sk_sempro($nim, $id);
                }else if($request->input($nim) == 3){
                    $this->update_id_sk_sempro($nim, null);
                }
            }
            return redirect()->route('akademik.sempro.show', $id)->with('success', 'Data Berhasil Diedit');
        } catch (Exception $e) {
            return redirect()->route('akademik.sempro.edit', $id)->with('error', $e->getMessage());
        }
    }

    private function update_id_sk_sempro($nim,$id){
        $detail_skripsi = detail_skripsi::whereHas('skripsi', function (builder $query) use ($nim) {
            $query->where('nim', $nim);
        })->orderBy('created_at', 'desc')->first();
        $detail_skripsi->id_sk_sempro = $id;
        $detail_skripsi->save;
    }

    public function destroy($id = null)
    {
        if (!is_null($id)) {
            sk_akademik::find($id)->delete();
            echo 'Data SK Berhasil Dihapus';
        }
    }

    public function editPenetapan()
    {
        return view('akademik.SK_view.edit_penetapan', [
            'tipe' => 'sk sempro'
        ]);
    }

    public function updatePenetapan(Request $request)
    {
        dd($request->all());
    }


    //KTU
    public function ktu_index_sempro()
    {
        $sk = sk_sempro::with('status_sk')
        ->whereHas('status_sk', function(Builder $query){
            $query->whereIn('id', [2,3,4]);
        })
        ->orderBy('updated_at', 'desc')
        ->get();

        return view('ktu.SK_view.sk_index', [
            'sk' => $sk,
            'tipe' => "SK Sempro"
        ]);
    }

    public function ktu_show($id)
    {
        $sk = sk_sempro::find($id);
        $status = $sk->status_sk->status;
        if($status == "Draft"){
            return redirect()->route('ktu.sk-sempro.index');
        }

        $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
            ->with([
                'skripsi',
                'skripsi.mahasiswa',
                'skripsi.mahasiswa.bagian',
                'surat_tugas' => function($query)
                {
                    $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
                },
                'surat_tugas.tipe_surat_tugas',
                'surat_tugas.dosen1:no_pegawai,nama',
                'surat_tugas.dosen2:no_pegawai,nama',
            ])->get();
        // dd($detail_skripsi);
        return view('ktu.SK_view.sk_show', [
            'sk' => $sk,
            'detail_skripsi' => $detail_skripsi
        ]);
    }

    public function ktu_verif(Request $request, $id)
    {
        // dd($request);
        $sk = sk_sempro::find($id);
        $sk->verif_ktu = $request->verif_ktu;
        if($request->verif_ktu == 2){
            $request->validate([
                'pesan_revisi' => 'required|string'
            ]);

            $sk->id_status_sk = 1;
            $sk->pesan_revisi = $request->pesan_revisi;
            $sk->save();
            return redirect()->route('ktu.sk-sempro.index')->with("verif_ktu", 'SK berhasil ditarik, status kembali menjadi "Draft"');
        }
        else if ($request->verif_ktu == 1) {
            $sk->id_status_sk = 3;
            $sk->pesan_revisi = null;
            $sk->save();
            return redirect()->route('ktu.sk-sempro.index')->with('verif_ktu', 'verifikasi SK berhasil, status SK saat ini "Disetujui KTU"');
        }
    }


    //DEKAN
    // public function dekan_index_sempro()
    // {
    //     $sk_akademik = sk_akademik::with(['tipe_sk', 'status_sk_akademik'])
    //     ->whereHas('tipe_sk', function(Builder $query){
    //         $query->where('id', 2);
    //     })
    //     ->whereHas('status_sk_akademik', function(Builder $query){
    //         $query->whereIn('id', [3,4]);
    //     })
    //     ->orderBy('updated_at', 'desc')
    //     ->get();

    //     return view('dekan.SK_view.sk_index', [
    //         'sk_akademik' => $sk_akademik,
    //         'tipe' => "SK Sempro"
    //     ]);
    // }

    // public function dekan_show($id)
    // {
    //     $sk_akademik = sk_akademik::find($id);
    //     $status = $sk_akademik->status_sk_akademik->status;
    //     if($status != "Disetujui KTU" && $status != "Disetujui Dekan"){
    //         return redirect()->route('dekan.sk-sempro.index');
    //     }

    //     $sk_akademik = sk_akademik::find($id);
    //     $detail_sk = detail_sk::where('id_sk_akademik', $id)
    //         ->with([
    //             'bagian',
    //             'penguji_utama:no_pegawai,nama',
    //             'penguji_pendamping:no_pegawai,nama',
    //             'pembimbing_utama:no_pegawai,nama',
    //             'pembimbing_pendamping:no_pegawai,nama'
    //         ])->get();
    //     // dd($detail_sk);
    //     return view('dekan.SK_view.sk_show', [
    //         'sk_akademik' => $sk_akademik,
    //         'detail_sk' => $detail_sk
    //     ]);
    // }

    // public function dekan_verif(Request $request, $id)
    // {
    //     $sk_akademik = sk_akademik::find($id);
    //     $sk_akademik->verif_dekan = $request->verif_dekan;
    //     if($request->verif_dekan == 2){
    //         $request->validate([
    //             'pesan_revisi' => 'required|string'
    //         ]);

    //         $sk_akademik->id_status_sk_akademik = 1;
    //         $sk_akademik->pesan_revisi = $request->pesan_revisi;
    //         $sk_akademik->save();
    //         return redirect()->route('dekan.sk-sempro.index')->with("verif_dekan", 'SK berhasil ditarik, status kembali menjadi "Draft"');
    //     }
    //     else if ($request->verif_dekan == 1) {
    //         $sk_akademik->id_status_sk_akademik = 4;
    //         $sk_akademik->pesan_revisi = null;
    //         $sk_akademik->save();
    //         return redirect()->route('dekan.sk-sempro.index')->with('verif_dekan', 'verifikasi SK berhasil, status SK saat ini "Disetujui Dekan"');
    //     }
    // }
}

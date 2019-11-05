<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Exception;
use App\bagian;
use App\User;
use App\sk_sempro;
use App\detail_sk;
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
        if (count($request->old()) > 0) {
            // dd($request->old());
            $old_data = $request->old();
            $old_mahasiswa = mahasiswa::whereIn('nim', $old_data["nim"])
            ->with([
                "bagian",
                "detail_skripsi",
                "detail_skripsi.pembahas1:no_pegawai,nama",
                "detail_skripsi.pembahas2:no_pegawai,nama"
            ])->get();
        }
        // dd($old_mahasiswa);

        $jurusan = bagian::where('is_jurusan', 1)->get();
        $dosen = user::where('is_dosen', 1)->get();
        $mahasiswa = mahasiswa::with([
            "bagian",
            "detail_skripsi",
            "detail_skripsi.pembahas1:no_pegawai,nama",
            "detail_skripsi.pembahas2:no_pegawai,nama"
        ])
        ->whereHas("detail_skripsi", function(Builder $query)
        {
            $query->where("id_surat_tugas_pembahas", "<>",null);
        })->get();
        // dd($mahasiswa);
        return view('akademik.SK_view.create', [
            'jurusan' => $jurusan,
            'dosen' => $dosen,
            'mahasiswa' => $mahasiswa,
            'old_data' => $old_data,
            'old_mahasiswa' => $old_mahasiswa,
            'tipe' => "sk sempro"
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->status);
        $this->validate($request, [
            "no_surat" => "required",
            "nim" => "required|array",
            "nim.*" => "required|string|max:20"
        ]);

        try {
            $sk_akademik = sk_akademik::create([
                'id_tipe_sk' => 2,
                'id_status_sk_akademik' => $request->status,
                'no_surat' => $request->no_surat
            ]);
            for ($i = 0; $i < count($request->nama); $i++) {
                $detail_sk = detail_sk::create([
                    'id_sk_akademik' => $sk_akademik->id,
                    'nama_mhs' => $request->nama[$i],
                    'nim' => $request->nim[$i],
                    'id_bagian' => $request->jurusan[$i],
                    'judul' => $request->judul[$i],
                    'id_pembimbing_utama' => $request->pembimbing_utama[$i],
                    'id_pembimbing_pendamping' => $request->pembimbing_pendamping[$i],
                    'id_penguji_utama' => $request->penguji_utama[$i],
                    'id_penguji_pendamping' => $request->penguji_pendamping[$i]
                ]);
            }

            return redirect()->route('akademik.sempro.show', $sk_akademik->id)->with('success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('akademik.sempro.create')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $sk_akademik = sk_akademik::find($id);
        $detail_sk = detail_sk::where('id_sk_akademik', $id)
            ->with([
                'bagian',
                'penguji_utama:no_pegawai,nama',
                'penguji_pendamping:no_pegawai,nama',
                'pembimbing_utama:no_pegawai,nama',
                'pembimbing_pendamping:no_pegawai,nama'
            ])->get();
        // dd($detail_sk);
        return view('akademik.SK_view.show', [
            'sk_akademik' => $sk_akademik,
            'detail_sk' => $detail_sk
        ]);
    }

    public function edit(Request $request, $id)
    {
        $old_data = [];
        if (count($request->old()) > 0) {
            // dd($request->old()['nama']);
            $old_data = $request->old();
        }

        try {
            $jurusan = bagian::where('is_jurusan', 1)->get();
            $dosen = user::where('is_dosen', 1)->get();
            $sk_akademik = sk_akademik::find($id);
            $detail_sk = detail_sk::where('id_sk_akademik', $id)
                ->with([
                    'bagian',
                    'penguji_utama:no_pegawai,nama',
                    'penguji_pendamping:no_pegawai,nama',
                    'pembimbing_utama:no_pegawai,nama',
                    'pembimbing_pendamping:no_pegawai,nama'
                ])->get();

            return view('akademik.SK_view.edit', [
                'sk_akademik' => $sk_akademik,
                'detail_sk' => $detail_sk,
                'jurusan' => $jurusan,
                'dosen' => $dosen,
                'old_data' => $old_data
            ]);
        } catch (Exception $e) {
            return redirect()->route('akademik.sempro.index')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $this->validate($request, [
            "id_detail_sk" => "required|array",
            "id_detail_sk.*" => "required",
            "nama"    => "required|array",
            "nama.*"  => "required|string|max:40",
            "nim" => "required|array",
            "nim.*" => "required|string|max:20",
            "jurusan" => "required|array",
            "jurusan.*" => "required",
            "judul" => "required|array",
            "judul.*" => "required",
            "pembimbing_utama" => "required|array",
            "pembimbing_utama.*" => "required",
            "pembimbing_pendamping" => "required|array",
            "pembimbing_pendamping.*" => "required",
            "penguji_utama" => "required|array",
            "penguji_utama.*" => "required",
            "penguji_pendamping" => "required|array",
            "penguji_pendamping.*" => "required",
            "no_surat" => "required"
        ]);

        try {
            $sk = sk_akademik::find($id);
            $verif_ktu = $sk->verif_ktu;
            $verif_dekan = $sk->verif_dekan;
            if($request->status == 2){
                $verif_ktu = 0;
                $verif_dekan = 0;
            }

            $sk_akademik = sk_akademik::where('id', $id)->update([
                'id_status_sk_akademik' => $request->status,
                'verif_ktu' => $verif_ktu,
                'verif_dekan' => $verif_dekan,
                'no_surat' => $request->no_surat
            ]);

            for ($i = 0; $i < count($request->id_detail_sk); $i++) {
                if ($request->id_detail_sk[$i] != 0) {
                    if ($request->delete_detail_sk[$i] == 1) {
                        detail_sk::where('id', $request->id_detail_sk[$i])->delete();
                        continue;
                    } else {
                        $detail_sk = detail_sk::where('id', $request->id_detail_sk[$i])->update([
                            'nama_mhs' => $request->nama[$i],
                            'nim' => $request->nim[$i],
                            'id_bagian' => $request->jurusan[$i],
                            'judul' => $request->judul[$i],
                            'id_pembimbing_utama' => $request->pembimbing_utama[$i],
                            'id_pembimbing_pendamping' => $request->pembimbing_pendamping[$i],
                            'id_penguji_utama' => $request->penguji_utama[$i],
                            'id_penguji_pendamping' => $request->penguji_pendamping[$i]
                        ]);
                    }
                } else {
                    echo "new data,iterasi= " . $i . "<br>";
                    $detail_sk = detail_sk::create([
                        'id_sk_akademik' => $id,
                        'nama_mhs' => $request->nama[$i],
                        'nim' => $request->nim[$i],
                        'id_bagian' => $request->jurusan[$i],
                        'judul' => $request->judul[$i],
                        'id_pembimbing_utama' => $request->pembimbing_utama[$i],
                        'id_pembimbing_pendamping' => $request->pembimbing_pendamping[$i],
                        'id_penguji_utama' => $request->penguji_utama[$i],
                        'id_penguji_pendamping' => $request->penguji_pendamping[$i]
                    ]);
                }
            }
            return redirect()->route('akademik.sempro.show', $id)->with('success', 'Data Berhasil Diedit');
        } catch (Exception $e) {
            return redirect()->route('akademik.sempro.index')->with('error', $e->getMessage());
        }
    }

    public function destroy($id = null)
    {
        if (!is_null($id)) {
            sk_akademik::find($id)->delete();
            echo 'Data SK Berhasil Dihapus';
        }
    }


    //KTU
    public function ktu_index_sempro()
    {
        $sk_akademik = sk_akademik::with(['tipe_sk', 'status_sk_akademik'])
        ->whereHas('tipe_sk', function(Builder $query){ 
            $query->where('id', 2); 
        })
        ->whereHas('status_sk_akademik', function(Builder $query){ 
            $query->whereIn('id', [2,3,4]); 
        })
        ->orderBy('updated_at', 'desc')
        ->get();

        return view('ktu.SK_view.sk_index', [
            'sk_akademik' => $sk_akademik,
            'tipe' => "SK Sempro"
        ]);
    }

    public function ktu_show($id)
    {
        $sk_akademik = sk_akademik::find($id);
        $status = $sk_akademik->status_sk_akademik->status;
        if($status == "Draft"){
            return redirect()->route('ktu.sk-sempro.index');
        }

        $detail_sk = detail_sk::where('id_sk_akademik', $id)
            ->with([
                'bagian',
                'penguji_utama:no_pegawai,nama',
                'penguji_pendamping:no_pegawai,nama',
                'pembimbing_utama:no_pegawai,nama',
                'pembimbing_pendamping:no_pegawai,nama'
            ])->get();
        // dd($detail_sk);
        return view('ktu.SK_view.sk_show', [
            'sk_akademik' => $sk_akademik,
            'detail_sk' => $detail_sk
        ]);
    }

    public function ktu_verif(Request $request, $id)
    {
        // dd($request);
        $sk_akademik = sk_akademik::find($id);
        $sk_akademik->verif_ktu = $request->verif_ktu;
        if($request->verif_ktu == 2){
            $request->validate([
                'pesan_revisi' => 'required|string'
            ]);

            $sk_akademik->id_status_sk_akademik = 1;
            $sk_akademik->pesan_revisi = $request->pesan_revisi;
            $sk_akademik->save();
            return redirect()->route('ktu.sk-sempro.index')->with("verif_ktu", 'SK berhasil ditarik, status kembali menjadi "Draft"');
        }
        else if ($request->verif_ktu == 1) {
            $sk_akademik->id_status_sk_akademik = 3;
            $sk_akademik->pesan_revisi = null;
            $sk_akademik->save();
            return redirect()->route('ktu.sk-sempro.index')->with('verif_ktu', 'verifikasi SK berhasil, status SK saat ini "Disetujui KTU"');
        }
    }


    //DEKAN
    public function dekan_index_sempro()
    {
        $sk_akademik = sk_akademik::with(['tipe_sk', 'status_sk_akademik'])
        ->whereHas('tipe_sk', function(Builder $query){ 
            $query->where('id', 2); 
        })
        ->whereHas('status_sk_akademik', function(Builder $query){
            $query->whereIn('id', [3,4]); 
        })
        ->orderBy('updated_at', 'desc')
        ->get();

        return view('dekan.SK_view.sk_index', [
            'sk_akademik' => $sk_akademik,
            'tipe' => "SK Sempro"
        ]);
    }

    public function dekan_show($id)
    {
        $sk_akademik = sk_akademik::find($id);
        $status = $sk_akademik->status_sk_akademik->status;
        if($status != "Disetujui KTU" && $status != "Disetujui Dekan"){
            return redirect()->route('dekan.sk-sempro.index');
        }

        $sk_akademik = sk_akademik::find($id);
        $detail_sk = detail_sk::where('id_sk_akademik', $id)
            ->with([
                'bagian',
                'penguji_utama:no_pegawai,nama',
                'penguji_pendamping:no_pegawai,nama',
                'pembimbing_utama:no_pegawai,nama',
                'pembimbing_pendamping:no_pegawai,nama'
            ])->get();
        // dd($detail_sk);
        return view('dekan.SK_view.sk_show', [
            'sk_akademik' => $sk_akademik,
            'detail_sk' => $detail_sk
        ]);
    }

    public function dekan_verif(Request $request, $id)
    {
        $sk_akademik = sk_akademik::find($id);
        $sk_akademik->verif_dekan = $request->verif_dekan;
        if($request->verif_dekan == 2){
            $request->validate([
                'pesan_revisi' => 'required|string'
            ]);

            $sk_akademik->id_status_sk_akademik = 1;
            $sk_akademik->pesan_revisi = $request->pesan_revisi;
            $sk_akademik->save();
            return redirect()->route('dekan.sk-sempro.index')->with("verif_dekan", 'SK berhasil ditarik, status kembali menjadi "Draft"');
        }
        else if ($request->verif_dekan == 1) {
            $sk_akademik->id_status_sk_akademik = 4;
            $sk_akademik->pesan_revisi = null;
            $sk_akademik->save();
            return redirect()->route('dekan.sk-sempro.index')->with('verif_dekan', 'verifikasi SK berhasil, status SK saat ini "Disetujui Dekan"');
        }
    }
}

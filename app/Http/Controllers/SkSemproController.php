<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkSemproController extends Controller
{
    public function index()
    {
        try {
            $sk_akademik = sk_akademik::whereHas('tipe_sk', function ($query) {
                $query->where('id', 2);
            })
                ->with(['tipe_sk', 'status_sk_akademik'])
                ->orderBy('created_at', 'desc')
                ->get();
            return view('akademik.sempro.index', ['sk_akademik' => $sk_akademik]);
        } catch (Exception $e) {
            return view('akademik.sempro.index');
        }
    }

    public function create(Request $request)
    {
        $old_data = [];
        if (count($request->old()) > 0) {
            // dd($request->old()['nama']);
            $old_data = $request->old();
        }

        $jurusan = bagian::where('is_jurusan', 1)->get();
        // $jurusan = array(
        // 	'si' => "Sistem Informasi",
        // 	'ti' => "Teknologi Informasi",
        // 	'if' => "Informatika"
        // );

        $dosen = user::where('is_dosen', 1)->get();
        // $dosen = array(
        // 	'1' => "Saiful Bukhori",
        // 	'2' => "Anang Hermansyah",
        // 	'3' => "Windy",
        // 	'4' => "Beny Prasetyo",
        // 	'5' => "Slamin",
        // 	'6' => "Januar", 
        // );


        return view('akademik.sempro.create-form', [
            'jurusan' => $jurusan,
            'dosen' => $dosen,
            'old_data' => $old_data
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->status);
        $this->validate($request, [
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
        ]);

        try {
            $sk_akademik = sk_akademik::create([
                'id_tipe_sk' => 2,
                'id_status_sk_akademik' => $request->status
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

            return redirect()->route('akademik.sempro.index')->with('success', 'Data Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('akademik.sempro.create')->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $sk_akademik = sk_akademik::find($id);
        $detail_sk = detail_sk::where('id_sk_akademik', $id)
            ->with([
                'bagian', 'status_sk_akademik',
                'penguji_utama',
                'penguji_pendamping',
                'pembimbing_utama',
                'pembimbing_pendamping',
                // 'pembimbing.pembimbing_utama:no_pegawai,nama',
                // 'pembimbing.pembimbing_pendamping:no_pegawai,nama',
                // 'penguji.penguji_utama:no_pegawai,nama',
                // 'penguji.penguji_pendamping:no_pegawai,nama'
            ])->get();
        // dd($detail_sk);
        return view('akademik.Skripsi.show', [
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
                    'penguji_utama',
                    'penguji_pendamping',
                    'pembimbing_utama',
                    'pembimbing_pendamping',
                    // 'pembimbing.pembimbing_utama:no_pegawai,nama',
                    // 'pembimbing.pembimbing_pendamping:no_pegawai,nama',
                    // 'penguji.penguji_utama:no_pegawai,nama',
                    // 'penguji.penguji_pendamping:no_pegawai,nama'
                ])->get();

            return view('akademik.Skripsi.edit', [
                'sk_akademik' => $sk_akademik,
                'detail_sk' => $detail_sk,
                'jurusan' => $jurusan,
                'dosen' => $dosen,
                'old_data' => $old_data
            ]);
        } catch (Exception $e) {
            return redirect()->route('akademik.skripsi.index')->with('error', $e->getMessage());
        }
    }
}

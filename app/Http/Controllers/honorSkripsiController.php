<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\sk_akademik;
use App\detail_sk;

class honorSkripsiController extends Controller
{
    public function index()
    {
    	return view('keuangan.honor_skripsi.index');
    }

    public function pilih_sk()
    {
        $sk_akademik = sk_akademik::with(['tipe_sk', 'status_sk_akademik', 'detail_sk'])
        ->whereHas('tipe_sk', function(Builder $query)
        {
            $query->where('tipe', 'SK Skripsi');
        })
        ->whereHas('status_sk_akademik', function(Builder $query)
        {
            $query->where('status', 'Disetujui Dekan');
        })
        ->orderBy('created_at', 'desc')->get();
        
    	return view('keuangan.honor_skripsi.pilih_sk', [
            'sk_akademik' => $sk_akademik
        ]);
    }

    public function create($id)
    {
    	$sk_akademik = sk_akademik::find($id);
        $detail_sk = detail_sk::where('id_sk_akademik', $id)->with([
            'pembimbing_utama:no_pegawai,nama,npwp,id_golongan', 'pembimbing_utama.golongan',
            'pembimbing_pendamping:no_pegawai,nama,npwp,id_golongan', 'pembimbing_pendamping.golongan',
            'penguji_utama:no_pegawai,nama,npwp,id_golongan', 'penguji_utama.golongan',
            'penguji_pendamping:no_pegawai,nama,npwp,id_golongan', 'penguji_pendamping.golongan',
        ])->get();
        // dd($detail_sk);
        return view('keuangan.honor_skripsi.create', [
            'sk_akademik' => $sk_akademik,
            'detail_sk' => $detail_sk
        ]);
    }
}

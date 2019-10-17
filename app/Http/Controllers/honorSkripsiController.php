<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\sk_akademik;
use App\detail_sk;
use App\sk_honor;
use Exception;

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
            $query->where('id', 1);
        })
        ->whereHas('detail_sk',function(Builder $query)
        {
            $query->whereNull('id_sk_honor');
        })
        ->where('verif_dekan',1)
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

    public function store(Request $request)
    {
        $this->validate($request,[
            'honor_pembimbing' => 'required',
            'honor_penguji' => 'required',
        ]);

        try{
            $sk_honor=sk_honor::create([
                'id_tipe_sk' => 3,
                'id_status_sk_honor' => $request->status,
                'honor_pembimbing' => $request->honor_pembimbing,
                'honor_penguji' => $request->honor_penguji
            ]);
            detail_sk::where('id_sk_akademik',$request->id_sk_akademik)
                    ->update([
                        'id_sk_honor' => $sk_honor->id
                    ]);
            return redirect()->route('keuangan.honor-skripsi.pilih-sk')->with('success', 'Data Berhasil Dibuat'); 
        }catch(Exception $e){
            return redirect()->route('keuangan/')->with('error', $e->getMessage()); 
        }
    }
}

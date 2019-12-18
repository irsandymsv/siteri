<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\skripsi;
use App\mahasiswa;
use App\detail_skripsi;
use App\User;
use App\keris;
use Exception;

class skripsiController extends suratTugasController
{
    public function index()
    {
    	$data_skripsi = skripsi::with(['mahasiswa', 'status_skripsi'])->get();

        // dd($data_skripsi);
    	return view('akademik.skripsi.index', ['data_skripsi' => $data_skripsi]);
    }

    public function ubahJudul($id)
    {
    	$skripsi = skripsi::where('id', $id)
        ->with(['status_skripsi', 'mahasiswa'])
        ->first();
    	return view('akademik.skripsi.ubahJudul', ['skripsi' => $skripsi]);

    }

    public function store_ubahJudul(Request $requset, $id)
    {

    }

    public function ubahJudulPembimbing($id)
    {
        $skripsi = skripsi::where('id', $id)
        ->with(['status_skripsi', 'mahasiswa'])
        ->first();

        $dosen = user::where('is_dosen', 1)->get();
        $keris = keris::all();
        return view('akademik.skripsi.ubahJudulPembimbing', ['skripsi' => $skripsi, 'dosen' => $dosen, 'keris' => $keris]);
    }

    public function store_ubahJudulPembimbing(Request $request, $id)
    {
        $this->validate($request, [
            'no_surat' => 'required',
            'id_keris' => 'required',
            'judul' => 'required',
            'id_pembimbing_utama' => "required",
            'id_pembimbing_pendamping' => "required",
        ]);
        try{
            skripsi::where('id',$id)->update([
                'id_status_skripsi' => 1
            ]);
            $detail_skripsi = detail_skripsi::create([
                'judul' => $request->input('judul'),
                'id_skripsi' => $id,
                'id_keris' => $request->input('id_keris')
            ]);
            $id_baru = $this->store_sutgas(
                $request,
                1,
                $request->status,
                $detail_skripsi->id,
                'id_pembimbing_utama',
                'id_pembimbing_pendamping'
            );
            return redirect()->route('akademik.data-skripsi.ubah-judul-pembimbing', $id)->with('success','Surat Tugas Pembimbing Baru Berhasil Di Buat');
        }catch(Exception $e){
            return redirect()->route('akademik.data-skripsi.ubah-judul-pembimbing', $id)->with('error', $e->getMessage());
        }
    }

    public function updateJudul(Request $request, $id)
    {
    	$skripsi = skripsi::where('id', $id)
        ->with(['status_skripsi', 'mahasiswa'])->first();
        $detail_skripsi = detail_skripsi::where('id_skripsi', $id)->orderBy('created_at', 'desc')->first();
        return view('akademik.skripsi.updateJudul', ['skripsi' => $skripsi, 'detail_skripsi' => $detail_skripsi]);
    }

    public function Update_updateJudul(Request $request, $id)
    {
        $this->validate($request,[
            'judul' => 'required',
            'judul_inggris' => 'required'
        ]);

        try{
            detail_skripsi::where('id',$id)->update([
                'judul' => $request->input('judul'),
                'judul_inggris' => $request->input('judul_inggris')
            ]);
            return redirect()->route('akademik.data-skripsi.update-judul', $request->input('id_skripsi'))->with('success', 'Data Berhasil Dirubah');
        }catch(Exception $e){
            return redirect()->route('akademik.data-skripsi.update-judul',$request->input('id_skripsi'))->with('error',$e->getMessage());
        }

    }
}

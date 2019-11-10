<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\skripsi;
use App\mahasiswa;
use App\detail_skripsi;
use App\User;
use App\keris;

class skripsiController extends Controller
{
    public function index()
    {
    	$data_skripsi = skripsi::with(['mahasiswa', 'status_skripsi'])->get();
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
        # code...
    }

    public function updateJudul(Request $request, $id)
    {
    	$skripsi = skripsi::where('id', $id)
        ->with(['status_skripsi', 'mahasiswa'])->first();
        $detail_skripsi = detail_skripsi::where('id_skripsi', $id)->orderBy('created_at', 'desc')->first();
        return view('akademik.skripsi.updateJudul', ['skripsi' => $skripsi, 'detail_skripsi' => $detail_skripsi]);
    }

    public function store_updateJudul(Request $request, $id)
    {
        # code...
    }
}

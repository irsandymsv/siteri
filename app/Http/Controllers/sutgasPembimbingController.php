<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\surat_tugas;
use App\detail_skripsi;
use PDF;
use Exception;
use App\User;
use App\keris;
use App\mahasiswa;

//Surat Tugas Pembimbing Controller
class sutgasPembimbingController extends suratTugasController
{
    public function index()
	{
        $surat_tugas = surat_tugas::with('tipe_surat_tugas')
            ->whereHas('tipe_surat_tugas',function(Builder $query){
                $query->where('tipe_surat','Surat Tugas Pembimbing');
            })->get();
        return view('akademik.sutgas_pembimbing.index', [
            '$surat_tugas' => $surat_tugas
		]);
	}

	public function create()
	{
        $mahasiswa = mahasiswa::doesntHave('detail_skripsi')->get();
		$dosen = user::where('is_dosen', 1)->get();
		$keris = keris::all();
		return view('akademik.sutgas_pembimbing.create', [
			'dosen' => $dosen,
			'keris' => $keris,
			'mahasiswa' => $mahasiswa
		]);
    }

	public function store(Request $request)
	{
        $this->validate($request, [
            'nim' => 'required',
            'no_surat' => 'required',
            'judul' => 'required',
            'id_keris' => 'required',
            'id_pembimbing_utama' => 'required',
            'id_pembimbing_pendamping' => 'required'
        ]);
        try{
            $this->store_sutgas($request,1,1);
            return redirect()->route('akademik.sutgas-pembimbing.create')->with('success', 'Data Surat Tugas Berhasil Ditambahkan');
        }catch(Exception $e){
            dd($e->getMessage());
            return redirect()->route('akademik.sutgas-pembimbing.create')->with('error', $e->getMessage());
        }
	}

	public function show()
	{
        return view('akademik.sutgas_pembimbing.show');
	}












	public function newSempro()
	{
		$dosen = user::where('is_dosen', 1)->get();
		return view('akademik.sk.create', [
			'dosen' => $dosen,
		]);
	}

	public function storeSempro(Request $request)
	{
		dd($request->all());
	}
}

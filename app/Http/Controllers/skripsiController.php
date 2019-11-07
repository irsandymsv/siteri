<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\skripsi;
use App\mahasiswa;
use App\detail_skripsi;

class skripsiController extends Controller
{
    public function index()
    {
    	$data_skripsi = skripsi::with(['mahasiswa', 'status_skripsi'])->get();
    	return view('akademik.skripsi.index', ['data_skripsi' => $data_skripsi]);
    }

    public function ubahJudul($id)
    {
    	$skripsi = skripsi::where('id', $id)->with(['status_skripsi', 'mahasiswa', 'detail_skripsi'])
    	->whereHas('detail_skripsi', function(Builder $query)
    	{
    		$query->max('created_at');
    	})
    	->first();
    	return view('akademik.skripsi.ubahJudul', ['skripsi' => $skripsi]);

    }

    public function updateJudul(Request $request, $id)
    {
    	# code...
    }
}

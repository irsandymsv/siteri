<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\surat_tugas;
use App\sk_sempro;
use App\sk_skripsi;

class KTUController extends Controller
{
    public function dashboard()
    {
    	//Surat Tugas Akademik yg Butuh Verifikasi
    	$sutgas_dikirim = surat_tugas::with(["tipe_surat_tugas", "status_surat_tugas"])
    	->whereHas("status_surat_tugas", function (Builder $query)
    	{
    		$query->where("status", "Dikirim");
    	})->orderBy('created_at', 'desc')->get();

    	//SK Sempro yg Butuh Verifikasi
    	$sk_sempro_dikirim = sk_sempro::with("status_sk")
    	->whereHas("status_sk", function (Builder $query)
    	{
    		$query->where("status", "Dikirim");
    	})->orderBy('created_at', 'desc')->get();

    	//SK Skripsi yg Butuh Verifikasi
    	$sk_skripsi_dikirim = sk_skripsi::with("status_sk")
    	->whereHas("status_sk", function (Builder $query)
    	{
    		$query->where("status", "Dikirim");
    	})->orderBy('created_at', 'desc')->get();

    	return view('ktu.dashboard', [
    		'sutgas_dikirim' => $sutgas_dikirim,
    		'sk_sempro_dikirim' => $sk_sempro_dikirim,
    		'sk_skripsi_dikirim' => $sk_skripsi_dikirim
    	]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\surat_tugas;
use App\sk_sempro;
use App\sk_skripsi;

class akademikController extends Controller
{
    public function dashboard()
    {
    	//Surat berstatus Draft
    	$sutgas_draft = surat_tugas::where("verif_ktu", 0)
    	->with(["tipe_surat_tugas", "status_surat_tugas"])
    	->whereHas("status_surat_tugas", function (Builder $query)
    	{
    		$query->where("status", "Draft");
    	})->orderBy('created_at', 'desc')->get();

    	$sk_sempro_draft = sk_sempro::where("verif_ktu", 0)->with("status_sk")
    	->whereHas("status_sk", function (Builder $query)
    	{
    		$query->where("status", "Draft");
    	})->orderBy('created_at', 'desc')->get();

    	$sk_skripsi_draft = sk_skripsi::where("verif_ktu", 0)->with("status_sk")
    	->whereHas("status_sk", function (Builder $query)
    	{
    		$query->where("status", "Draft");
    	})->orderBy('created_at', 'desc')->get();

    	//Surat yang Butuh Revisi
    	$sutgas_revisi = surat_tugas::where("verif_ktu", 2)
    	->with(["tipe_surat_tugas", "status_surat_tugas"])
    	->orderBy('created_at', 'desc')->get();

    	$sk_sempro_revisi = sk_sempro::where("verif_ktu", 2)
    	->with("status_sk")
    	->orderBy('created_at', 'desc')->get();

    	$sk_skripsi_revisi = sk_skripsi::where("verif_ktu", 2)
    	->with("status_sk")
    	->orderBy('created_at', 'desc')->get();

    	return view('akademik.dashboard', [
    		'sutgas_draft' => $sutgas_draft,
    		'sk_sempro_draft' => $sk_sempro_draft,
    		'sk_skripsi_draft' => $sk_skripsi_draft,
    		'sutgas_revisi' => $sutgas_revisi,
    		'sk_sempro_revisi' => $sk_sempro_revisi,
    		'sk_skripsi_revisi' => $sk_skripsi_revisi,
    	]);
    }
}

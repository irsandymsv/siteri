<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sk_sempro;
use App\sk_skripsi;
use Illuminate\Database\Eloquent\Builder;

class KeuanganController extends Controller
{
    public function dashboard()
    {
    	$sk_sempro_baru = sk_sempro::with([
    		'status_sk' => function ($query){
    			$query->where('status', 'Disetujui KTU');
    		}
    	])
    	->doesntHave('sk_honor')->orderBy('created_at', 'desc')->get();

    	$sk_skripsi_baru = sk_skripsi::with([
    		'status_sk' => function ($query)
    		{
    			$query->where('status', 'Disetujui KTU');
    		}
    	])
    	->doesntHave('sk_honor')->orderBy('created_at', 'desc')->get();

    	return view('keuangan.dashboard', [
    		'sk_sempro_baru' => $sk_sempro_baru,
    		'sk_skripsi_baru' => $sk_skripsi_baru
    	]);
    }
}

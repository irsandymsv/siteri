<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sk_honor;

class bppController extends Controller
{
    public function dashboard()
    {
    	$sk_honor_sempro = sk_honor::orderBy('updated_at', 'desc')
        ->with(['sk_sempro', 'status_sk_honor'])
        ->doesntHave('sk_skripsi')->take(3)->get();

        $sk_honor_skripsi = sk_honor::orderBy('updated_at', 'desc')
        ->with(['sk_skripsi', 'status_sk_honor'])
        ->doesntHave('sk_sempro')->take(3)->get();

        // dd($sk_honor_sempro);
    	return view('bpp.dashboard', [
    		'sk_honor_sempro' => $sk_honor_sempro,
    		'sk_honor_skripsi' => $sk_honor_skripsi
    	]);
    }
}

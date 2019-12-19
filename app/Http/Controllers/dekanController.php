<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\sk_sempro;
use App\sk_skripsi;
use App\sk_honor;

class dekanController extends Controller
{
    public function dashboard()
    {
    	//SK Sempro Terbaru
    	$sk_sempro = sk_sempro::with("status_sk")
    	->whereHas("status_sk", function (Builder $query)
    	{
    		$query->where("status", "Disetujui KTU");
    	})->orderBy('created_at', 'desc')->take(3)->get();

    	//SK Skripsi Terbaru
    	$sk_skripsi = sk_skripsi::with("status_sk")
    	->whereHas("status_sk", function (Builder $query)
    	{
    		$query->where("status", "Disetujui KTU");
    	})->orderBy('created_at', 'desc')->take(3)->get();

    	//SK Honor Sempro
      $sk_honor_sempro = sk_honor::orderBy('updated_at', 'desc')
      ->with(['sk_sempro', 'status_sk_honor'])
      ->doesntHave('sk_skripsi')->take(3)->get();

      //SK Honor Skripsi
      $sk_honor_skripsi = sk_honor::orderBy('updated_at', 'desc')
      ->with(['sk_skripsi', 'status_sk_honor'])
      ->doesntHave('sk_sempro')->take(3)->get();

    	return view('dekan.dashboard', [
    		'sk_sempro' => $sk_sempro,
    		'sk_skripsi' => $sk_skripsi,
    		'sk_honor_sempro' => $sk_honor_sempro,
    		'sk_honor_skripsi' => $sk_honor_skripsi
    	]);
    }
}

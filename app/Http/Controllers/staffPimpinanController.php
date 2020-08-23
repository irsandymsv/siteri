<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dosen_tugas;
use App\surat_kepegawaian;
use App\User;
use App\pemateri;
use App\status_surat;

class staffPimpinanController extends Controller
{
    public function dashboard()
    {
    	$surat = surat_kepegawaian::where('status', 5)->get();
    	$dosen_sk = dosen_tugas::all();
    	$pemateri = pemateri::all();
    	return view('staff_pimpinan.dashboard', compact('surat', 'dosen_sk','pemateri'));
    }
}

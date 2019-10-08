<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkSkripsiController extends Controller
{
    public function create(){
        
        return view('akademik.skripsi.create');
    }

    public function index()
    {
    	return view('akademik.Skripsi.index');
    }

    public function create(){
    	$jurusan = array(
    		'si' => "Sistem Informasi",
    		'ti' => "Teknologi Informasi",
    		'if' => "Informatika"
    	);

    	$dosen = array(
    		'1' => "Saiful Bukhori",
    		'2' => "Anang Hermansyah",
    		'3' => "Windy",
    		'4' => "Beny Prasetyo",
    		'5' => "Slamin",
    		'6' => "Januar", 
    	);

        return view('akademik.skripsi.create-form', [
        	'jurusan' => $jurusan,
        	'dosen' => $dosen
        ]);
    }

    public function store(Request $request)
    {
    	
    }
}

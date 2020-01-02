<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mahasiswa;
use App\bagian;

class mahasiswaController extends Controller
{
   public function index()
   {
   	$mahasiswa = mahasiswa::with('bagian')->get();
    	
    	return view('kemahasiswaan.mahasiswa.index', ['mahasiswa' => $mahasiswa]);
   }

   public function create()
   {
   	$bagian = bagian::where('is_jurusan', 1)->get();

   	return view('kemahasiswaan.mahasiswa.create', ['bagian' => $bagian]);
   }

   public function show($nim)
   {
   	$mahasiswa = mahasiswa::where('nim', $nim)->with('bagian')->first();
   	// dd($mahasiswa);
   	return view('kemahasiswaan.mahasiswa.show', ['mahasiswa' => $mahasiswa]);
   }

   public function edit($nim)
   {
   	$bagian = bagian::where('is_jurusan', 1)->get();
   	$mahasiswa = mahasiswa::where('nim', $nim)->with('bagian')->first();

   	return view('kemahasiswaan.mahasiswa.edit', [
   		'bagian' => $bagian,
   		'mahasiswa'=>$mahasiswa
   	]);
   }
}

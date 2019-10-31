<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;

//Surat Tugas Pembimbing Controller
class sutgasPembimbingController extends Controller
{
    public function index()
	{
		return view('akademik.sutgas_pembimbing.index', [
			
		]);
	}

	public function create()
	{
		$dosen = user::where('is_dosen', 1)->get();
		return view('akademik.sutgas_pembimbing.create', [
			'dosen' => $dosen
		]);
	}

	public function store(Request $request)
	{
		
	}

	public function show()
	{
		return view('akademik.sutgas_pembimbing.show');
	}

	public function newSempro()
	{
		$dosen = user::where('is_dosen', 1)->get();
		return view('akademik.sk.create', [
			'dosen' => $dosen
		]);
	}

	public function storeSempro(Request $request)
	{
		dd($request->all());
	}
}

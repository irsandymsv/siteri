<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nama_honor;
use App\histori_besaran_honor;

class honorController extends Controller
{
	//Nama Honor
    public function index()
    {
    	$honor = nama_honor::with(['histori_besaran_honor' => function($query)
	    	{
	    		$query->orderBy('created_at', 'desc');	
	    	}
    	])->get();
    	return view('honor.index', ['honor' => $honor]);
    }

    public function create()
    {
    	return view('honor.create');
    }

    public function store(Request $request)
    {
    	
    }

    public function edit($id)
    {
    	$honor = nama_honor::where('id', $id)
    	->with(['histori_besaran_honor' => function ($query)
	    	{
	    		$query->oredrBy('created_at', 'desc');
	    	}
    	])->first();
    	return view('honor.edit', ['honor' => $honor]);
    }

    public function update(Request $request, $id)
    {
    	# code...
    }
}

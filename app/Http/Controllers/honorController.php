<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nama_honor;
use App\histori_besaran_honor;
use Carbon\Carbon;
use Exception;

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

        $this->validate($request,[
            "nama_honor" => 'required',
            "jumlah_honor" => 'required'
        ]);

        try{
            $nama_honor = nama_honor::create([
                'nama_honor'=> $request->input('nama_honor')
            ]);
            $this->buat_histori_besaran_honor($nama_honor->id, $request->jumlah_honor);

            return redirect()->route('honor.index')->with('message','Data Berhasil Dibuat');

        }catch(Exception $e){
            return redirect()->route('honor.create')->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
    	$honor = nama_honor::where('id', $id)
    	->with(['histori_besaran_honor' => function ($query)
	    	{
	    		$query->orderBy('created_at', 'desc');
	    	}
    	])->first();
    	return view('honor.edit', ['honor' => $honor]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "nama_honor" => 'required',
            "jumlah_honor" => 'required'
        ]);

        try {
            nama_honor::where('id',$id)->update([
                'nama_honor' => $request->input('nama_honor')
            ]);
            $this->buat_histori_besaran_honor($id,$request->jumlah_honor);
            return redirect()->route('honor.index')->with('message', 'Data Berhasil Dibuat');
        } catch (Exception $e) {
            return redirect()->route('honor.update',$id)->with('error', $e->getMessage());
        }
    }

    private function buat_histori_besaran_honor(int $id,int $jumlah_honor)
    {
        histori_besaran_honor::insert([
            'jumlah_honor' => $jumlah_honor,
            'id_nama_honor' => $id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

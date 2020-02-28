<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mahasiswa;
use App\prodi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Exception;

class mahasiswaController extends Controller
{
   public function kemahasiswaan_dashboard($value='')
   {
   	$jml_mhs = mahasiswa::count();
   	// dd($jml_mhs);
      return view('kemahasiswaan.dashboard', ['jml_mhs' => $jml_mhs]);
   }

   public function index()
   {
   	$mahasiswa = mahasiswa::with('prodi')->get();

    	return view('kemahasiswaan.mahasiswa.index', ['mahasiswa' => $mahasiswa]);
   }

   public function create()
   {
   	$prodi = prodi::all();

   	return view('kemahasiswaan.mahasiswa.create', ['prodi' => $prodi]);
   }

   public function store(Request $request){
      $this->validate($request, [
         'nim' => 'required|min:12|unique:mahasiswa,nim',
         'nama' => 'required',
         'id_prodi' => 'required'
      ]);

     try{
         mahasiswa::create([
             'nim' => $request->input('nim'),
             'nama' => $request->input('nama'),
             'id_prodi' => $request->input('id_prodi')
         ]);
         return redirect()->route('kemahasiswaan.mahasiswa.create')->with('success','Data Berhasil Dibuat');
      }catch(Exception $e){
         return redirect()->route('kemahasiswaan.mahasiswa.create')->with('error', $e->getMessage());
      }
   }

   public function show($nim)
   {
   	$mahasiswa = mahasiswa::where('nim', $nim)->with('prodi')->first();
   	// dd($mahasiswa);
   	return view('kemahasiswaan.mahasiswa.show', ['mahasiswa' => $mahasiswa]);
   }

   public function edit($nim)
   {
   	$prodi = prodi::where('is_jurusan', 1)->get();
   	$mahasiswa = mahasiswa::where('nim', $nim)->with('prodi')->first();

   	return view('kemahasiswaan.mahasiswa.edit', [
   		'prodi' => $prodi,
   		'mahasiswa'=>$mahasiswa
   	]);
   }

   public function update($id, Request $request){
        $validator = Validator::make($request->all(), [
            'nim' => [
                'required',
                Rule::unique('mahasiswa', 'nim')->ignore($id, 'nim'),

            ],
            'nama' => 'required',
            'id_prodi' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('kemahasiswaan.mahasiswa.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
        try{
            mahasiswa::where('nim',$id)->update([
                'nim' => $request->input('nim'),
                'nama' => $request->input('nama'),
                'id_prodi' => $request->input('id_prodi')
            ]);
            return redirect()->route('kemahasiswaan.mahasiswa.edit', $request->input('nim'))->with('success', 'Data Berhasil Diubah');
        }catch(Exception $e){
            return redirect()->route('kemahasiswaan.mahasiswa.edit', $id)->with('error', $e->getMessage());
        }
   }
}

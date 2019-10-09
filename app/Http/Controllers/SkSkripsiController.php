<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;
use App\bagian;
use App\User;
use App\sk_akademik;
use App\detail_sk;
use App\penguji;
use App\pembimbing;
use App\Http\Controllers\Controller;

class SkSkripsiController extends Controller
{

    public function index()
    {
		// try{
		// 	$sk_akademik = sk_akademik::all();
		// 	return view('akademik.Skripsi.index', ['sk_akademik' => $sk_akademik]);
		// }catch(Exception $e){
				return view('akademik.Skripsi.index');
		// }
		
    }

    public function create(Request $request){
        $old_data = [];
        if (count($request->old()) > 0) {
            // dd($request->old()['nama']);
            $old_data = $request->old();
        }     

		$jurusan= bagian::where('is_jurusan',1)->get();
    	// $jurusan = array(
    	// 	'si' => "Sistem Informasi",
    	// 	'ti' => "Teknologi Informasi",
    	// 	'if' => "Informatika"
		// );

		$dosen = user::where('is_dosen', 1)->get();
    	// $dosen = array(
    	// 	'1' => "Saiful Bukhori",
    	// 	'2' => "Anang Hermansyah",
    	// 	'3' => "Windy",
    	// 	'4' => "Beny Prasetyo",
    	// 	'5' => "Slamin",
    	// 	'6' => "Januar", 
    	// );


        return view('akademik.skripsi.create-form', [
        	'jurusan' => $jurusan,
        	'dosen' => $dosen,
            'old_data' => $old_data
        ]);
    }

    public function store(Request $request)
    {
		// dd($request);
		$this->validate($request, [
			"nama"    => "required|array",
			"nama.*"  => "required|string|max:40",
			"nim" => "required|array",
			"nim.*" => "required|string|max:20",
			"jurusan" => "required|array",
			"jurusan.*" => "required",
			"judul" => "required|array",
			"judul.*" => "required",
			"pembimbing_utama" => "required|array",
			"pembimbing_utama.*" => "required",
			"pembimbing_pendamping" => "required|array",
			"pembimbing_pendamping.*" => "required",
			"penguji_utama" => "required|array",
			"penguji_utama.*" => "required",
			"penguji_pendamping" => "required|array",
			"penguji_pendamping.*" => "required",
		]);

		try{
			$sk_akademik = sk_akademik::create([
				'id_tipe_sk' => 0,
				'id_status_akademik' => $request->status,
				'id_user' => $request->id_user
			]);
			// $sk_akademik = sk_akademik::where('id_user', $request->id_user)->order_by('created_at', 'desc')->first();
			for($i=0;$i< count($request->nama);$i++){
				$detail_sk = detail_sk::create([
					'id_sk_akademik' => $sk_akademik->id,
					'nama_mhs' => $request->nama[$i],
					'nim' =>$request->nim[$i],
					'id_bagian' => $request->jurusan[$i],
					'judul' => $request->judul[$i],
				]);
				// $id_user = $request->id_user;
				// $detail_sk = detail_sk::with(['sk_akademik' => function ($query) use ($id_user){
				// 	$query->where('id_user', $id_user);
				// }])->order_by('id', 'desc')->first();
				pembimbing::create([
					'id_detail_sk' => $detail_sk->id,
					'id_pembimbing_utama' => $request->id_pembimbing_utama,
					'id_pembimbing_pendamping' => $request->id_pembimbing_pendamping,
				]);
				penguji::create([
					'id_detail_sk' => $detail_sk->id,
					'id_penguji_utama' => $request->id_penguji_utama,
					'id_penguji_pendamping' => $request->id_penguji_pendamping,
				]);

				return redirect()->route('skripsi.create')->with('success','Data Berhasil Ditambahkan');
			}
		} catch(Exception $e){
			return redirect()->route('skripsi.create')->with('error',$e->getMessage());
		}

	}
	
	public function edit($id){
		// try{
			// $sk_akademik = sk_akademik::where('id',$id)->get();
		// 	$detail_sk = detail_sk::with('pembimbing,penguji')->where('id_sk_akademik')->get();
		// 	return view('akademik.Skripsi.edit',['detail_sk'=>$detail_sk,'sk_akademik'=>$sk_akademik]);
		// }catch(Exception $e){
			// return redirect()->route('skripsi.index')->with('error',$e->getMessage());
		// }

		return view('akademik.skripsi.index');
	}

	public function update(Request $request, $id){

	}

	public function destroy($id){
		sk_akademik::where('id',$id);
		return redirect()->route('skripsi.index')->with('success','Data Berhasil Dihapus');
		
	}
}

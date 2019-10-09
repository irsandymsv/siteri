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
		// }
		return view('akademik.Skripsi.index');
		
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
		// dd($request->status);
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
				'id_tipe_sk' => 1,
				'id_status_sk_akademik' => $request->status
			]);
			// $sk_akademik = sk_akademik::where('id_user', $request->id_user)->order_by('created_at', 'desc')->first();
			for($i=0;$i< count($request->nama);$i++){
				$detail_sk = detail_sk::create([
					'id_sk_akademik' => $sk_akademik->id,
					'nama_mhs' => $request->nama[$i],
					'nim' => $request->nim[$i],
					'id_bagian' => $request->jurusan[$i],
					'judul' => $request->judul[$i],
				]);
				// $id_user = $request->id_user;
				// $detail_sk = detail_sk::with(['sk_akademik' => function ($query) use ($id_user){
				// 	$query->where('id_user', $id_user);
				// }])->order_by('id', 'desc')->first();
				pembimbing::create([
					'id_detail_sk' => $detail_sk->id,
					'id_pembimbing_utama' => $request->pembimbing_utama[$i],
					'id_pembimbing_pendamping' => $request->pembimbing_pendamping[$i],
				]);
				penguji::create([
					'id_detail_sk' => $detail_sk->id,
					'id_penguji_utama' => $request->penguji_utama[$i],
					'id_penguji_pendamping' => $request->penguji_pendamping[$i],
				]);

			}

			return redirect()->route('akademik.skripsi.index')->with('success','Data Berhasil Ditambahkan');
		} catch(Exception $e){
			return redirect()->route('akademik.skripsi.create')->with('error',$e->getMessage());
		}

	}

	public function show($id)
	{
		$data = new detail_sk();
		$data->id = $id;
		$data->status = 2;
		return view('akademik.Skripsi.show', [
			"data" => $data
		]);
	}
	
	public function edit($id){
		try{
			$jurusan= bagian::where('is_jurusan',1)->get();
			$dosen = user::where('is_dosen', 1)->get();
			$detail_sk = detail_sk::with('pembimbing,penguji')->where('id_sk_akademik', $id)->get();

			return view('akademik.Skripsi.edit',[
				'detail_sk'=>$detail_sk,
				'jurusan' => $jurusan,
				'dosen' => $dosen
			]);
		}catch(Exception $e){
			return redirect()->route('skripsi.index')->with('error',$e->getMessage());
		}
	}

	public function update(Request $request, $id){
		try{
			$this->validate($request, [
				"id_detail_sk" => "required|array",
				"id_detail_sk.*" => "required",
				"nama"    => "required|array",
				"nama.*"  => "required|string|max:40",
				"nim" => "required|array",
				"nim.*" => "required|string|max:20",
				"jurusan" => "required|array",
				"jurusan.*" => "required",
				"judul" => "required|array",
				"judul.*" => "required",
				"id_pembimbing" => "required|array",
				"id_pembimbing.*" => "required",
				"pembimbing_utama" => "required|array",
				"pembimbing_utama.*" => "required",
				"pembimbing_pendamping" => "required|array",
				"pembimbing_pendamping.*" => "required",
				"id_penguji" => "required|array",
				"id_penguji.*" => "required",
				"penguji_utama" => "required|array",
				"penguji_utama.*" => "required",
				"penguji_pendamping" => "required|array",
				"penguji_pendamping.*" => "required",
			]);
			for($i = 0;$i<count($request->nama);$i++){
				$detail_sk = detail_sk::update([

				])->where('id',$request->id_detail_sk[$i]);
			}

		}catch(Exception $e){
			
		}
	}

	public function destroy($id){
		sk_akademik::where('id',$id);
		return redirect()->route('skripsi.index')->with('success','Data Berhasil Dihapus');
	}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Exception;
use App\bagian;
use App\User;
use App\sk_akademik;
use App\detail_sk;
use App\penguji;
use App\pembimbing;
use App\Http\Controllers\Controller;
use App\status_sk_akademik;

class SkSkripsiController extends Controller
{
	public function index()
	{
		try {
			$sk_akademik = sk_akademik::with(['tipe_sk', 'status_sk_akademik'])
										->whereHas('tipe_sk',function (Builder $query){
												$query->where('id',1);
										})->orderBy('created_at', 'desc')->get();
			// dd($sk_akademik);

			return view('akademik.SK_view.index', [
				'sk_akademik' => $sk_akademik,
				'tipe' => "sk skripsi"
			]);
		} catch (Exception $e) {
			return view('akademik.SK_view.index');
		}
	}

	public function create(Request $request)
	{
		$old_data = [];
		if (count($request->old()) > 0) {
			// dd($request->old()['nama']);
			$old_data = $request->old();
		}
		$jurusan = bagian::where('is_jurusan', 1)->get();
		$dosen = user::where('is_dosen', 1)->get();
		return view('akademik.SK_view.create-form', [
			'jurusan' => $jurusan,
			'dosen' => $dosen,
			'old_data' => $old_data,
			'tipe' => "sk skripsi"
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
		try {
			$sk_akademik = sk_akademik::create([
				'id_tipe_sk' => 1,
				'id_status_sk_akademik' => $request->status
			]);
			for ($i = 0; $i < count($request->nama); $i++) {
				$detail_sk = detail_sk::create([
					'id_sk_akademik' => $sk_akademik->id,
					'nama_mhs' => $request->nama[$i],
					'nim' => $request->nim[$i],
					'id_bagian' => $request->jurusan[$i],
					'judul' => $request->judul[$i],
					'id_pembimbing_utama' => $request->pembimbing_utama[$i],
					'id_pembimbing_pendamping' => $request->pembimbing_pendamping[$i],
					'id_penguji_utama' => $request->penguji_utama[$i],
					'id_penguji_pendamping' => $request->penguji_pendamping[$i]
				]);
			}
			return redirect()->route('akademik.skripsi.show', $sk_akademik->id)->with('success', 'Data Berhasil Ditambahkan');
		} catch (Exception $e) {
			return redirect()->route('akademik.skripsi.create')->with('error', $e->getMessage());
		}
	}

	public function show($id)
	{
		$sk_akademik = sk_akademik::find($id);
		$detail_sk = detail_sk::where('id_sk_akademik', $id)
			->with([
				'bagian',
				'penguji_utama:no_pegawai,nama',
				'penguji_pendamping:no_pegawai,nama',
				'pembimbing_utama:no_pegawai,nama',
				'pembimbing_pendamping:no_pegawai,nama'
			])->get();
		// dd($detail_sk);
		return view('akademik.SK_view.show', [
			'sk_akademik' => $sk_akademik,
			'detail_sk' => $detail_sk,
			'tipe' => "sk skripsi"
		]);
	}

	public function edit(Request $request, $id)
	{
		$old_data = [];
		if (count($request->old()) > 0) {
			// dd($request->old()['nama']);
			$old_data = $request->old();
		}
		try {
			$jurusan = bagian::where('is_jurusan', 1)->get();
			$dosen = user::where('is_dosen', 1)->get();
			$sk_akademik = sk_akademik::find($id);
			$detail_sk = detail_sk::where('id_sk_akademik', $id)
				->with([
					'bagian',
					'penguji_utama:no_pegawai,nama',
					'penguji_pendamping:no_pegawai,nama',
					'pembimbing_utama:no_pegawai,nama',
					'pembimbing_pendamping:no_pegawai,nama'
				])->get();
				
			return view('akademik.SK_view.edit', [
				'sk_akademik' => $sk_akademik,
				'detail_sk' => $detail_sk,
				'jurusan' => $jurusan,
				'dosen' => $dosen,
				'old_data' => $old_data,
				'tipe' => "sk skripsi"
			]);
		} catch (Exception $e) {
			return redirect()->route('akademik.SK_view.index')->with('error', $e->getMessage());
		}
	}

	public function update(Request $request, $id)
	{
		// dd($request);
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
			// "id_pembimbing" => "required|array",
			// "id_pembimbing.*" => "required",
			"pembimbing_utama" => "required|array",
			"pembimbing_utama.*" => "required",
			"pembimbing_pendamping" => "required|array",
			"pembimbing_pendamping.*" => "required",
			// "id_penguji" => "required|array",
			// "id_penguji.*" => "required",
			"penguji_utama" => "required|array",
			"penguji_utama.*" => "required",
			"penguji_pendamping" => "required|array",
			"penguji_pendamping.*" => "required",
		]);

		try {
			$sk_akademik = sk_akademik::where('id', $id)->update([
				'id_status_sk_akademik' => $request->status
			]);

			for ($i = 0; $i < count($request->id_detail_sk); $i++) {
				if ($request->id_detail_sk[$i] != 0) {
					// echo('||detele = '.$request->delete_detail_sk[$i].'|| ');
					// echo ($request->delete_detail_sk[$i] == 1);
					if ($request->delete_detail_sk[$i] == 1) {
						// echo('delete');
						detail_sk::where('id', $request->id_detail_sk[$i])->delete();
						continue;
					} else {
						$detail_sk = detail_sk::where('id', $request->id_detail_sk[$i])->update([
							'nama_mhs' => $request->nama[$i],
							'nim' => $request->nim[$i],
							'id_bagian' => $request->jurusan[$i],
							'judul' => $request->judul[$i],
							'id_pembimbing_utama' => $request->pembimbing_utama[$i],
							'id_pembimbing_pendamping' => $request->pembimbing_pendamping[$i],
							'id_penguji_utama' => $request->penguji_utama[$i],
							'id_penguji_pendamping' => $request->penguji_pendamping[$i]
						]);
					}
				} else {
					echo "new data,iterasi= " . $i . "<br>";
					$detail_sk = detail_sk::create([
						'id_sk_akademik' => $id,
						'nama_mhs' => $request->nama[$i],
						'nim' => $request->nim[$i],
						'id_bagian' => $request->jurusan[$i],
						'judul' => $request->judul[$i],
						'id_pembimbing_utama' => $request->pembimbing_utama[$i],
						'id_pembimbing_pendamping' => $request->pembimbing_pendamping[$i],
						'id_penguji_utama' => $request->penguji_utama[$i],
						'id_penguji_pendamping' => $request->penguji_pendamping[$i]
					]);
				}
				// else{
				// 	dd($request->id_detail_sk[$i]);
				// 	//enek kejanggalan lek mlebu kene
				// }
			}
			return redirect()->route('akademik.skripsi.show', $id)->with('success', 'Data Berhasil Diedit');
		} catch (Exception $e) {
			return redirect()->route('akademik.skripsi.index')->with('error', $e->getMessage());
		}
	}
	
	public function destroy($id = null)
	{
		if (!is_null($id)) {
			sk_akademik::find($id)->delete();
			echo 'Data SK Berhasil Dihapus';
		}
	}
}

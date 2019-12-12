<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use PDF;
use App\bagian;
use App\User;
use App\mahasiswa;
use App\sk_skripsi;
use App\detail_skripsi;
use App\skripsi;
use App\template;
use App\nama_template;
use App\status_sk;
use Carbon\Carbon;

class SkSkripsiController extends Controller
{
	public function index()
	{
		try {
			$sk = sk_skripsi::with(['status_sk'])
			->orderBy('updated_at', 'desc')->get();
			// dd($sk);

			return view('akademik.SK_view.index', [
				'sk' => $sk,
				'tipe' => "SK Skripsi"
			]);
		} catch (Exception $e) {
			return view('akademik.SK_view.index');
		}
	}

	public function create(Request $request)
	{
		$old_data = [];
     	$old_mahasiswa = "";
     	if (array_key_exists('nim', $request->old())) {
         // dd($request->old());
         $old_data = $request->old();
         $old_mahasiswa = mahasiswa::whereIn('nim', $request->old()["nim"])
         ->with([
            "bagian",
            "skripsi",
            "skripsi.status_skripsi",
            "skripsi.detail_skripsi" => function($query)
            {
               $query->orderBy('created_at', 'desc');
            },
            "skripsi.detail_skripsi.surat_tugas" => function($query)
            {
            	$query->where('id_tipe_surat_tugas', 1)
	            ->orWhere('id_tipe_surat_tugas', 3)
	            ->orderBy('created_at', 'desc');
            },
            "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
            "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
            "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
         ])->get();
     	}

     	$dosen = user::where('is_dosen', 1)->get();
     	$mahasiswa = mahasiswa::with([
         "bagian",
         "skripsi",
         "skripsi.status_skripsi",
         "skripsi.detail_skripsi" => function($query)
         {
             $query->orderBy('created_at', 'desc');
         },
         "skripsi.detail_skripsi.surat_tugas" => function($query)
         {
            $query->where('id_tipe_surat_tugas', 1)
            ->orWhere('id_tipe_surat_tugas', 3)
            ->orderBy('created_at', 'desc');
         },
         "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
         "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
         "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
     	])
     	->whereHas("skripsi.status_skripsi", function(Builder $query)
     	{
         $query->where("status", "Sudah Punya Penguji");
     	})->get();

     	// dd($mahasiswa);
     	return view('akademik.SK_view.create_sk_skripsi', [
         'dosen' => $dosen,
         'mahasiswa' => $mahasiswa,
         'old_data' => $old_data,
         'old_mahasiswa' => $old_mahasiswa
     	]);
	}

	public function store(Request $request)
	{
        if ($request->input("status") == 2) {
            $this->validate($request, [
                "nim" => "required|array",
                "nim.*" => "required",
                "tgl_sk_pembimbing" => "required",
                "tgl_sk_penguji" => "required",
                "status" => "required",
                "no_surat_pembimbing" => "required",
                "no_surat_penguji" => "required",
            ]);
        } else {
            $this->validate($request, [
                "no_surat_pembimbing" => "required",
                "no_surat_penguji" => "required",
                "nim" => "required|array",
                "nim.*" => "required|string"
            ]);
        }
		try {
            $template_pembimbing = template::whereHas('nama_template', function (Builder $query) {
                $query->where('nama', 'SK Pembimbing Skripsi');
            })->orderBy('created_at', 'desc')->first();
            $template_penguji = template::whereHas('nama_template', function (Builder $query) {
                $query->where('nama', 'SK Penguji Skripsi');
            })->orderBy('created_at', 'desc')->first();

            if ($template_pembimbing == false || $template_penguji == false) {
                return redirect()->route('akademik.skripsi.create')->with('error', 'Template Pembimbing atau Penguji Untuk SK Skripsi Tidak Ditemukan');
            } else {
                $sk_skripsi = sk_skripsi::create([
                    "no_surat_pembimbing" => $request->input("no_surat_pembimbing"),
                    "no_surat_penguji" => $request->input("no_surat_penguji"),
                    "tgl_sk_pembimbing" => carbon::parse($request->input("tgl_sk_pembimbing")),
                    "tgl_sk_penguji" => carbon::parse($request->input("tgl_sk_pembimbing")),
                    "id_status_sk" => $request->input("status"),
                    "id_template_penguji" => $template_penguji->id,
                    "id_template_pembimbing" => $template_pembimbing->id
                ]);

                foreach ($request->nim as $nim) {
                    $this->update_id_sk_skripsi($nim, $sk_skripsi->id);
                }
            }

			return redirect()->route('akademik.skripsi.show', $sk_skripsi->id)->with('success', 'Data Berhasil Ditambahkan');
		} catch (Exception $e) {
			return redirect()->route('akademik.skripsi.create')->with('error', $e->getMessage());
		}
	}

	public function show($id)
	{
		$sk = sk_skripsi::find($id);
    	$detail_skripsi = detail_skripsi::where('id_sk_skripsi', $id)
     	->with([
         'skripsi',
         'skripsi.mahasiswa',
         'skripsi.mahasiswa.bagian',
         'surat_tugas' => function($query)
         {
            $query->where('id_tipe_surat_tugas', 1)
         	->orWhere('id_tipe_surat_tugas', 3)
         	->orderBy('created_at', 'desc');
         },
         'surat_tugas.tipe_surat_tugas',
         'surat_tugas.dosen1:no_pegawai,nama',
         'surat_tugas.dosen2:no_pegawai,nama',
     	])->get();

     	// dd($detail_sk);
     	return view('akademik.SK_view.show_sk_skripsi', [
         'sk' => $sk,
         'detail_skripsi' => $detail_skripsi,
         'tipe' => 'sk skripsi'
     	]);
	}

	public function edit(Request $request, $id)
	{
		$old_data = [];
      $old_mahasiswa = "";
      $nim_dihapus = [];
      if (array_key_exists('nim', $request->old())) {

         $old_data = $request->old();
         $old_mahasiswa = mahasiswa::whereIn('nim', $request->old()["nim"])
         ->with([
            "bagian",
            "skripsi",
            "skripsi.status_skripsi",
            "skripsi.detail_skripsi" => function($query)
            {
               $query->orderBy('created_at', 'desc');
            },
            "skripsi.detail_skripsi.surat_tugas" => function($query)
            {
               $query->where('id_tipe_surat_tugas', 1)
         		->orWhere('id_tipe_surat_tugas', 3)
         		->orderBy('created_at', 'desc');
            },
            "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
            "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
            "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
         ])->get();

         foreach ($old_data["nim"] as $key => $value) {
            if ($old_data["pilihan_nim"][$key] == 3) {
               $nim_dihapus [] = $value;
            }
         }
         // dd($nim_dihapus);
      }

      $sk = sk_skripsi::find($id);
      $dosen = user::where('is_dosen', 1)->get();
      $detail_skripsi = detail_skripsi::where('id_sk_skripsi', $id)
      ->with([
         'skripsi',
         'skripsi.mahasiswa',
         'skripsi.mahasiswa.bagian',
         'surat_tugas' => function($query)
         {
            $query->where('id_tipe_surat_tugas', 1)
         	->orWhere('id_tipe_surat_tugas', 3)
         	->orderBy('created_at', 'desc');
         },
         'surat_tugas.tipe_surat_tugas',
         'surat_tugas.dosen1:no_pegawai,nama',
         'surat_tugas.dosen2:no_pegawai,nama',
      ])->get();

      // dd($detail_skripsi);
      $nim_detail = [];
      foreach ($detail_skripsi as $val) {
         $nim_detail[] = $val->skripsi->nim;
      }

      $mahasiswa = mahasiswa::with([
         "bagian",
         "skripsi",
         "skripsi.status_skripsi",
         "skripsi.detail_skripsi" => function($query)
         {
               $query->orderBy('created_at', 'desc');
         },
         "skripsi.detail_skripsi.surat_tugas" => function($query)
         {
            $query->where('id_tipe_surat_tugas', 1)
         	->orWhere('id_tipe_surat_tugas', 3)
         	->orderBy('created_at', 'desc');
         },
         "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
         "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
         "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
      ])
      ->whereHas("skripsi.status_skripsi", function(Builder $query)
      {
         $query->where("status", "Sudah Punya Penguji");
      })
      ->get();
      return view('akademik.SK_view.edit_sk_skripsi', [
         'sk' => $sk,
         'detail_skripsi' => $detail_skripsi,
         'nim_detail' => $nim_detail,
         'mahasiswa' => $mahasiswa,
         'dosen' => $dosen,
         'old_data' => $old_data,
         'old_mahasiswa' => $old_mahasiswa,
         'nim_dihapus' => $nim_dihapus,
         'tipe' => 'sk skripsi'
      ]);
    }

    private function update_id_sk_skripsi($nim, $id)
    {
        $detail_skripsi = detail_skripsi::whereHas('skripsi', function (builder $query) use ($nim) {
            $query->where('nim', $nim);
        })->orderBy('created_at', 'desc')->first();
        $detail_skripsi->id_sk_skripsi = $id;
        $detail_skripsi->save();
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
			$sk = sk_akademik::find($id);
			$verif_ktu = $sk->verif_ktu;
			$verif_dekan = $sk->verif_dekan;
			if($request->status == 2){
				$verif_ktu = 0;
				$verif_dekan = 0;
			}

			$sk_akademik = sk_akademik::where('id', $id)->update([
				'id_status_sk_akademik' => $request->status,
				'verif_ktu' => $verif_ktu,
				'verif_dekan' => $verif_dekan,
				'no_surat' => $request->no_surat
			]);

			for ($i = 0; $i < count($request->id_detail_sk); $i++) {
				if ($request->id_detail_sk[$i] != 0) {
					if ($request->delete_detail_sk[$i] == 1) {
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
			}
			return redirect()->route('akademik.skripsi.show', $id)->with('success', 'Data Berhasil Diedit');
		} catch (Exception $e) {
			return redirect()->route('akademik.skripsi.index')->with('error', $e->getMessage());
		}
	}

	public function destroy($id = null)
	{
		if (!is_null($id)) {
			sk_skripsi::find($id)->delete();
			echo 'Data SK Berhasil Dihapus';
		}
	}

	public function cetak($id)
	{
		$sk = sk_skripsi::where('id', $id)->with(['template_pembimbing', 'template_penguji'])->first();

      $detail_skripsi = detail_skripsi::where('id_sk_skripsi', $id)
      ->with([
         'skripsi',
         'skripsi.mahasiswa',
         'skripsi.mahasiswa.bagian',
         'surat_tugas' => function($query)
         {
         	$query->where('id_tipe_surat_tugas', 1)
         	->orWhere('id_tipe_surat_tugas', 3)
         	->orderBy('created_at', 'desc');
         },
         'surat_tugas.tipe_surat_tugas',
         'surat_tugas.dosen1:no_pegawai,nama',
         'surat_tugas.dosen2:no_pegawai,nama',
      ])->get();

      $dekan = User::with("jabatan")
      ->wherehas("jabatan", function (Builder $query){
         $query->where("jabatan", "Dekan");
      })->first();
      $tahun_akademik = $this->get_tahun_akademik($sk->created_at);

      $pdf = PDF::loadview('akademik.SK_view.pdf_sk_skripsi', [
         'sk' => $sk,
         'detail_skripsi' => $detail_skripsi,
         'dekan' => $dekan,
         'tahun_akademik' => $tahun_akademik
      ])->setPaper('a4', 'portrait')->setWarnings(false);

        // $content = $pdf->download()->getOriginalContent();
        // Storage::put('sempro'.$sk->no_surat.'.pdf', $content);
        // $dom_pdf = $pdf->getDomPDF();
        // $canvas = $dom_pdf->get_canvas();
        // $pdf_merger = PdfMerger::addPDF(Storage::disk('local')->path('sempro' . $sk->no_surat . '.pdf'), 'all');
        // $pdfmerged->addPDF(Storage::disk('local')->path('sempro' . $sk->no_surat . '.pdf'), 'all');
        // $pdfmerged->merge();

      return $pdf->download('SK Skripsi-'. $sk->no_surat);
	}


	//KTU
	public function ktu_index_skripsi()
	{
		$sk = sk_skripsi::with('status_sk')
		->whereHas('status_sk', function(Builder $query){
		    $query->whereIn('id', [2,3,4]);
		})
		->orderBy('updated_at', 'desc')
		->get();

		return view('ktu.SK_view.sk_index', [
		    'sk' => $sk,
		    'tipe' => "SK Skripsi"
		]);
	}

	public function ktu_show($id)
	{
		$sk = sk_skripsi::where('id', $id)->with(['template_pembimbing', 'template_penguji'])->first();
		$status = $sk->status_sk->status;
		if($status == "Draft"){
			return redirect()->route('ktu.sk-skripsi.index');
		}

		$detail_skripsi = detail_skripsi::where('id_sk_skripsi', $id)
		->with([
		   'skripsi',
		   'skripsi.mahasiswa',
		   'skripsi.mahasiswa.bagian',
		   'surat_tugas' => function($query)
		   {
		      $query->where('id_tipe_surat_tugas', 1)
         	->orWhere('id_tipe_surat_tugas', 3)
         	->orderBy('created_at', 'desc');
		   },
		   'surat_tugas.tipe_surat_tugas',
		   'surat_tugas.dosen1:no_pegawai,nama',
		   'surat_tugas.dosen2:no_pegawai,nama',
		])->get();

		$dekan = User::with("jabatan")
		->wherehas("jabatan", function (Builder $query){
		   $query->where("jabatan", "Dekan");
		})->first();
		$tahun_akademik = $this->get_tahun_akademik($sk->created_at);
		return view('ktu.SK_view.sk_skripsi_show', [
			'sk' => $sk,
			'detail_skripsi' => $detail_skripsi,
         'dekan' => $dekan,
         'tahun_akademik' => $tahun_akademik
		]);
	}

	public function ktu_verif(Request $request, $id)
	{
		$sk = sk_skripsi::find($id);
      $sk->verif_ktu = $request->verif_ktu;
      if($request->verif_ktu == 2){
         $request->validate([
               'pesan_revisi' => 'required|string'
         ]);

         $sk->id_status_sk = 1;
         $sk->pesan_revisi = $request->pesan_revisi;
         $sk->save();
         return redirect()->route('ktu.sk-skripsi.index')->with("verif_ktu", 'SK berhasil ditarik, status kembali menjadi "Draft"');
      }
      else if ($request->verif_ktu == 1) {
         $sk->id_status_sk = 3;
         $sk->pesan_revisi = null;
         $sk->save();

         $detail_skripsi = detail_skripsi::where('id_sk_skripsi', $id)->get();
         // dd($detail_skripsi);
         foreach ($detail_skripsi as $value) {
            skripsi::whereHas('detail_skripsi', function (Builder $query) use ($value) {
               $query->where('id', $value->id);
            })->update([
               'id_status_skripsi' => 6
            ]);
         }

         return redirect()->route('ktu.sk-skripsi.show', $id)->with('verif_ktu', 'verifikasi SK berhasil, status SK saat ini "Disetujui KTU"');
      }
	}


	//DEKAN
	// public function dekan_index_skripsi()
	// {
	// 	$sk_akademik = sk_akademik::with(['tipe_sk', 'status_sk_akademik'])
	// 	->whereHas('tipe_sk', function(Builder $query){
	// 		$query->where('id', 1);
	// 	})
	// 	->whereHas('status_sk_akademik', function(Builder $query){
	// 		$query->whereIn('id', [3,4]);
	// 	})
	// 	->orderBy('updated_at', 'desc')
	// 	->get();
	// 	// dd($sk_akademik);
	// 	return view('dekan.SK_view.sk_index', [
	// 		'sk_akademik' => $sk_akademik,
	// 		'tipe' => "SK Skripsi"
	// 	]);
	// }

	// public function dekan_show($id)
	// {
	// 	$sk_akademik = sk_akademik::find($id);
	// 	$status = $sk_akademik->status_sk_akademik;
	// 	if($status->id != 2 && $status->id != 3){
	// 		return redirect()->route('dekan.sk-skripsi.index');
	// 	}

	// 	$detail_sk = detail_sk::where('id_sk_akademik', $id)
	// 		->with([
	// 			'bagian',
	// 			'penguji_utama:no_pegawai,nama',
	// 			'penguji_pendamping:no_pegawai,nama',
	// 			'pembimbing_utama:no_pegawai,nama',
	// 			'pembimbing_pendamping:no_pegawai,nama'
	// 		])->get();
	// 	// dd($detail_sk);
	// 	return view('dekan.SK_view.sk_show', [
	// 		'sk_akademik' => $sk_akademik,
	// 		'detail_sk' => $detail_sk
	// 	]);
	// }

	// public function dekan_verif(Request $request, $id)
	// {
	// 	// dd($request);
	// 	$sk_akademik = sk_akademik::find($id);
	// 	$sk_akademik->verif_dekan = $request->verif_dekan;
	// 	if($request->verif_dekan == 2){
	// 		$request->validate([
	// 			'pesan_revisi' => 'required|string'
	// 		]);

	// 		$sk_akademik->id_status_sk_akademik = 1;
	// 		$sk_akademik->pesan_revisi = $request->pesan_revisi;
	// 		$sk_akademik->save();
	// 		return redirect()->route('dekan.sk-skripsi.index')->with("verif_dekan", 'SK berhasil ditarik, status kembali menjadi "Draft"');
	// 	}
	// 	else if ($request->verif_dekan == 1) {
	// 		$sk_akademik->id_status_sk_akademik = 4;
	// 		$sk_akademik->pesan_revisi = null;
	// 		$sk_akademik->save();
	// 		return redirect()->route('dekan.sk-skripsi.index')->with('verif_dekan', 'verifikasi SK berhasil, status SK saat ini "Disetujui Dekan"');
	// 	}
	// }

}

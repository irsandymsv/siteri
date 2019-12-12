<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\surat_tugas;
use App\detail_skripsi;
use App\skripsi;
use PDF;
use Exception;
use App\User;
use App\keris;
use App\mahasiswa;

//Surat Tugas Pembimbing Controller
class sutgasPembimbingController extends suratTugasController
{
    public function index()
	{
      $surat_tugas = surat_tugas::with(['tipe_surat_tugas', 'status_surat_tugas', 'detail_skripsi', 'detail_skripsi.skripsi.mahasiswa'])
            ->whereHas('tipe_surat_tugas',function(Builder $query){
                $query->where('tipe_surat','Surat Tugas Pembimbing');
            })->orderBy('created_at', 'desc')->get();
            // dd($surat_tugas);
      return view('akademik.sutgas_pembimbing.index', [
            'surat_tugas' => $surat_tugas
		]);
	}

	public function create()
	{
      $mahasiswa = mahasiswa::doesntHave('skripsi')->get();

      // ->orWhereHas('skripsi.status_skripsi', function(Builder $query)
      // {
      // 	$query->where('status', '<>', 'Sudah lulus');
      // })


      // dd($mahasiswa);
		$dosen = user::where('is_dosen', 1)->get();
		$keris = keris::all();
		return view('akademik.sutgas_pembimbing.create', [
			'dosen' => $dosen,
			'keris' => $keris,
			'mahasiswa' => $mahasiswa
		]);
    }

	public function store(Request $request)
	{
        $this->validate($request, [
            'nim' => 'required',
            'no_surat' => 'required',
            'judul' => 'required',
            'id_keris' => 'required',
            'id_pembimbing_utama' => 'required',
            'id_pembimbing_pendamping' => 'required'
        ]);
        try{
            $skripsi = skripsi::create([
                'nim' => $request->input('nim'),
            ]);
            $detail_skripsi = detail_skripsi::create([
                'judul' => $request->input('judul'),
                'id_skripsi' => $skripsi->id,
                'id_keris' => $request->input('id_keris')
            ]);
            $id_baru = $this->store_sutgas(
                $request,
                1,
                $request->status,
                $detail_skripsi->id,
                'id_pembimbing_utama',
                'id_pembimbing_pendamping'
            );
            return redirect()->route('akademik.sutgas-pembimbing.show', $id_baru)->with('success', 'Data Surat Tugas Berhasil Ditambahkan');
        }catch(Exception $e){
            return redirect()->route('akademik.sutgas-pembimbing.create')->with('error', $e->getMessage());
        }
	}

	public function show($id)
	{
		$surat_tugas = surat_tugas::where('id', $id)
		->with([
			"status_surat_tugas",
			"detail_skripsi",
			"detail_skripsi.skripsi.mahasiswa",
			"detail_skripsi.keris",
			"dosen1:no_pegawai,nama",
			"dosen2:no_pegawai,nama"
		])->first();
		// dd($surat_tugas);
      return view('akademik.sutgas_pembimbing.show', [
      	'surat_tugas' => $surat_tugas
      ]);
	}

	public function edit($id)
	{
		$surat_tugas = surat_tugas::where('id', $id)
		->with([
			"detail_skripsi",
			"detail_skripsi.skripsi.mahasiswa",
			"detail_skripsi.keris",
			"dosen1:no_pegawai,nama",
			"dosen2:no_pegawai,nama"
		])->first();



        $mahasiswa = mahasiswa::doesntHave('skripsi')->orWhere("nim", $surat_tugas->detail_skripsi->skripsi->nim)->get();
        // ->orWhereHas('skripsi.status_skripsi', function(Builder $query)
        // {
        // 	$query->where('status', '<>', 'Sudah lulus');
        // })

        // dd($mahasiswa);
		$dosen = user::where('is_dosen', 1)->get();
		$keris = keris::all();

		return view('akademik.sutgas_pembimbing.edit', [
			'surat_tugas' => $surat_tugas,
			'mahasiswa' => $mahasiswa,
			'dosen' => $dosen,
			'keris' => $keris
		]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nim' => 'required',
            'no_surat' => 'required',
            'judul' => 'required',
            'id_keris' => 'required',
            'id_pembimbing_utama' => 'required',
            'id_pembimbing_pendamping' => 'required'
        ]);
        try {
            skripsi::where('id', $request->input('id_skripsi'))->update([
                'nim' => $request->input('nim')
            ]);
            detail_skripsi::where('id', $request->input('id_detail_skripsi'))->update([
                'id_keris' => $request->input('id_keris'),
                'judul' => $request->input('judul')
            ]);
            $this->update_sutgas(
                $request,
                1,
                $request->status,
                $id,
                'id_pembimbing_utama',
                'id_pembimbing_pendamping'
            );
            return redirect()->route('akademik.sutgas-pembimbing.show',$id)->with('success', 'Data Surat Tugas Berhasil Diubah');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('akademik.sutgas-pembimbing.edit', $id)->with('error', $e->getMessage());
        }
    }

    private function update_detail_skripsi(Request $request)
    {
        detail_skripsi::where('id', $request->input('id_detail_skripsi'))->update([
            'id_keris' => $request->input('id_keris'),
            'judul' => $request->input('judul')
        ]);
    }

    public function cetak_pdf($id)
    {
    	$surat_tugas = surat_tugas::where('id', $id)
    	->with([
    		"detail_skripsi",
    		"detail_skripsi.skripsi.mahasiswa",
    		"detail_skripsi.keris",
    		"dosen1:no_pegawai,nama,id_fungsional",
    		"dosen1.fungsional",
    		"dosen2:no_pegawai,nama,id_fungsional",
    		"dosen2.fungsional"
    	])->first();
    	$dekan = User::with("jabatan")
    	->wherehas("jabatan", function (Builder $query){
    		$query->where("jabatan", "Dekan");
    	})->first();

    	// return view('akademik.sutgas_pembimbing.pdf', ['surat_tugas' => $surat_tugas, 'dekan' => $dekan]);

        $pdf = PDF::loadview('akademik.sutgas_pembimbing.pdf', ['surat_tugas' => $surat_tugas, 'dekan' => $dekan])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Sutgas_Pembimbing-" . $surat_tugas->no_surat . ".pdf");
    }

    //KTU
	public function ktu_index()
	{
		$surat_tugas = surat_tugas::with(['tipe_surat_tugas', 'status_surat_tugas', 'detail_skripsi', 'detail_skripsi.skripsi.mahasiswa'])
		    ->whereHas('tipe_surat_tugas',function(Builder $query){
		        $query->where('tipe_surat','Surat Tugas Pembimbing');
		    })
		    ->whereHas('status_surat_tugas', function (Builder $query){
		    	$query->whereIn('status', ['Dikirim', 'Disetujui KTU']);
		    })
            ->orderBy('verif_ktu')
		    ->orderBy('updated_at', 'desc')
            ->get();

		return view('ktu.sutgas_akademik.index', [
			'surat_tugas' => $surat_tugas,
			'tipe' => 'surat tugas pembimbing'
		]);
	}

	public function ktu_show($id)
	{
		$surat_tugas = surat_tugas::where('id', $id)
		->with([
			"detail_skripsi",
			"detail_skripsi.skripsi.mahasiswa",
			"detail_skripsi.keris",
			"dosen1:no_pegawai,nama,id_fungsional",
			"dosen1.fungsional",
			"dosen2:no_pegawai,nama,id_fungsional",
			"dosen2.fungsional"
		])->first();
		$dekan = User::with("jabatan")
		->wherehas("jabatan", function (Builder $query){
			$query->where("jabatan", "Dekan");
		})->first();
		// dd($surat_tugas);
      return view('ktu.sutgas_akademik.show_pembimbing', [
      	'surat_tugas' => $surat_tugas,
      	'dekan' => $dekan,
			'tipe' => 'surat tugas pembimbing'
      ]);
	}

	public function ktu_verif(Request $request, $id)
	{
		$surat_tugas = surat_tugas::find($id);
        $surat_tugas->verif_ktu = $request->verif_ktu;
        // isi attribut verif_ktu di variabel surat tugas dengan attribut verif ktu di variable reqeuest
		if($request->verif_ktu == 2){
			$request->validate([
				'pesan_revisi' => 'required|string'
			]);
            $surat_tugas = $this->verif($surat_tugas, 1, $request->pesan_revisi,null);
			$surat_tugas->save();
			return redirect()->route('ktu.sutgas-pembimbing.index')->with("verif_ktu", 'Surat tugas berhasil ditarik, status kembali menjadi "Draft"');
		}
		else if ($request->verif_ktu == 1) {
            $surat_tugas = $this->verif($surat_tugas,3,null,2);
            $surat_tugas->save();
			return redirect()->route('ktu.sutgas-pembimbing.show', $id)->with('verif_ktu', 'verifikasi surat tugas berhasil, status surat tugas saat ini "Disetujui KTU"');
		}
    }
}

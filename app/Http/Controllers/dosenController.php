<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\surat_tugas;
use App\sk_honor;
use App\detail_skripsi;
use App\skripsi;
use App\keris;
use App\mahasiswa;
use Carbon\Carbon;


use Illuminate\Http\Request;

class dosenController extends Controller
{
	public function __construct()
   {
      $this->middleware('auth');
   }

   public function dashboard()
   {
   	$user = Auth::user();
   	$sutgas_pembimbing_1 = surat_tugas::where('id_dosen1', $user->no_pegawai)
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Pembimbing');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->take(3)->get();

   	$sutgas_pembimbing_2 = surat_tugas::where('id_dosen2', $user->no_pegawai)
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Pembimbing');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->take(3)->get();

   	$sutgas_pembahas_1 = surat_tugas::where('id_dosen1', $user->no_pegawai)
   	->whereDate('tanggal', '>=', Carbon::now()->toDateTimeString())
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Pembahas');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->take(3)->get();

   	$sutgas_pembahas_2 = surat_tugas::where('id_dosen2', $user->no_pegawai)
   	->whereDate('tanggal', '>=', Carbon::now()->toDateTimeString())
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Pembahas');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->take(3)->get();

   	$sutgas_penguji_1 = surat_tugas::where('id_dosen1', $user->no_pegawai)
   	->whereDate('tanggal', '>=', Carbon::now()->toDateTimeString())
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Penguji');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->take(3)->get();

   	$sutgas_penguji_2 = surat_tugas::where('id_dosen2', $user->no_pegawai)
   	->whereDate('tanggal', '>=', Carbon::now()->toDateTimeString())
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Penguji');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->take(3)->get();

   	// dd($sutgas_pembimbing_1);
   	return view('dosen.dashboard', [
   		'sutgas_pembimbing_1' => $sutgas_pembimbing_1,
   		'sutgas_pembimbing_2' => $sutgas_pembimbing_2,
   		'sutgas_pembahas_1' => $sutgas_pembahas_1,
   		'sutgas_pembahas_2' => $sutgas_pembahas_2,
   		'sutgas_penguji_1' => $sutgas_penguji_1,
   		'sutgas_penguji_2' => $sutgas_penguji_2,
   	]);
   }


   public function index_pembimbing()
   {
   	$sutgas_pembimbing_1 = surat_tugas::where('id_dosen1', Auth::user()->no_pegawai)
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.status_skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi',
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Pembimbing');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->get();

      //cek apakah ada detail skripsi lain dg id_skripsi yg sama dan lebih baru. Jika ya, hilangkan dr collection ini karena mhs itu sudah ganti judul n pembimbing (meski ada kemungkinan pembimbingnya tetap)
      foreach ($sutgas_pembimbing_1 as $key => $value) {
         $id_skripsi = $value->detail_skripsi->id_skripsi;
         $detail_skripsi_lain = detail_skripsi::where([
            ['id_skripsi', $id_skripsi],
            ['created_at', '>', $value->detail_skripsi->created_at]
         ])->first();

         if (!is_null($detail_skripsi_lain)) {
            $sutgas_pembimbing_1->forget($key); //remove current element from collection
         }
      }

   	$sutgas_pembimbing_2 = surat_tugas::where('id_dosen2', Auth::user()->no_pegawai)
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.status_skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Pembimbing');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->get();

      foreach ($sutgas_pembimbing_2 as $key => $value) {
         $id_skripsi = $value->detail_skripsi->id_skripsi;
         $detail_skripsi_lain = detail_skripsi::where([
            ['id_skripsi', $id_skripsi],
            ['created_at', '>', $value->detail_skripsi->created_at]
         ])->first();

         if (!is_null($detail_skripsi_lain)) {
            $sutgas_pembimbing_2->forget($key); //remove current element from collection
         }
      }

   	return view('dosen.skripsi_mahasiswa.pembimbing_index', [
   		'sutgas_pembimbing_1' => $sutgas_pembimbing_1,
   		'sutgas_pembimbing_2' => $sutgas_pembimbing_2
   	]);
   }

   public function show_pembimbing($nim)
   {
   	$mahasiswa = mahasiswa::where('nim', $nim)
   	->with([
   		'prodi',
   		'skripsi',
   		'skripsi.status_skripsi',
   		'skripsi.detail_skripsi' => function($query)
   		{
   			$query->orderBy('created_at', 'desc');
   		},
   		'skripsi.detail_skripsi.surat_tugas' => function($query)
   		{
   			$query->where('id_status_surat_tugas', 3)
	   		->orderBy('created_at', 'desc');
   		},
   		'skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas',
   		'skripsi.detail_skripsi.surat_tugas.status_surat_tugas',
   		'skripsi.detail_skripsi.sk_skripsi',
   		'skripsi.detail_skripsi.sk_skripsi.sk_honor',
   		'skripsi.detail_skripsi.sk_skripsi.sk_honor.status_sk_honor'
   	])
   	->first();
   	$no_pembimbing = array('utama' => 0, 'pendamping' => 0);
   	$tgl_pembimbing = "";
   	$tgl_sempro = "";
   	$tgl_sidang = "";
   	foreach ($mahasiswa->skripsi->detail_skripsi[0]->surat_tugas as $item) {
   		if ($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing") {
   			$tgl_pembimbing = Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y');
   			$no_pembimbing['utama'] = $item->id_dosen1;
   			$no_pembimbing['pendamping'] = $item->id_dosen2;
   		} 
   		else if($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembahas") {
   			$tgl_sempro = Carbon::parse($item->tanggal)->locale('id_ID')->isoFormat('D MMMM Y');
   		}
   		else if($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Penguji") {
   			$tgl_sidang = Carbon::parse($item->tanggal)->locale('id_ID')->isoFormat('D MMMM Y');
   		}
   	}

   	// dd($mahasiswa);
   	return view('dosen.skripsi_mahasiswa.pembimbing_show', [
   		'mahasiswa' => $mahasiswa,
   		'tgl_pembimbing' => $tgl_pembimbing,
   		'tgl_sempro' => $tgl_sempro,
   		'tgl_sidang' => $tgl_sidang,
   		'no_pembimbing' => $no_pembimbing
   	]);
   }

   public function index_pembahas()
   {
   	$sutgas_pembahas_1 = surat_tugas::where('id_dosen1', Auth::user()->no_pegawai)
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.status_skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi',
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Pembahas');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->get();

   	$sutgas_pembahas_2 = surat_tugas::where('id_dosen2', Auth::user()->no_pegawai)
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.status_skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Pembahas');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->get();

   	return view('dosen.skripsi_mahasiswa.pembahas_index', [
   		'sutgas_pembahas_1' => $sutgas_pembahas_1,
   		'sutgas_pembahas_2' => $sutgas_pembahas_2
   	]);
   }

   public function show_pembahas($nim)
   {
   	$mahasiswa = mahasiswa::where('nim', $nim)
   	->with([
   		'prodi',
   		'skripsi',
   		'skripsi.status_skripsi',
   		'skripsi.detail_skripsi' => function($query)
   		{
   			$query->orderBy('created_at', 'desc');
   		},
   		'skripsi.detail_skripsi.surat_tugas' => function($query)
   		{
   			$query->where([
   				['id_tipe_surat_tugas', 2],
   				['id_status_surat_tugas', 3]
   			])
   			->where('id_dosen1', Auth::user()->no_pegawai)
   			->orWhere('id_dosen2', Auth::user()->no_pegawai)
	   		->orderBy('created_at', 'desc');
   		},
   		'skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas',
   		'skripsi.detail_skripsi.surat_tugas.status_surat_tugas',
   		'skripsi.detail_skripsi.sk_sempro',
   		'skripsi.detail_skripsi.sk_sempro.sk_honor',
   		'skripsi.detail_skripsi.sk_sempro.sk_honor.status_sk_honor'
   	])
   	->first();

   	// dd($mahasiswa);
   	return view('dosen.skripsi_mahasiswa.pembahas_show', [
   		'mahasiswa' => $mahasiswa
   	]);
   }

   public function index_penguji()
   {
   	$sutgas_penguji_1 = surat_tugas::where('id_dosen1', Auth::user()->no_pegawai)
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.status_skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi',
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Penguji');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->get();

   	$sutgas_penguji_2 = surat_tugas::where('id_dosen2', Auth::user()->no_pegawai)
   	->with([
   		'status_surat_tugas',
   		'detail_skripsi',
   		'detail_skripsi.skripsi',
   		'detail_skripsi.skripsi.status_skripsi',
   		'detail_skripsi.skripsi.mahasiswa',
   		'detail_skripsi.skripsi.mahasiswa.prodi'
   	])
   	->whereHas('tipe_surat_tugas', function (Builder $query)
   	{
   		$query->where('tipe_surat', 'Surat Tugas Penguji');
   	})
   	->whereHas('status_surat_tugas', function (Builder $query)
   	{
   		$query->where('status', 'Disetujui KTU');
   	})
   	->orderBy('created_at', 'desc')->get();

   	return view('dosen.skripsi_mahasiswa.penguji_index', [
   		'sutgas_penguji_1' => $sutgas_penguji_1,
   		'sutgas_penguji_2' => $sutgas_penguji_2
   	]);
   }

   public function show_penguji($nim)
   {
   	$mahasiswa = mahasiswa::where('nim', $nim)
   	->with([
   		'prodi',
   		'skripsi',
   		'skripsi.status_skripsi',
   		'skripsi.detail_skripsi' => function($query)
   		{
   			$query->orderBy('created_at', 'desc');
   		},
   		'skripsi.detail_skripsi.surat_tugas' => function($query)
   		{
   			$query->where([
   				['id_tipe_surat_tugas', 3],
   				['id_status_surat_tugas', 3]
   			])
   			->where('id_dosen1', Auth::user()->no_pegawai)
   			->orWhere('id_dosen2', Auth::user()->no_pegawai)
	   		->orderBy('created_at', 'desc');
   		},
   		'skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas',
   		'skripsi.detail_skripsi.surat_tugas.status_surat_tugas',
   		'skripsi.detail_skripsi.sk_skripsi',
   		'skripsi.detail_skripsi.sk_skripsi.sk_honor',
   		'skripsi.detail_skripsi.sk_skripsi.sk_honor.status_sk_honor'
   	])
   	->first();

   	// dd($mahasiswa);
   	return view('dosen.skripsi_mahasiswa.penguji_show', [
   		'mahasiswa' => $mahasiswa
   	]);
   }
}

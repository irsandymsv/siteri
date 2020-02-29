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

class wadek1Controller extends Controller
{
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

      //cek apakah ada detail skripsi lain dg id_skripsi yg sama dan lebih baru. Jika ya, hilangkan current element dr collection ini karena mhs tsb sudah ganti judul n pembimbing (meski ada kemungkinan pembimbingnya tetap)
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

        //cek apakah ada sutgas lain dg id_tipe dan id_detail_skripsi yg sama dan lebih baru. Jika ya, hilangkan current elemnt dr collection ini karena ada sutgas yg lebih baru. Agar tidak ada nama mhs yg muncul 2x 
      foreach ($sutgas_penguji_1 as $key => $value) {
         // $id_skripsi = $value->detail_skripsi->id_skripsi;
         $sutgas_penguji1_lain = surat_tugas::where([
            ['id_tipe_surat_tugas', $value->id_tipe_surat_tugas],
            ['id_detail_skripsi', $value->id_detail_skripsi],
            ['created_at', '>', $value->created_at]
         ])->first();

         if (!is_null($sutgas_penguji1_lain)) {
            $sutgas_penguji_1->forget($key); //remove current element from collection
         }
      }

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

      foreach ($sutgas_penguji_2 as $key => $value) {
         // $id_skripsi = $value->detail_skripsi->id_skripsi;
         $sutgas_penguji2_lain = surat_tugas::where([
            ['id_tipe_surat_tugas', $value->id_tipe_surat_tugas],
            ['id_detail_skripsi', $value->id_detail_skripsi],
            ['created_at', '>', $value->created_at]
         ])->first();

         if (!is_null($sutgas_penguji2_lain)) {
            $sutgas_penguji_2->forget($key); //remove current element from collection
         }
      }

    	// dd($sutgas_pembimbing_1);
    	return view('wadek1.dashboard', [
    		'sutgas_pembimbing_1' => $sutgas_pembimbing_1,
    		'sutgas_pembimbing_2' => $sutgas_pembimbing_2,
    		'sutgas_pembahas_1' => $sutgas_pembahas_1,
    		'sutgas_pembahas_2' => $sutgas_pembahas_2,
    		'sutgas_penguji_1' => $sutgas_penguji_1,
    		'sutgas_penguji_2' => $sutgas_penguji_2,
    	]);
    }
}

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
    		'detail_skripsi.skripsi.mahasiswa.bagian'
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
    		'detail_skripsi.skripsi.mahasiswa.bagian'
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
    		'detail_skripsi.skripsi.mahasiswa.bagian'
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
    		'detail_skripsi.skripsi.mahasiswa.bagian'
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
    		'detail_skripsi.skripsi.mahasiswa.bagian'
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
    		'detail_skripsi.skripsi.mahasiswa.bagian'
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

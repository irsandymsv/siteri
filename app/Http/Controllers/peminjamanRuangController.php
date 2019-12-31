<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\Http\Controllers\Controller;
use App\detail_pinjam_ruang;
use App\peminjaman_ruang;
use App\data_ruang;

class peminjamanRuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $laporan = peminjaman_ruang::all();

            return view('perlengkapan.peminjaman_ruang.index', [
                'laporan' => $laporan
            ]);
        } catch (Exception $e) {
            return view('perlengkapan.peminjaman_ruang.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $laporan)
    {
        $nama_ruang = data_ruang::all()->pluck('nama_ruang');
        // $ruang = data_ruang::all();
        // $ruang = data_ruang::with('detail_data_ruang')
        //     ->where('id', $id)->get();

        return view('perlengkapan.peminjaman_ruang.create', [
            'nama_ruang' => $nama_ruang,
        ]);
    }

    public function ruangAjax($id)
    {
        // $ruang = detail_ruang::where('id_kategori', $id)->get();
        // return json_encode($ruang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $this->validate($request, [
            "kode_ruang"   => "required|integer",
            "nama_ruang"   => "required|string|max:50",
            "tanggal"       => "required|array",
            "tanggal.*"     => "required",
            "merk_ruang"   => "required|array",
            "merk_ruang.*" => "required|string|max:50",
            "nama_ruang"    => "required|array",
            "nama_ruang.*"  => "required|integer",
            "status"        => "required|array",
            "status.*"      => "required|integer",
        ]);

        data_ruang::create([
            'kode_ruang' => $request->kode_ruang,
            'nama_ruang' => $request->nama_ruang
        ]);

        $idruang = data_ruang::all()->pluck('id')->last();
        $nup = detail_data_ruang::where('idruang_fk', $idruang)->pluck('nup')->last();
        $nup -= 0;
        for ($i = 0; $i < count($request->merk_ruang); $i++) {
            $nup++;
            detail_data_ruang::create([
                'tanggal'       => $request->tanggal[$i],
                'idruang_fk'   => $idruang,
                'merk_ruang'   => $request->merk_ruang[$i],
                'nup'           => $nup,
                'idruang_fk'    => ($request->nama_ruang[$i] + 1),
                'idstatus_fk'   => ($request->status[$i] + 1)
            ]);
        }
        return redirect()->route('perlengkapan.inventaris.show', $idruang);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan = peminjaman_ruang::findOrfail($id);
        $detail_laporan = detail_pinjam_ruang::where('idpinjam_ruang_fk', $id)
            ->with(['peminjaman_ruang', 'data_ruang'])
            ->get();

        return view('perlengkapan.peminjaman_ruang.show', [
            'laporan' => $laporan,
            'detail_laporan' => $detail_laporan
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $laporan)
    {
        // if ($laporan->laporan) {
        //     $status = status_ruang_ruang::all()->pluck('status');
        //     $nama_ruang = data_ruang::all()->pluck('nama_ruang');
        // } else {
        //     $status = status_ruang_ruang::all()->pluck('status');
        //     $nama_ruang = data_ruang::all()->pluck('nama_ruang');
        //     $ruang = data_ruang::with('detail_data_ruang')
        //         ->where('id', $id)->get();
        // }
        // return view('perlengkapan.inventaris.create', [
        //     'status' => $status,
        //     'nama_ruang' => $nama_ruang,
        //     'ruang' => $ruang,
        //     'laporan'    => $laporan->laporan
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (!is_null($id)) {
        //     inventaris::findOrfail($id)->delete();
        // }
    }
}

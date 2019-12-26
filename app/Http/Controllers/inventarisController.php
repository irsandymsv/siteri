<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\detail_data_barang;
use App\data_barang;
use App\data_ruang;
use App\status_barang_ruang;

class inventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = data_barang::all();

        return view('perlengkapan.inventaris.index', [
            'barang'  => $barang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = status_barang_ruang::all()->pluck('status');
        $nama_ruang = data_ruang::all()->pluck('nama_ruang');

        return view('perlengkapan.inventaris.create_data_barang', [
            "status" => $status,
            "nama_ruang" => $nama_ruang
        ]);
    }

    public function barangAjax($id)
    {
        // $barang = detail_barang::where('id_kategori', $id)->get();
        // return json_encode($barang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "kode_barang"    => "required|integer|max:10",
            "nama_barang"    => "required|array",
            "nama_barang.*"  => "required|string|max:50",
            "merk_barang"    => "required|array",
            "merk_barang.*"  => "required|string|max:50",
            "nama_ruang"     => "required|array",
            "nama_ruang.*"   => "required|integer",
            "satuan"         => "required|array",
            "satuan.*"       => "required|integer|max:4",
        ]);
        dd($request);

        // try {

        data_barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang
        ]);

        $idbarang = data_barang::all()->pluck('id')->last();
        $nup = detail_data_barang::all()->orderBy('nup')->pluck('nup')->last();

        for ($i = 0; $i < count($request->nama_barang); $i++) {
            $nup++;
            detail_data_barang::create([
                'merk_barang' => $request->merk_barang[$i],
                'nup' => $nup,
                'idruang' => ($request->nama_ruang[$i] + 1),
                'idstatus' => ($request->status[$i] + 1)
            ]);
        }
        // dd($nup);

        // return view('perlengkapan.inventaris.index');
        // } catch (Exception $e) {
        return redirect()->route('perlengkapan.inventaris.index');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = data_barang::findOrfail($id);
        $detail_barang = detail_data_barang::where('idbarang_fk', $id)
            ->with(['data_barang', 'data_ruang', 'status_barang_ruang'])
            ->get();

        return view('perlengkapan.inventaris.show', [
            'barang' => $barang,
            'detail_barang' => $detail_barang
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

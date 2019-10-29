<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\detail_barang;
use App\kategori_barang;
use App\inventaris;
use Carbon\Carbon;
use KategoriBarang;

class inventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = DB::table('inventaris')
            ->join('detail_barang', 'inventaris.id_barang', '=', 'detail_barang.id')
            ->join('kategori_barang', 'detail_barang.id_kategori', '=', 'kategori_barang.id')
            ->select('inventaris.id', 'kategori_barang.kategori', 'detail_barang.spesifikasi_barang', 'detail_barang.harga_satuan', 'inventaris.jumlah', 'inventaris.verif_wadek2', 'inventaris.dibuat')
            ->get();
        return view('perlengkapan.inventaris.index', [
            'laporan'   =>  $laporan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori_barang::all();
        //dd($kategori);
        return view('perlengkapan.inventaris.create', [
            'kategori' => $kategori
        ]);
    }

    public function barangAjax($id)
    {
        $barang = detail_barang::where('id_kategori', $id)->get();
        return json_encode($barang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        if (!is_null($id)) {
            inventaris::findOrfail($id)->delete();
        }
    }
}

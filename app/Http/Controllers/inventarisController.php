<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\detail_data_barang;
use App\data_barang;
use App\data_ruang;
use App\status_barang;

class inventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = data_barang::with('status_barang')->get();
        // dd($barang);

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
        $status = status_barang::all()->pluck('status');
        $nama_ruang = data_ruang::all()->pluck('nama_ruang');

        return view('perlengkapan.inventaris.create', [
            'status'     => $status,
            'nama_ruang' => $nama_ruang
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
            "kode_barang"   => "required|integer",
            "nama_barang"   => "required|string|max:50",
            "status"        => "required|integer",
            "tanggal"       => "required|array",
            "tanggal.*"     => "required",
            "merk_barang"   => "required|array",
            "merk_barang.*" => "required|string|max:50",
            "nama_ruang"    => "required|array",
            "nama_ruang.*"  => "required|integer"
        ]);

        data_barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'idstatus_fk' => ($request->status + 1)
        ]);

        $idbarang = data_barang::all()->pluck('id')->last();
        $nup = detail_data_barang::where('idbarang_fk', $idbarang)->pluck('nup')->last();
        $nup -= 0;
        for ($i = 0; $i < count($request->nama_ruang); $i++) {
            $nup++;
            detail_data_barang::create([
                'tanggal'       => $request->tanggal[$i],
                'idbarang_fk'   => $idbarang,
                'merk_barang'   => $request->merk_barang[$i],
                'nup'           => $nup,
                'idruang_fk'    => ($request->nama_ruang[$i] + 1),
            ]);
        }
        return redirect()->route('perlengkapan.inventaris.show', $idbarang);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = data_barang::with('status_barang')->findOrfail($id);
        $detail_barang = detail_data_barang::where('idbarang_fk', $id)
            ->with(['data_barang', 'data_ruang'])
            ->get();
        // dd($barang);

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
    public function edit($id, Request $laporan)
    {
        if ($laporan->laporan) {
            // dd($laporan);
            $status = status_barang::all()->pluck('status');
            $nama_ruang = data_ruang::all()->pluck('nama_ruang');
            $barang = data_barang::with(['status_barang', 'detail_data_barang', 'detail_data_barang.data_ruang'])
                ->where('id', $id)
                ->first();
        } else {
            $status = status_barang::all()->pluck('status');
            $nama_ruang = data_ruang::all()->pluck('nama_ruang');
            $barang = detail_data_barang::with(['data_barang', 'data_barang.status_barang', 'data_ruang'])
                ->where('id', $id)
                ->first();
        }
        return view('perlengkapan.inventaris.edit', [
            'status'        => $status,
            'nama_ruang'    => $nama_ruang,
            'barang'        => $barang,
            'laporan'       => $laporan->laporan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $idbarang = data_barang::all()->pluck('id')->last();
        if ($request->barang) {
            $this->validate($request, [
                "kode_barang"   => "required|integer",
                "nama_barang"   => "required|string|max:50",
                "status"        => "required|integer",
                "tanggal"       => "required|array",
                "tanggal.*"     => "required",
                "merk_barang"   => "required|array",
                "merk_barang.*" => "required|string|max:50",
                "nama_ruang"    => "required|array",
                "nama_ruang.*"  => "required|integer",
            ]);

            data_barang::findOrfail($id)->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'idstatus_fk' => ($request->status + 1)
            ]);


            detail_data_barang::whereIn('idbarang_fk', [$id])->delete();
            // $idbarang = data_barang::all()->pluck('id')->last();
            $nup = detail_data_barang::where('idbarang_fk', $id)->pluck('nup')->last();
            $nup -= 0;

            for ($i = 0; $i < count($request->nama_ruang); $i++) {
                $nup++;
                detail_data_barang::create([
                    'tanggal'       => $request->tanggal[$i],
                    'idbarang_fk'   => $id,
                    'merk_barang'   => $request->merk_barang[$i],
                    'nup'           => $nup,
                    'idruang_fk'    => ($request->nama_ruang[$i] + 1)
                ]);
            }
        } else {

            $this->validate($request, [
                "tanggal"     => "required",
                "merk_barang" => "required|string|max:50",
                "nama_ruang"  => "required|integer"
            ]);
            // dd($request);
            detail_data_barang::findOrfail($id)->update([
                'tanggal'       => $request->tanggal,
                'merk_barang'   => $request->merk_barang,
                'idruang_fk'    => ($request->nama_ruang + 1)
            ]);
            // dd("gak error");
        }

        return redirect()->route('perlengkapan.inventaris.show', $idbarang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->barang) {
            data_barang::findOrfail($id)->delete();
            Log::alert('Berhasil Dihapus');
        } else {
            detail_data_barang::findOrfail($id)->delete();
            Log::alert('Berhasil Dihapus');
        }
    }
}

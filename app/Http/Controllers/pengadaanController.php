<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\laporan_pengadaan;
use App\pengadaan;
use App\satuan;

class pengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $db = laporan_pengadaan::with(['pengadaan', 'pengadaan.satuan'])
        //     ->get();
        $db = laporan_pengadaan::all();
        // dd($db);
        return view('perlengkapan.pengadaan.index', [
            'laporan'  => $db
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $satuan = satuan::all()->pluck('satuan');
        // dd($satuan);
        return view('perlengkapan.pengadaan.create', ["satuan" => $satuan]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $data = $request->data;
        // $data = explode(",", $data);
        // dump($request);
        // $data = array_chunk($data, $request->length);
        // dd($data);
        $this->validate($request, [
            "keterangan"    => "required|string|max:100",
            "nama_barang"   => "required|array",
            "nama_barang.*" => "required|string|max:50",
            "spesifikasi"   => "required|array",
            "spesifikasi.*" => "required|string|max:50",
            "jumlah"        => "required|array",
            "jumlah.*"      => "required|integer",
            "satuan"        => "required|array",
            "satuan.*"      => "required|integer|max:4",
            "harga"         => "required|array",
            "harga.*"       => "required|integer"
        ]);
        // dd($request);

        // try {
        laporan_pengadaan::create(['keterangan' => $request->keterangan]);
        $idLaporan = laporan_pengadaan::all()->pluck('id')->last();

        for ($i = 0; $i < count($request->nama_barang); $i++) {
            pengadaan::create([
                'nama_barang'   => $request->nama_barang[$i],
                'spesifikasi'   => $request->spesifikasi[$i],
                'jumlah'        => $request->jumlah[$i],
                'id_satuan'     => ($request->satuan[$i] + 1),
                'harga'         => $request->harga[$i],
                'id_laporan'    => $idLaporan
            ]);
        }

        // return view('perlengkapan.pengadaan.index');
        // } catch (Exception $e) {
        return redirect()->route('perlengkapan.pengadaan.index');
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
        $laporan = laporan_pengadaan::findOrfail($id);
        $pengadaan = pengadaan::where('id_laporan', $id)
            ->with(['laporan_pengadaan', 'satuan'])
            ->get();

        return view('perlengkapan.pengadaan.show', [
            'laporan' => $laporan,
            'pengadaan' => $pengadaan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $status)
    {
        // dump("EDIT ", $status);
        if ($status->laporan) {
            $satuan = satuan::all()->pluck('satuan');
            $laporan = laporan_pengadaan::with(['pengadaan', 'pengadaan.satuan'])
                ->where('id', $id)->get();
            // dd("GAAKKK COMPEKKKKK");
        } else {
            $satuan = satuan::all()->pluck('satuan');
            $laporan = pengadaan::with(['laporan_pengadaan', 'satuan'])
                ->where('id', $id)->get();
            // dd("COMPEKKKKK");
        }
        return view('perlengkapan.pengadaan.edit', [
            "laporan"   => $laporan,
            "satuan"    => $satuan,
            "status"    => $status->laporan
        ]);
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
        // dd($request);
        if ($request->laporan) {
            $this->validate($request, [
                "keterangan"    => "required|string|max:100",
                "nama_barang"   => "required|array",
                "nama_barang.*" => "required|string|max:50",
                "spesifikasi"   => "required|array",
                "spesifikasi.*" => "required|string|max:50",
                "jumlah"        => "required|array",
                "jumlah.*"      => "required|integer",
                "satuan"        => "required|array",
                "satuan.*"      => "required|integer|max:4",
                "harga"         => "required|array",
                "harga.*"       => "required|integer"
            ]);

            laporan_pengadaan::findOrfail($id)->update(["keterangan" => $request->keterangan]);
            pengadaan::whereIn('id_laporan', [$id])->delete();

            for ($i = 0; $i < count($request->nama_barang); $i++) {
                pengadaan::create([
                    'nama_barang'   => $request->nama_barang[$i],
                    'spesifikasi'   => $request->spesifikasi[$i],
                    'jumlah'        => $request->jumlah[$i],
                    'id_satuan'     => ($request->satuan[$i] + 1),
                    'harga'         => $request->harga[$i],
                    'id_laporan'    => $id
                ]);
            }
        } else {
            // dd($request);
            $this->validate($request, [
                "nama_barang" => "required|string|max:50",
                "spesifikasi" => "required|string|max:50",
                "jumlah"      => "required|integer",
                "satuan"      => "required|integer|max:4",
                "harga"       => "required|integer"
            ]);

            pengadaan::findOrfail($id)->update([
                "nama_barang" => $request->nama_barang,
                "spesifikasi" => $request->spesifikasi,
                "jumlah"      => $request->jumlah,
                "id_satuan"   => ($request->satuan + 1),
                "harga"       => $request->harga
            ]);
        }

        return redirect()->route('perlengkapan.pengadaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\laporan_pengadaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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
        $db = pengadaan::all();
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
        $data = $request->data;
        $data = explode(",", $data);
        // dd($request->length);
        $data = array_chunk($data, $request->length);
        // dd($data);

        $idLaporan = laporan_pengadaan::all()->pluck('id')->last() + 1;
        laporan_pengadaan::create();

        foreach ($data as $key => $value) {
            array_push($value, $idLaporan);
            pengadaan::create([
                'nama_barang'   => $value[0],
                'spesifikasi'   => $value[1],
                'jumlah'        => $value[2],
                'id_satuan'     => $value[3],
                'harga'         => $value[4],
                'id_laporan'    => $value[5]
            ]);
        }
        // dd($value);
        return redirect()->route('perlengkapan.pengadaan.index');
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
        //
    }

    public function validator($data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->validator($value);
            } else {
                //
            }
        }
    }
}

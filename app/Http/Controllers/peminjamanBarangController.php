<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\Http\Controllers\Controller;
use App\data_barang;
use App\detail_data_barang;
use App\detail_pinjam_barang;
use App\peminjaman_barang;
use App\satuan;

class peminjamanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = peminjaman_barang::all();

        return view('perlengkapan.peminjaman_barang.index', [
            'laporan' => $laporan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $barang = data_barang::all();
        // $nama_barang = data_barang::all()->pluck('nama_barang');
        // $merk_barang = detail_data_barang::all()->pluck('merk_barang');
        $satuan = satuan::all()->pluck('satuan');

        return view('perlengkapan.peminjaman_barang.create', [
            'barang' => $barang,
            // 'merk_barang' => $merk_barang,
            'satuan' => $satuan
        ]);
    }

    public function barangAjax($id)
    {
        $merk_barang = detail_data_barang::where('idbarang_fk', $id)
            ->get();

        return json_encode($merk_barang);
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
            "tanggal_mulai"     => "required",
            "tanggal_berakhir"  => "required",
            "jam_mulai"         => "required",
            "jam_berakhir"      => "required",
            "kegiatan"          => "required|string|max:100",
            "nama_barang"       => "required|array",
            "nama_barang.*"     => "required|integer",
            "merk_barang"       => "required|array",
            "merk_barang.*"     => "required|integer",
            "jumlah"            => "required|array",
            "jumlah.*"          => "required|integer",
            "satuan"            => "required|array",
            "satuan.*"          => "required|integer"
        ]);
        dd("gak error");
        peminjaman_barang::create([
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_berakhir'  => $request->tanggal_berakhir,
            'jam_mulai'         => $request->jam_mulai,
            'jam_berakhir'      => $request->jam_berakhir,
            'kegiatan'          => $request->kegiatan
        ]);

        $idlaporan = peminjaman_barang::all()->pluck('id')->last();
        for ($i = 0; $i < count($request->merk_barang); $i++) {
            dd($request);
            detail_pinjam_barang::create([
                'idpinjam_barang_fk'        => $idlaporan,
                'iddetail_data_barang_fk'   => ($request->merk_barang[$i] + 1),
                'jumlah'        => $request->jumlah[$i],
                'id_satuan'     => ($request->satuan[$i] + 1)
            ]);
        }
        return redirect()->route('perlengkapan.peminjaman_barang.show', $idlaporan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan = peminjaman_barang::findOrfail($id);
        $detail_laporan = detail_pinjam_barang::where('idpinjam_barang_fk', $id)
            ->with(['peminjaman_barang', 'detail_data_barang.data_barang', 'satuan'])
            ->get();

        return view('perlengkapan.peminjaman_barang.show', [
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
    public function edit($id, Request $status)
    {
        if ($status->status) {
            $barang = data_barang::all();
            $satuan = satuan::all()->pluck('satuan');
            $laporan = peminjaman_barang::with(['detail_pinjam_barang', 'detail_pinjam_barang.detail_data_barang', 'detail_pinjam_barang.satuan'])
                ->where('id', $id)
                ->first();
        } else {
            $barang = data_barang::all();
            $satuan = satuan::all()->pluck('satuan');
            $laporan = detail_pinjam_barang::with(['peminjaman_barang', 'satuan'])
                ->where('id', $id)
                ->first();
        }
        return view('perlengkapan.peminjaman_barang.edit', [
            'barang' => $barang,
            'satuan' => $satuan,
            'laporan' => $laporan,
            'status'    => $status->status
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
        $idlaporan = peminjaman_barang::all()->pluck('id')->last();
        if ($request->laporan) {

            $this->validate($request, [
                "tanggal_mulai"     => "required",
                "tanggal_berakhir"  => "required",
                "jam_mulai"         => "required",
                "jam_berakhir"      => "required",
                "kegiatan"          => "required|string|max:100",
                "nama_barang"       => "required|array",
                "nama_barang.*"     => "required|integer",
                "merk_barang"       => "required|array",
                "merk_barang.*"     => "required|integer",
                "jumlah"            => "required|array",
                "jumlah.*"          => "required|integer",
                "satuan"            => "required|array",
                "satuan.*"          => "required|integer"
            ]);

            peminjaman_barang::findOrfail($id)->update([
                'tanggal_mulai'     => $request->tanggal_mulai,
                'tanggal_berakhir'  => $request->tanggal_berakhir,
                'jam_mulai'         => $request->jam_mulai,
                'jam_berakhir'      => $request->jam_berakhir,
                'kegiatan'          => $request->kegiatan
            ]);

            detail_pinjam_barang::whereIn('idpinjam_barang_fk', [$id])->delete();

            for ($i = 0; $i < count($request->nama_barang); $i++) {
                // dd($request);
                detail_pinjam_barang::create([
                    'idpinjam_barang_fk'        => $id,
                    'iddetail_data_barang_fk'   => ($request->merk_barang[$i] + 1),
                    'jumlah'        => $request->jumlah[$i],
                    'id_satuan'     => ($request->satuan[$i] + 1)
                ]);
            }
        } else {
            // dd($request);
            $this->validate($request, [
                "nama_barang"   => "required|integer",
                "merk_barang"   => "required|integer",
                "jumlah"        => "required|integer",
                "satuan"        => "required|integer"
            ]);

            detail_pinjam_barang::findOrfail($id)->update([
                'iddetail_data_barang_fk'   => ($request->merk_barang + 1),
                'jumlah'        => $request->jumlah,
                'id_satuan'     => ($request->satuan + 1)
            ]);
            dd("gak error");
        }

        return redirect()->route('perlengkapan.peminjaman_barang.show', $idlaporan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->laporan) {
            peminjaman_barang::findOrfail($id)->delete();
            Log::alert('Berhasil Dihapus');
        } else {
            detail_pinjam_barang::findOrfail($id)->delete();
            Log::alert('Berhasil Dihapus');
        }
    }
}

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
use Sven\ArtisanView\Blocks\Push;

class peminjamanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::user()->id_jabatan == 'ormawa') {
        $laporan = peminjaman_barang::all();

        return view('ormawa.peminjaman_barang.index', [
            'laporan' => $laporan
        ]);
        // } else if (Auth::user()->id_jabatan == 'perlengkapan') {
        //     $laporan = peminjaman_barang::all();

        //     return view('perlengkapan.peminjaman_barang.index', [
        //         'laporan' => $laporan
        //     ]);
        // }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (Auth::user()->id_jabatan == 'ormawa') {
        $barang = data_barang::where('idstatus_fk', '2')->get();
        $satuan = satuan::all()->pluck('satuan');

        return view('ormawa.peminjaman_barang.create', [
            'barang' => $barang,
            'satuan' => $satuan
        ]);
        // } else if (Auth::user()->id_jabatan == 'perlengkapan') {
        //     $barang = data_barang::all();
        //     $satuan = satuan::all()->pluck('satuan');

        //     return view('perlengkapan.peminjaman_barang.create', [
        //         'barang' => $barang,
        //         'satuan' => $satuan
        //     ]);
        // }
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
        // dd($request);
        // if (Auth::user()->id_jabatan == 'ormawa') {
        $this->validate($request, [
            "tanggal_mulai"     => "required",
            "tanggal_berakhir"  => "required",
            "jam_mulai"         => "required",
            "jam_berakhir"      => "required",
            "kegiatan"          => "required|string|max:100",
            "barang"            => "required|array",
            "barang.*"          => "required|integer",
            "merk_barang"       => "required|array",
            "merk_barang.*"     => "required|integer",
            "jumlah"            => "required|array",
            "jumlah.*"          => "required|integer",
            "satuan"            => "required|array",
            "satuan.*"          => "required|integer"
        ]);

        // dd("gak error");
        peminjaman_barang::create([
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_berakhir'  => $request->tanggal_berakhir,
            'jam_mulai'         => $request->jam_mulai,
            'jam_berakhir'      => $request->jam_berakhir,
            'kegiatan'          => $request->kegiatan
        ]);
        // dd($request);

        $idlaporan = peminjaman_barang::all()->pluck('id')->last();

        for ($i = 0; $i < count($request->merk_barang); $i++) {
            detail_pinjam_barang::create([
                'idpinjam_barang_fk'        => $idlaporan,
                'iddetail_data_barang_fk'   => $request->merk_barang[$i],
                'jumlah'                    => $request->jumlah[$i],
                'idsatuan_fk'               => ($request->satuan[$i] + 1)
            ]);
            // dd($request);
        }
        return redirect()->route('ormawa.peminjaman_barang.show', $idlaporan);
        // } else if (Auth::user()->id_jabatan == 'perlengkapan') {
        //     $this->validate($request, [
        //         "tanggal_mulai"     => "required",
        //         "tanggal_berakhir"  => "required",
        //         "jam_mulai"         => "required",
        //         "jam_berakhir"      => "required",
        //         "kegiatan"          => "required|string|max:100",
        //         "barang"            => "required|array",
        //         "barang.*"          => "required|integer",
        //         "merk_barang"       => "required|array",
        //         "merk_barang.*"     => "required|integer",
        //         "jumlah"            => "required|array",
        //         "jumlah.*"          => "required|integer",
        //         "satuan"            => "required|array",
        //         "satuan.*"          => "required|integer"
        //     ]);

        //     peminjaman_barang::create([
        //         'tanggal_mulai'     => $request->tanggal_mulai,
        //         'tanggal_berakhir'  => $request->tanggal_berakhir,
        //         'jam_mulai'         => $request->jam_mulai,
        //         'jam_berakhir'      => $request->jam_berakhir,
        //         'kegiatan'          => $request->kegiatan,
        //         'verif_baper'       => '1',
        //         'verif_ktu'         => '1'
        //     ]);
        //     // dd("gak error");

        //     $idlaporan = peminjaman_barang::all()->pluck('id')->last();

        //     for ($i = 0; $i < count($request->merk_barang); $i++) {
        //         detail_pinjam_barang::create([
        //             'idpinjam_barang_fk'        => $idlaporan,
        //             'iddetail_data_barang_fk'   => ($request->merk_barang[$i] + 1),
        //             'jumlah'                    => $request->jumlah[$i],
        //             'idsatuan_fk'               => ($request->satuan[$i] + 1)
        //         ]);
        //         // dd($request);
        //     }
        //     return redirect()->route('perlengkapan.peminjaman_barang.show', $idlaporan);
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
        // if (Auth::user()->id_jabatan == 'ormawa') {
        $laporan = peminjaman_barang::findOrfail($id);
        $detail_laporan = detail_pinjam_barang::where('idpinjam_barang_fk', $id)
            ->with(['peminjaman_barang', 'detail_data_barang.data_barang', 'satuan'])
            ->get();

        return view('ormawa.peminjaman_barang.show', [
            'laporan' => $laporan,
            'detail_laporan' => $detail_laporan
        ]);
        // } else if (Auth::user()->id_jabatan == 'perlengkapan') {
        //     $laporan = peminjaman_barang::findOrfail($id);
        //     $detail_laporan = detail_pinjam_barang::where('idpinjam_barang_fk', $id)
        //         ->with(['peminjaman_barang', 'detail_data_barang.data_barang', 'satuan'])
        //         ->get();

        //     return view('perlengkapan.peminjaman_barang.show', [
        //         'laporan' => $laporan,
        //         'detail_laporan' => $detail_laporan
        //     ]);
        // }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // if (Auth::user()->id_jabatan == 'ormawa') {
        $barang = data_barang::where('idstatus_fk', '2')->get();
        $satuan = satuan::all()->pluck('satuan');
        $laporan = peminjaman_barang::with(['detail_pinjam_barang', 'detail_pinjam_barang.detail_data_barang', 'detail_pinjam_barang.detail_data_barang.data_barang', 'detail_pinjam_barang.satuan'])
            ->where('id', $id)
            ->first();
        $merk = [];
        foreach ($laporan->detail_pinjam_barang as $item) {
            $merk_barang = detail_data_barang::where('idbarang_fk', $item->detail_data_barang->idbarang_fk)->get();
            array_push($merk, $merk_barang);
        }
        // dd($merk);
        return view('ormawa.peminjaman_barang.edit', [
            'barang' => $barang,
            'satuan' => $satuan,
            'laporan' => $laporan,
            'merk' => $merk
        ]);
        // } else if (Auth::user()->id_jabatan == 'perlengkapan') {
        //     if ($status->status) {
        //         $barang = data_barang::all();
        //         $satuan = satuan::all()->pluck('satuan');
        //         $laporan = peminjaman_barang::with(['detail_pinjam_barang', 'detail_pinjam_barang.detail_data_barang', 'detail_pinjam_barang.satuan'])
        //             ->where('id', $id)
        //             ->first();
        //     } else {
        //         $barang = data_barang::all();
        //         $satuan = satuan::all()->pluck('satuan');
        //         $laporan = detail_pinjam_barang::with(['peminjaman_barang', 'satuan'])
        //             ->where('id', $id)
        //             ->first();
        //     }
        //     return view('perlengkapan.peminjaman_barang.edit', [
        //         'barang' => $barang,
        //         'satuan' => $satuan,
        //         'laporan' => $laporan,
        //         'status'    => $status->status
        //     ]);
        // }
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
        // if (Auth::user()->id_jabatan == 'ormawa') {
        $idlaporan = peminjaman_barang::all()->pluck('id')->last();
        // dd($request);
        if ($request->laporan) {

            $this->validate($request, [
                "tanggal_mulai"     => "required",
                "tanggal_berakhir"  => "required",
                "jam_mulai"         => "required",
                "jam_berakhir"      => "required",
                "kegiatan"          => "required|string|max:100",
                "barang"            => "required|array",
                "barang.*"          => "required|integer",
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

            for ($i = 0; $i < count($request->merk_barang); $i++) {
                // dd($request);
                detail_pinjam_barang::create([
                    'idpinjam_barang_fk'        => $id,
                    'iddetail_data_barang_fk'   => $request->merk_barang[$i],
                    'jumlah'        => $request->jumlah[$i],
                    'idsatuan_fk'   => ($request->satuan[$i] + 1)
                ]);
            }
            // dd("gak error");
        } else {
            // dd($request);
            $this->validate($request, [
                "barang"        => "required|integer",
                "merk_barang"   => "required|integer",
                "jumlah"        => "required|integer",
                "satuan"        => "required|integer"
            ]);

            detail_pinjam_barang::findOrfail($id)->update([
                'idpinjam_barang_fk'        => $idlaporan,
                'iddetail_data_barang_fk'   => $request->merk_barang,
                'jumlah'                    => $request->jumlah,
                'idsatuan_fk'               => ($request->satuan + 1)
            ]);
        }
        return redirect()->route('ormawa.peminjaman_barang.show', $idlaporan);
        // } else if (Auth::user()->id_jabatan == 'perlengkapan') {
        //     $idlaporan = peminjaman_barang::all()->pluck('id')->last();
        //     if ($request->laporan) {

        //         $this->validate($request, [
        //             "tanggal_mulai"     => "required",
        //             "tanggal_berakhir"  => "required",
        //             "jam_mulai"         => "required",
        //             "jam_berakhir"      => "required",
        //             "kegiatan"          => "required|string|max:100",
        //             "nama_barang"       => "required|array",
        //             "nama_barang.*"     => "required|integer",
        //             "merk_barang"       => "required|array",
        //             "merk_barang.*"     => "required|integer",
        //             "jumlah"            => "required|array",
        //             "jumlah.*"          => "required|integer",
        //             "satuan"            => "required|array",
        //             "satuan.*"          => "required|integer"
        //         ]);

        //         peminjaman_barang::findOrfail($id)->update([
        //             'tanggal_mulai'     => $request->tanggal_mulai,
        //             'tanggal_berakhir'  => $request->tanggal_berakhir,
        //             'jam_mulai'         => $request->jam_mulai,
        //             'jam_berakhir'      => $request->jam_berakhir,
        //             'kegiatan'          => $request->kegiatan
        //         ]);

        //         detail_pinjam_barang::whereIn('idpinjam_barang_fk', [$id])->delete();

        //         for ($i = 0; $i < count($request->nama_barang); $i++) {
        //             // dd($request);
        //             detail_pinjam_barang::create([
        //                 'idpinjam_barang_fk'        => $id,
        //                 'iddetail_data_barang_fk'   => ($request->merk_barang[$i] + 1),
        //                 'jumlah'        => $request->jumlah[$i],
        //                 'id_satuan'     => ($request->satuan[$i] + 1)
        //             ]);
        //         }
        //     } else {
        //         // dd($request);
        //         $this->validate($request, [
        //             "nama_barang"   => "required|integer",
        //             "merk_barang"   => "required|integer",
        //             "jumlah"        => "required|integer",
        //             "satuan"        => "required|integer"
        //         ]);

        //         detail_pinjam_barang::findOrfail($id)->update([
        //             'iddetail_data_barang_fk'   => ($request->merk_barang + 1),
        //             'jumlah'        => $request->jumlah,
        //             'id_satuan'     => ($request->satuan + 1)
        //         ]);
        //         dd("gak error");
        //     }
        // $this->validate($request, [
        //     "verif_baper"  => "required|integer"
        // ]);

        // detail_pinjam_ruang::findOrfail($id)->update([
        //     'verif_baper'    => $request->verif_baper
        // ]);
        //     return redirect()->route('perlengkapan.peminjaman_barang.show', $idlaporan);
        // }
    }

    public function verif(Request $request, $id)
    {
        $this->validate($request, [
            "verif_baper"  => "required|integer"
        ]);

        detail_pinjam_barang::findOrfail($id)->update([
            'verif_baper'    => $request->verif_baper
        ]);
        return redirect()->route('perlengkapan.peminjaman_barang.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        // if (Auth::user()->id_jabatan == 'perlengkapan') {
        if ($request->laporan) {
            dd($request);
            peminjaman_barang::findOrfail($id)->delete();
            Log::alert('Berhasil Dihapus');
        } else {
            detail_pinjam_barang::findOrfail($id)->delete();
            Log::alert('Berhasil Dihapus');
        }
        // } else if (Auth::user()->id_jabatan == 'perlengkapan') {
        //     if ($request->laporan) {
        //         peminjaman_barang::findOrfail($id)->delete();
        //         Log::alert('Berhasil Dihapus');
        //     } else {
        //         detail_pinjam_barang::findOrfail($id)->delete();
        //         Log::alert('Berhasil Dihapus');
        //     }
        // }
    }
}

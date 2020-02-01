<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            $laporan = peminjaman_barang::all();

            return view('ormawa.peminjaman_barang.index', [
                'laporan' => $laporan
            ]);
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $laporan = peminjaman_barang::all();

            return view('perlengkapan.peminjaman_barang.index', [
                'laporan' => $laporan
            ]);
        } else if (Auth::user()->jabatan->jabatan == 'KTU') {
            $laporan = peminjaman_barang::where('verif_baper', '1')->get();

            return view('ktu.peminjaman_barang.index', [
                'laporan' => $laporan
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            $barang = data_barang::where('idstatus_fk', '2')->get();
            $satuan = satuan::all()->pluck('satuan');

            return view('ormawa.peminjaman_barang.create', [
                'barang' => $barang,
                'satuan' => $satuan
            ]);
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $barang = data_barang::where('idstatus_fk', '2')->get();
            $satuan = satuan::all()->pluck('satuan');

            return view('perlengkapan.peminjaman_barang.create', [
                'barang' => $barang,
                'satuan' => $satuan
            ]);
        }
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            $this->validate($request, [
                "tanggal"           => "required",
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

            $tanggal = explode(" - ", $request->tanggal);
            $jam_mulai = explode(' ', $tanggal[0]);
            $tanggal_mulai = $jam_mulai[0];
            $jam_mulai = $jam_mulai[1];
            $jam_berakhir = explode(' ', $tanggal[1]);
            $tanggal_berakhir = $jam_berakhir[0];
            $jam_berakhir = $jam_berakhir[1];

            peminjaman_barang::create([
                'tanggal_mulai'     => $tanggal_mulai,
                'tanggal_berakhir'  => $tanggal_berakhir,
                'jam_mulai'         => $jam_mulai,
                'jam_berakhir'      => $jam_berakhir,
                'kegiatan'          => $request->kegiatan
            ]);

            $idlaporan = peminjaman_barang::all()->pluck('id')->last();

            for ($i = 0; $i < count($request->merk_barang); $i++) {
                detail_pinjam_barang::create([
                    'idpinjam_barang_fk'        => $idlaporan,
                    'iddetail_data_barang_fk'   => $request->merk_barang[$i],
                    'jumlah'                    => $request->jumlah[$i],
                    'idsatuan_fk'               => ($request->satuan[$i] + 1)
                ]);
            }
            return redirect()->route('ormawa.peminjaman_barang.show', $idlaporan);
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $this->validate($request, [
                "tanggal"           => "required",
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

            $tanggal = explode(" - ", $request->tanggal);
            $jam_mulai = explode(' ', $tanggal[0]);
            $tanggal_mulai = $jam_mulai[0];
            $jam_mulai = $jam_mulai[1];
            $jam_berakhir = explode(' ', $tanggal[1]);
            $tanggal_berakhir = $jam_berakhir[0];
            $jam_berakhir = $jam_berakhir[1];

            peminjaman_barang::create([
                'tanggal_mulai'     => $tanggal_mulai,
                'tanggal_berakhir'  => $tanggal_berakhir,
                'jam_mulai'         => $jam_mulai,
                'jam_berakhir'      => $jam_berakhir,
                'kegiatan'          => $request->kegiatan,
                'verif_baper'       => '1',
                'verif_ktu'         => '1'
            ]);

            $idlaporan = peminjaman_barang::all()->pluck('id')->last();

            for ($i = 0; $i < count($request->merk_barang); $i++) {
                detail_pinjam_barang::create([
                    'idpinjam_barang_fk'        => $idlaporan,
                    'iddetail_data_barang_fk'   => $request->merk_barang[$i],
                    'jumlah'                    => $request->jumlah[$i],
                    'idsatuan_fk'               => ($request->satuan[$i] + 1)
                ]);
            }
            return redirect()->route('perlengkapan.peminjaman_barang.show', $idlaporan);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            $laporan = peminjaman_barang::findOrfail($id);
            $detail_laporan = detail_pinjam_barang::where('idpinjam_barang_fk', $id)
                ->with(['peminjaman_barang', 'detail_data_barang.data_barang', 'satuan'])
                ->get();

            return view('ormawa.peminjaman_barang.show', [
                'laporan' => $laporan,
                'detail_laporan' => $detail_laporan
            ]);
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $laporan = peminjaman_barang::findOrfail($id);
            $detail_laporan = detail_pinjam_barang::where('idpinjam_barang_fk', $id)
                ->with(['peminjaman_barang', 'detail_data_barang.data_barang', 'satuan'])
                ->get();

            return view('perlengkapan.peminjaman_barang.show', [
                'laporan' => $laporan,
                'detail_laporan' => $detail_laporan
            ]);
        } else if (Auth::user()->jabatan->jabatan == 'KTU') {
            $laporan = peminjaman_barang::findOrfail($id);
            $detail_laporan = detail_pinjam_barang::where('idpinjam_barang_fk', $id)
                ->with(['peminjaman_barang', 'detail_data_barang.data_barang', 'satuan'])
                ->get();

            return view('ktu.peminjaman_barang.show', [
                'laporan' => $laporan,
                'detail_laporan' => $detail_laporan
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $status)
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            // dd($id);
            // if ($status->status) {
            // dd($status);
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

            $tanggal1 = implode(" ", [$laporan->tanggal_mulai, $laporan->jam_mulai]);
            $tanggal2 = implode(" ", [$laporan->tanggal_berakhir, $laporan->jam_berakhir]);
            $tanggal = implode(" - ", [$tanggal1, $tanggal2]);
            // } else {
            //     $barang = data_barang::where('idstatus_fk', '2')->get();
            //     $satuan = satuan::all()->pluck('satuan');
            //     $laporan = detail_pinjam_barang::with(['peminjaman_barang', 'detail_data_barang', 'detail_data_barang.data_barang', 'satuan'])
            //         ->where('idpinjam_barang_fk', $id)
            //         ->where('iddetail_data_barang_fk', $request->idmerk)
            //         ->first();
            //     $merk = [];
            //     foreach ($laporan as $item) {
            //         $merk_barang = detail_data_barang::where('idbarang_fk', $item->idbarang_fk)->get();
            //         array_push($merk, $merk_barang);
            //     }
            // }

            return view('ormawa.peminjaman_barang.edit', [
                'barang'    => $barang,
                'satuan'    => $satuan,
                'laporan'   => $laporan,
                'merk'      => $merk,
                'tanggal'   => $tanggal,
                // 'status'    => $status->status,
            ]);
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            // if ($status->status) {
            // dd($status);
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

            $tanggal1 = implode(" ", [$laporan->tanggal_mulai, $laporan->jam_mulai]);
            $tanggal2 = implode(" ", [$laporan->tanggal_berakhir, $laporan->jam_berakhir]);
            $tanggal = implode(" - ", [$tanggal1, $tanggal2]);
            // } else {
            //     $barang = data_barang::where('idstatus_fk', '2')->get();
            //     $satuan = satuan::all()->pluck('satuan');
            //     $laporan = detail_pinjam_barang::with(['peminjaman_barang', 'detail_data_barang', 'detail_data_barang.data_barang', 'satuan'])
            //         ->where('idpinjam_barang_fk', $id)
            //         ->where('iddetail_data_barang_fk', $request->idmerk)
            //         ->first();
            //     $merk = [];
            //     foreach ($laporan as $item) {
            //         $merk_barang = detail_data_barang::where('idbarang_fk', $item->idbarang_fk)->get();
            //         array_push($merk, $merk_barang);
            //     }
            // }

            return view('perlengkapan.peminjaman_barang.edit', [
                'barang'    => $barang,
                'satuan'    => $satuan,
                'laporan'   => $laporan,
                'merk'      => $merk,
                'tanggal'   => $tanggal,
                // 'status'    => $status->status,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            $idlaporan = peminjaman_barang::all()->pluck('id')->last();
            if ($request->laporan) {
                $this->validate($request, [
                    "tanggal"           => "required",
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

                $tanggal = explode(" - ", $request->tanggal);
                $jam_mulai = explode(' ', $tanggal[0]);
                $tanggal_mulai = $jam_mulai[0];
                $jam_mulai = $jam_mulai[1];
                $jam_berakhir = explode(' ', $tanggal[1]);
                $tanggal_berakhir = $jam_berakhir[0];
                $jam_berakhir = $jam_berakhir[1];

                peminjaman_barang::findOrfail($id)->update([
                    'tanggal_mulai'     => $tanggal_mulai,
                    'tanggal_berakhir'  => $tanggal_berakhir,
                    'jam_mulai'         => $jam_mulai,
                    'jam_berakhir'      => $jam_berakhir,
                    'kegiatan'          => $request->kegiatan
                ]);

                detail_pinjam_barang::whereIn('idpinjam_barang_fk', [$id])->delete();

                for ($i = 0; $i < count($request->merk_barang); $i++) {
                    detail_pinjam_barang::create([
                        'idpinjam_barang_fk'        => $id,
                        'iddetail_data_barang_fk'   => $request->merk_barang[$i],
                        'jumlah'        => $request->jumlah[$i],
                        'idsatuan_fk'   => ($request->satuan[$i] + 1)
                    ]);
                }
            } else {
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
                $id = $request->id;
            }
            return redirect()->route('ormawa.peminjaman_barang.show', $id);
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            if ($request->laporan) {
                $this->validate($request, [
                    "tanggal"           => "required",
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

                $tanggal = explode(" - ", $request->tanggal);
                $jam_mulai = explode(' ', $tanggal[0]);
                $tanggal_mulai = $jam_mulai[0];
                $jam_mulai = $jam_mulai[1];
                $jam_berakhir = explode(' ', $tanggal[1]);
                $tanggal_berakhir = $jam_berakhir[0];
                $jam_berakhir = $jam_berakhir[1];

                peminjaman_barang::findOrfail($id)->update([
                    'tanggal_mulai'     => $tanggal_mulai,
                    'tanggal_berakhir'  => $tanggal_berakhir,
                    'jam_mulai'         => $jam_mulai,
                    'jam_berakhir'      => $jam_berakhir,
                    'kegiatan'          => $request->kegiatan
                ]);

                detail_pinjam_barang::whereIn('idpinjam_barang_fk', [$id])->delete();

                for ($i = 0; $i < count($request->merk_barang); $i++) {
                    detail_pinjam_barang::create([
                        'idpinjam_barang_fk'        => $id,
                        'iddetail_data_barang_fk'   => $request->merk_barang[$i],
                        'jumlah'        => $request->jumlah[$i],
                        'idsatuan_fk'   => ($request->satuan[$i] + 1)
                    ]);
                }
            } else {
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
                $id = $request->id;
            }
            return redirect()->route('perlengkapan.peminjaman_barang.show', $id);
        }
    }

    public function verif_baper(Request $request, $id)
    {
        $this->validate($request, [
            "verif_baper"  => "required|integer"
        ]);

        peminjaman_barang::findOrfail($id)->update([
            'verif_baper'    => $request->verif_baper
        ]);
        return redirect()->route('perlengkapan.peminjaman_barang.show', $id);
    }

    public function verif_ktu(Request $request, $id)
    {
        $this->validate($request, [
            "verif_ktu"  => "required|integer"
        ]);

        peminjaman_barang::findOrfail($id)->update([
            'verif_ktu'    => $request->verif_ktu
        ]);
        return redirect()->route('ktu.peminjaman_barang.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if ($request->laporan) {
            peminjaman_barang::findOrfail($id)->delete();
        } else {
            detail_pinjam_barang::where('idpinjam_barang_fk', $id)
                ->where('iddetail_data_barang_fk', $request->idmerk)
                ->delete();
        }
    }
}

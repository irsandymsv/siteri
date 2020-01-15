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
        $laporan = peminjaman_ruang::all();

        return view('perlengkapan.peminjaman_ruang.index', [
            'laporan' => $laporan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $jumlah_peserta)
    {
        // $nama_ruang = data_ruang::where('kuota', '>=', $jumlah_peserta)
        //     ->get();
        // $nama_ruang = data_ruang::where('kuota', '!=', '0')
        //     ->pluck('nama_ruang');
        $nama_ruang = data_ruang::all()->pluck('nama_ruang');

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
        // dd($request);
        $this->validate($request, [
            "tanggal_mulai"     => "required",
            "tanggal_berakhir"  => "required",
            "jam_mulai"         => "required",
            "jam_berakhir"      => "required",
            "kegiatan"          => "required|string|max:100",
            "jumlah_peserta"    => "required|integer",
            "nama_ruang"        => "required|array",
            "nama_ruang.*"      => "required|integer"
        ]);

        peminjaman_ruang::create([
            'tanggal_mulai'     => $request->tanggal_mulai,
            'tanggal_berakhir'  => $request->tanggal_berakhir,
            'jam_mulai'         => $request->jam_mulai,
            'jam_berakhir'      => $request->jam_berakhir,
            'kegiatan'          => $request->kegiatan,
            'jumlah_peserta'    => $request->jumlah_peserta
        ]);

        $idlaporan = peminjaman_ruang::all()->pluck('id')->last();

        for ($i = 0; $i < count($request->nama_ruang); $i++) {
            // dd($request);
            detail_pinjam_ruang::create([
                'idpinjam_ruang_fk' => $idlaporan,
                'idruang_fk'        => ($request->nama_ruang[$i] + 1)
            ]);
        }
        return redirect()->route('perlengkapan.peminjaman_ruang.show', $idlaporan);
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
    public function edit($id)
    {
        // dd($id);
        $nama_ruang = data_ruang::all()->pluck('nama_ruang', 'id');
        // $nama_ruang = data_ruang::where('kuota', '!=', '0')
        //     ->pluck('nama_ruang');
        $laporan = peminjaman_ruang::with(['detail_pinjam_ruang', 'detail_pinjam_ruang.data_ruang'])
            ->where('id', $id)
            ->first();
        // $detail_laporan = detail_pinjam_ruang::all()
        //     ->where('idpinjam_ruang_fk', $id);
        // ->get();

        return view('perlengkapan.peminjaman_ruang.edit', [
            'nama_ruang' => $nama_ruang,
            'laporan' => $laporan,
            // 'detail_laporan' => $detail_laporan
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
        if ($request->laporan) {

            $this->validate($request, [
                "tanggal_mulai"     => "required",
                "tanggal_berakhir"  => "required",
                "jam_mulai"         => "required",
                "jam_berakhir"      => "required",
                "kegiatan"          => "required|string|max:100",
                "jumlah_peserta"    => "required|integer",
                "nama_ruang"        => "required|array",
                "nama_ruang.*"      => "required|integer"
            ]);

            peminjaman_ruang::findOrfail($id)->update([
                "tanggal_mulai"     => $request->tanggal_mulai,
                "tanggal_berakhir"  => $request->tanggal_berakhir,
                "jam_mulai"         => $request->jam_mulai,
                "jam_berakhir"      => $request->jam_berakhir,
                "kegiatan"          => $request->kegiatan,
                "jumlah_peserta"    => $request->jumlah_peserta
            ]);

            detail_pinjam_ruang::whereIn('idpinjam_ruang_fk', [$id])->delete();

            for ($i = 0; $i < count($request->nama_ruang); $i++) {
                // dd($request);
                detail_pinjam_ruang::create([
                    'idpinjam_ruang_fk' => $id,
                    'idruang_fk'        => ($request->nama_ruang[$i] + 1)
                ]);
            }
        } else {
            // dd($request);
            $this->validate($request, [
                "nama_ruang"  => "required|integer"
            ]);

            detail_pinjam_ruang::findOrfail($id)->update([
                'idruang_fk'    => ($request->nama_ruang + 1)
            ]);
            dd("gak error");
        }

        return redirect()->route('perlengkapan.peminjaman_ruang.show', $id);
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
            peminjaman_ruang::findOrfail($id)->delete();
            Log::alert('Berhasil Dihapus');
        } else {
            detail_pinjam_ruang::findOrfail($id)->delete();
            Log::alert('Berhasil Dihapus');
        }
    }
}

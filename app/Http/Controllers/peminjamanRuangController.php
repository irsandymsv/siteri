<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Exception;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use App\detail_pinjam_ruang;
use App\peminjaman_ruang;
use App\data_ruang;
use App\Notifications\verifPeminjamanBarang;
use App\Notifications\verifPeminjamanRuang;

class peminjamanRuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            $laporan = peminjaman_ruang::all();

            return view(
                'ormawa.peminjaman_ruang.index',
                [
                    'laporan' => $laporan
                ]
            );
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $laporan = peminjaman_ruang::all();

            return view(
                'perlengkapan.peminjaman_ruang.index',
                [
                    'laporan' => $laporan
                ]
            );
        } else if (Auth::user()->jabatan->jabatan == 'KTU') {
            $laporan = peminjaman_ruang::where('verif_baper', '1')->get();

            return view(
                'ktu.peminjaman_ruang.index',
                [
                    'laporan' => $laporan
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $jumlah_peserta)
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            $ruang = data_ruang::with("detail_pinjam_ruang")->where('kuota', '!=', '0')->orderBy('kuota', 'desc')->get();
            // dd($ruang);

            return view(
                'ormawa.peminjaman_ruang.create',
                [
                    // 'nama_ruang' => $nama_ruang,
                    'ruang' => $ruang
                ]
            );
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $ruang = data_ruang::with("detail_pinjam_ruang", "detail_pinjam_ruang.peminjaman_ruang")->where('kuota', '!=', '0')->orderBy('kuota', 'desc')->get();
            // dd($ruang);

            return view(
                'perlengkapan.peminjaman_ruang.create',
                [
                    // 'nama_ruang' => $nama_ruang,
                    'ruang' => $ruang
                ]
            );
        }
    }

    public function ruangAjax(Request $reserve)
    {
        $GLOBALS['reserve'] = $reserve;
        // dd($GLOBALS['reserve']);
        $nama_ruang = data_ruang::with("detail_pinjam_ruang", "detail_pinjam_ruang.peminjaman_ruang")
            ->where('kuota', '>', '0')
            ->orderBy('kuota', 'desc')
            ->get()->filter(
                function ($item) {
                    // dump($item->detail_pinjam_ruang->isEmpty());
                    if ($item->detail_pinjam_ruang->isEmpty()) {
                        // dump($item->nama_ruang);
                        return $item;
                    } else {
                        $status = true;
                        foreach ($item->detail_pinjam_ruang as $key) {
                            // dump(Carbon::parse($key->peminjaman_ruang->tanggal_mulai . " " . $key->peminjaman_ruang->jam_mulai)->between($GLOBALS['reserve']->from, $GLOBALS['reserve']->to));
                            $from = Carbon::parse($key->peminjaman_ruang->tanggal_mulai . " " . $key->peminjaman_ruang->jam_mulai);
                            $to = Carbon::parse($key->peminjaman_ruang->tanggal_berakhir . " " . $key->peminjaman_ruang->jam_berakhir);
                            $start = Carbon::parse($GLOBALS['reserve']->from);
                            $end = Carbon::parse($GLOBALS['reserve']->to);

                            if (( ($from->between($start, $end) || $to->between($start, $end)) && $start->between($from, $to) || $end->between($from, $to) )) {
                                // dump($from, $to, $start, $end);
                                $status = false;
                            }
                        }
                        if ($status) {
                            return $item;
                        }
                    }
                    // else if (!(Carbon::parse($item->detail_pinjam_ruang->peminjaman_ruang->tanggal_mulai . " " . $item->detail_pinjam_ruang->peminjaman_ruang->jam_mulai)->between($GLOBALS['reserve']->from, $GLOBALS['reserve']->to) || Carbon::parse($item->detail_pinjam_ruang->peminjaman_ruang->tanggal_berakhir . " " . $item->detail_pinjam_ruang->peminjaman_ruang->jam_berakhir)->between($GLOBALS['reserve']->from, $GLOBALS['reserve']->to))) {
                        // return $item;
                    // }
                }
            );
        return json_encode($nama_ruang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            // dd($request);
            $this->validate(
                $request,
                [
                    "tanggal"           => "required",
                    "kegiatan"          => "required|string|max:100",
                    "jumlah_peserta"    => "required|integer",
                    "nama_ruang"        => "required|array",
                    "nama_ruang.*"      => "required|integer"
                ]
            );

            $tanggal = explode(" - ", $request->tanggal);
            $jam_mulai = explode(' ', $tanggal[0]);
            $tanggal_mulai = $jam_mulai[0];
            $jam_mulai = $jam_mulai[1];
            $jam_berakhir = explode(' ', $tanggal[1]);
            $tanggal_berakhir = $jam_berakhir[0];
            $jam_berakhir = $jam_berakhir[1];

            peminjaman_ruang::create(
                [
                    'tanggal_mulai'     => $tanggal_mulai,
                    'tanggal_berakhir'  => $tanggal_berakhir,
                    'jam_mulai'         => $jam_mulai,
                    'jam_berakhir'      => $jam_berakhir,
                    'kegiatan'          => $request->kegiatan,
                    'jumlah_peserta'    => $request->jumlah_peserta
                ]
            );

            $laporan = peminjaman_ruang::all()->last();

            for ($i = 0; $i < count($request->nama_ruang); $i++) {
                detail_pinjam_ruang::create(
                    [
                        'idpinjam_ruang_fk' => $laporan->id,
                        'idruang_fk'        => ($request->nama_ruang[$i])
                    ]
                );
                // dd($request);
            }

            $perlengkapan = User::with('jabatan')
                ->whereHas(
                    'jabatan',
                    function (Builder $query) {
                        $query->where('jabatan', 'Pengadministrasi BMN');
                    }
                )->first();

            $perlengkapan->notify(new verifPeminjamanRuang($laporan));

            return redirect()->route('ormawa.peminjaman_ruang.show', $laporan->id);
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $this->validate(
                $request,
                [
                    "tanggal"           => "required",
                    "kegiatan"          => "required|string|max:100",
                    "jumlah_peserta"    => "required|integer",
                    "nama_ruang"        => "required|array",
                    "nama_ruang.*"      => "required|integer"
                ]
            );

            $tanggal = explode(" - ", $request->tanggal);
            $jam_mulai = explode(' ', $tanggal[0]);
            $tanggal_mulai = $jam_mulai[0];
            $jam_mulai = $jam_mulai[1];
            $jam_berakhir = explode(' ', $tanggal[1]);
            $tanggal_berakhir = $jam_berakhir[0];
            $jam_berakhir = $jam_berakhir[1];

            peminjaman_ruang::create(
                [
                    'tanggal_mulai'     => $tanggal_mulai,
                    'tanggal_berakhir'  => $tanggal_berakhir,
                    'jam_mulai'         => $jam_mulai,
                    'jam_berakhir'      => $jam_berakhir,
                    'kegiatan'          => $request->kegiatan,
                    'jumlah_peserta'    => $request->jumlah_peserta,
                    'verif_baper'       => '1',
                    'verif_ktu'         => '1'
                ]
            );

            $idlaporan = peminjaman_ruang::all()->pluck('id')->last();

            for ($i = 0; $i < count($request->nama_ruang); $i++) {
                detail_pinjam_ruang::create(
                    [
                        'idpinjam_ruang_fk' => $idlaporan,
                        'idruang_fk'        => ($request->nama_ruang[$i])
                    ]
                );
                // dd($request);
            }
            return redirect()->route('perlengkapan.peminjaman_ruang.show', $idlaporan);
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
            $laporan = peminjaman_ruang::findOrfail($id);
            $detail_laporan = detail_pinjam_ruang::where('idpinjam_ruang_fk', $id)
                ->with(['peminjaman_ruang', 'data_ruang'])
                ->get();

            return view(
                'ormawa.peminjaman_ruang.show',
                [
                    'laporan' => $laporan,
                    'detail_laporan' => $detail_laporan
                ]
            );
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $laporan = peminjaman_ruang::findOrfail($id);
            $detail_laporan = detail_pinjam_ruang::where('idpinjam_ruang_fk', $id)
                ->with(['peminjaman_ruang', 'data_ruang'])
                ->get();

            return view(
                'perlengkapan.peminjaman_ruang.show',
                [
                    'laporan' => $laporan,
                    'detail_laporan' => $detail_laporan
                ]
            );
        } else if (Auth::user()->jabatan->jabatan == 'KTU') {
            $laporan = peminjaman_ruang::findOrfail($id);
            $detail_laporan = detail_pinjam_ruang::where('idpinjam_ruang_fk', $id)
                ->with(['peminjaman_ruang', 'data_ruang'])
                ->get();

            return view(
                'ktu.peminjaman_ruang.show',
                [
                    'laporan' => $laporan,
                    'detail_laporan' => $detail_laporan
                ]
            );
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->jabatan->jabatan == 'Pengadministrasi Layanan Kegiatan Mahasiswa') {
            $ruang = data_ruang::where('kuota', '!=', '0')->orderBy('kuota', 'desc')->get();
            $laporan = peminjaman_ruang::with(['detail_pinjam_ruang', 'detail_pinjam_ruang.data_ruang'])
                ->where('id', $id)
                ->first();
            $nama_ruang = [];
            foreach ($laporan->detail_pinjam_ruang as $item) {
                array_push($nama_ruang, $item->idruang_fk);
            }

            $tanggal1 = implode(" ", [$laporan->tanggal_mulai, $laporan->jam_mulai]);
            $tanggal2 = implode(" ", [$laporan->tanggal_berakhir, $laporan->jam_berakhir]);
            $tanggal = implode(" - ", [$tanggal1, $tanggal2]);

            return view(
                'ormawa.peminjaman_ruang.edit',
                [
                    'ruang'    => $ruang,
                    'nama_ruang'    => $nama_ruang,
                    'laporan'       => $laporan,
                    'tanggal'       => $tanggal
                ]
            );
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            $ruang = data_ruang::where('kuota', '!=', '0')->orderBy('kuota', 'desc')->get();
            $laporan = peminjaman_ruang::with(['detail_pinjam_ruang', 'detail_pinjam_ruang.data_ruang'])
                ->where('id', $id)
                ->first();
            $nama_ruang = [];
            foreach ($laporan->detail_pinjam_ruang as $item) {
                array_push($nama_ruang, $item->idruang_fk);
            }

            $tanggal1 = implode(" ", [$laporan->tanggal_mulai, $laporan->jam_mulai]);
            $tanggal2 = implode(" ", [$laporan->tanggal_berakhir, $laporan->jam_berakhir]);
            $tanggal = implode(" - ", [$tanggal1, $tanggal2]);

            return view(
                'perlengkapan.peminjaman_ruang.edit',
                [
                    'ruang'         => $ruang,
                    'nama_ruang'    => $nama_ruang,
                    'laporan'       => $laporan,
                    'tanggal'       => $tanggal
                ]
            );
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
            // dd($request);
            if ($request->laporan) {
                $this->validate(
                    $request,
                    [
                        "tanggal"           => "required",
                        "kegiatan"          => "required|string|max:100",
                        "jumlah_peserta"    => "required|integer",
                        "nama_ruang"        => "required|array",
                        "nama_ruang.*"      => "required|integer"
                    ]
                );

                $tanggal = explode(" - ", $request->tanggal);
                $jam_mulai = explode(' ', $tanggal[0]);
                $tanggal_mulai = $jam_mulai[0];
                $jam_mulai = $jam_mulai[1];
                $jam_berakhir = explode(' ', $tanggal[1]);
                $tanggal_berakhir = $jam_berakhir[0];
                $jam_berakhir = $jam_berakhir[1];

                peminjaman_ruang::findOrfail($id)->update(
                    [
                        "tanggal_mulai"     => $tanggal_mulai,
                        "tanggal_berakhir"  => $tanggal_berakhir,
                        "jam_mulai"         => $jam_mulai,
                        "jam_berakhir"      => $jam_berakhir,
                        "kegiatan"          => $request->kegiatan,
                        "jumlah_peserta"    => $request->jumlah_peserta
                    ]
                );

                detail_pinjam_ruang::whereIn('idpinjam_ruang_fk', [$id])->delete();

                for ($i = 0; $i < count($request->nama_ruang); $i++) {
                    detail_pinjam_ruang::create(
                        [
                            'idpinjam_ruang_fk' => $id,
                            'idruang_fk'        => $request->nama_ruang[$i]
                        ]
                    );
                }
            } else {
                // dd($request);
                $this->validate(
                    $request,
                    [
                        "nama_ruang"  => "required|integer"
                    ]
                );

                detail_pinjam_ruang::findOrfail($id)->update(
                    [
                        'idruang_fk'    => ($request->nama_ruang + 1)
                    ]
                );
                dd("gak error");
            }

            return redirect()->route('ormawa.peminjaman_ruang.show', $id);
        } else if (Auth::user()->jabatan->jabatan == 'Pengadministrasi BMN') {
            if ($request->laporan) {
                $this->validate(
                    $request,
                    [
                        "tanggal"           => "required",
                        "kegiatan"          => "required|string|max:100",
                        "jumlah_peserta"    => "required|integer",
                        "nama_ruang"        => "required|array",
                        "nama_ruang.*"      => "required|integer"
                    ]
                );

                $tanggal = explode(" - ", $request->tanggal);
                $jam_mulai = explode(' ', $tanggal[0]);
                $tanggal_mulai = $jam_mulai[0];
                $jam_mulai = $jam_mulai[1];
                $jam_berakhir = explode(' ', $tanggal[1]);
                $tanggal_berakhir = $jam_berakhir[0];
                $jam_berakhir = $jam_berakhir[1];

                peminjaman_ruang::findOrfail($id)->update(
                    [
                        "tanggal_mulai"     => $tanggal_mulai,
                        "tanggal_berakhir"  => $tanggal_berakhir,
                        "jam_mulai"         => $jam_mulai,
                        "jam_berakhir"      => $jam_berakhir,
                        "kegiatan"          => $request->kegiatan,
                        "jumlah_peserta"    => $request->jumlah_peserta
                    ]
                );

                detail_pinjam_ruang::whereIn('idpinjam_ruang_fk', [$id])->delete();

                for ($i = 0; $i < count($request->nama_ruang); $i++) {
                    detail_pinjam_ruang::create(
                        [
                            'idpinjam_ruang_fk' => $id,
                            'idruang_fk'        => $request->nama_ruang[$i]
                        ]
                    );
                }
            } else {
                // dd($request);
                $this->validate(
                    $request,
                    [
                        "nama_ruang"  => "required|integer"
                    ]
                );

                detail_pinjam_ruang::findOrfail($id)->update(
                    [
                        'idruang_fk'    => ($request->nama_ruang + 1)
                    ]
                );
                dd("gak error");
            }

            return redirect()->route('perlengkapan.peminjaman_ruang.show', $id);
        }
    }

    public function verif_baper(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                "verif_baper"  => "required|integer"
            ]
        );

        peminjaman_ruang::findOrfail($id)->update(
            [
                'verif_baper'    => $request->verif_baper
            ]
        );

        $laporan = peminjaman_ruang::findOrfail($id);

        $ktu = User::with('jabatan')
            ->whereHas(
                'jabatan',
                function (Builder $query) {
                    $query->where('jabatan', 'KTU');
                }
            )->first();

        $ormawa = User::with('jabatan')
            ->whereHas(
                'jabatan',
                function (Builder $query) {
                    $query->where('jabatan', 'Pengadministrasi Layanan Kegiatan Mahasiswa');
                }
            )->first();

        $ktu->notify(new verifPeminjamanRuang($laporan));
        $ormawa->notify(new verifPeminjamanRuang($laporan));

        return redirect()->route('perlengkapan.peminjaman_ruang.show', $id);
    }

    public function verif_ktu(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                "verif_ktu"  => "required|integer"
            ]
        );

        peminjaman_ruang::findOrfail($id)->update(
            [
                'verif_ktu'    => $request->verif_ktu
            ]
        );

        $laporan = peminjaman_ruang::findOrfail($id);
        $perlengkapan = User::with('jabatan')
            ->whereHas(
                'jabatan',
                function (Builder $query) {
                    $query->where('jabatan', 'Pengadministrasi BMN');
                }
            )->first();
        $ormawa = User::with('jabatan')
            ->whereHas(
                'jabatan',
                function (Builder $query) {
                    $query->where('jabatan', 'Pengadministrasi Layanan Kegiatan Mahasiswa');
                }
            )->first();

        $perlengkapan->notify(new verifPeminjamanRuang($laporan));
        $ormawa->notify(new verifPeminjamanRuang($laporan));

        return redirect()->route('ktu.peminjaman_ruang.show', $id);
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
            peminjaman_ruang::findOrfail($id)->delete();
        } else {
            detail_pinjam_ruang::where('idpinjam_ruang_fk', $id)
                ->where('idruang_fk', $request->idruang)
                ->delete();
        }
    }
}

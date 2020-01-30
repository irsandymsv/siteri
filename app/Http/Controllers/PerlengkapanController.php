<?php

namespace App\Http\Controllers;

use App\laporan_pengadaan;
use App\peminjaman_ruang;
use App\peminjaman_barang;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\surat_tugas;
use App\sk_sempro;
use App\sk_skripsi;
use App\sk_honor;

class PerlengkapanController extends Controller
{
    public function dashboard()
    {
        //Laporan Pengadaan
        $pengadaan = laporan_pengadaan::where('verif_wadek2', 1)->orderBy('updated_at', 'desc')->get();

        dd($pengadaan);
        //Penimjaman Barang
        $pinjam_barang = peminjaman_barang::where('verif_baper', 1)->where('verif_ktu', 0)->limit(10)->get();

        //Penimjaman Ruang
        $pinjam_ruang = peminjaman_ruang::where('verif_baper', 1)->where('verif_ktu', 0)->limit(10)->get();


        return view(
            'perlengkapan.dashboard',
            [
                'pengadaan'             => $pengadaan,
                'pinjam_barang'         => $pinjam_barang,
                'pinjam_ruang'          => $pinjam_ruang
            ]
        );
    }
}

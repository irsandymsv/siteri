<?php

namespace App\Http\Controllers;

use App\peminjaman_ruang;
use App\peminjaman_barang;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\surat_tugas;
use App\sk_sempro;
use App\sk_skripsi;
use App\sk_honor;

class KTUController extends Controller
{
    public function dashboard()
    {
        //Surat Tugas Akademik yg Butuh Verifikasi
        $sutgas_dikirim = surat_tugas::with(["tipe_surat_tugas", "status_surat_tugas"])
            ->whereHas(
                "status_surat_tugas", function (Builder $query) {
                    $query->where("status", "Dikirim");
                }
            )->orderBy('created_at', 'desc')->get();

        //SK Sempro yg Butuh Verifikasi
        $sk_sempro_dikirim = sk_sempro::with("status_sk")
            ->whereHas(
                "status_sk", function (Builder $query) {
                    $query->where("status", "Dikirim");
                }
            )->orderBy('created_at', 'desc')->get();

        //SK Skripsi yg Butuh Verifikasi
        $sk_skripsi_dikirim = sk_skripsi::with("status_sk")
            ->whereHas(
                "status_sk", function (Builder $query) {
                    $query->where("status", "Dikirim");
                }
            )->orderBy('created_at', 'desc')->get();

        //SK Honor Sempro
        $sk_honor_sempro = sk_honor::orderBy('updated_at', 'desc')
            ->with(['sk_sempro', 'status_sk_honor'])
            ->doesntHave('sk_skripsi')->take(3)->get();

        //SK Honor Skripsi
        $sk_honor_skripsi = sk_honor::orderBy('updated_at', 'desc')
            ->with(['sk_skripsi', 'status_sk_honor'])
            ->doesntHave('sk_sempro')->take(3)->get();

        //Penimjaman Barang
        $pinjam_barang = peminjaman_barang::where('verif_baper', 1)->where('verif_ktu', 0)->limit(3)->get();

        //Penimjaman Ruang
        $pinjam_ruang = peminjaman_ruang::where('verif_baper', 1)->where('verif_ktu', 0)
            ->orderBy('updated_at', 'DESC')->limit(3);



        return view(
            'ktu.dashboard', [
            'sutgas_dikirim'        => $sutgas_dikirim,
            'sk_sempro_dikirim'     => $sk_sempro_dikirim,
            'sk_skripsi_dikirim'    => $sk_skripsi_dikirim,
            'sk_honor_sempro'       => $sk_honor_sempro,
            'sk_honor_skripsi'      => $sk_honor_skripsi,
            'pinjam_barang'         => $pinjam_barang,
            'pinjam_ruang'          => $pinjam_ruang
            ]
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\laporan_pengadaan;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\sk_sempro;
use App\sk_skripsi;
use App\sk_honor;

class wadek2Controller extends Controller
{
    public function dashboard()
    {
        //SK Sempro Terbaru
        $sk_sempro = sk_sempro::with("status_sk")
            ->whereHas(
                "status_sk", function (Builder $query) {
                    $query->where("status", "Disetujui KTU");
                }
            )->orderBy('created_at', 'desc')->take(3)->get();

        //SK Skripsi Terbaru
        $sk_skripsi = sk_skripsi::with("status_sk")
            ->whereHas(
                "status_sk", function (Builder $query) {
                    $query->where("status", "Disetujui KTU");
                }
            )->orderBy('created_at', 'desc')->take(3)->get();

        //SK Honor Sempro
        $sk_honor_sempro = sk_honor::orderBy('updated_at', 'desc')
            ->with(['sk_sempro', 'status_sk_honor'])
            ->doesntHave('sk_skripsi')->take(3)->get();

        //SK Honor Skripsi
        $sk_honor_skripsi = sk_honor::orderBy('updated_at', 'desc')
            ->with(['sk_skripsi', 'status_sk_honor'])
            ->doesntHave('sk_sempro')->take(3)->get();

        //Laporan Pengadaan
        $pengadaan = laporan_pengadaan::where('verif_wadek2', 0)->with('pengadaan')
            ->orderBy('updated_at', 'desc')->get();

        $total = [];
        foreach ($pengadaan as $item) {
            $subTotal = 0;
            foreach ($item->pengadaan as $subItem) {
                $subTotal += ($subItem->jumlah * $subItem->harga);
            }
            array_push($total, "Rp. ". number_format($subTotal, 2));
        }

        return view(
            'wadek2.dashboard', [
            'pengadaan'         => $pengadaan,
            'total'             => $total,
            'sk_sempro'         => $sk_sempro,
            'sk_skripsi'        => $sk_skripsi,
            'sk_honor_sempro'   => $sk_honor_sempro,
            'sk_honor_skripsi'  => $sk_honor_skripsi
            ]
        );
    }
}

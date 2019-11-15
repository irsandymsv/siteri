<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function get_tahun_akademik(DateTime $tanggal){
        $tanggal = new Carbon($tanggal);
        $tahun_pembuatan = $tanggal->year;

        $awalSemester = Carbon::create($tahun_pembuatan, 1, 15);
        $akhirSemester = Carbon::create($tahun_pembuatan, 7, 15);
        if ($tanggal->isBetween($awalSemester, $akhirSemester)) {//Semester Genap
            $tahun_perhitungan = $tanggal->subYear();
            $tahun_perhitungan = $tahun_perhitungan->year;
            $tahun_akademik = [
                'tahun_awal' => $tahun_perhitungan,
                'tahun_akhir' => $tahun_pembuatan
            ];
        } else { //Semeter Ganjil
            $tahun_perhitungan = $tanggal->addYear();
            $tahun_perhitungan = $tahun_perhitungan->year;
            $tahun_akademik = [
                'tahun_awal' => $tahun_pembuatan,
                'tahun_akhir' => $tahun_perhitungan
            ];
        }
        return $tahun_akademik;

    }
}

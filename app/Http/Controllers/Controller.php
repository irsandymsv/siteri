<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
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

    protected function set_pph($user)
    {
        $gol = null;
        if (!is_null($user->golongan)) {
            $gol = $user->golongan->golongan;
        }
        $fungsional = $user->fungsional->jab_fungsional;

        if ($user->is_dosen == 1) {
            if (strpos($gol, "III") !== false || is_null($gol)) {
                $user->pph = 5;
            }
            elseif (strpos($gol, "IV") !== false || $fungsional == "Guru Besar") {
                $user->pph = 15;
            }
        }
        elseif ($user->is_dosen == 0) {
            if (strpos($gol, "III") !== false || is_null($gol)) {
                $user->pph = 5;
            }
            elseif (strpos($gol, "IV") !== false) {
                $user->pph = 15;
            }
            elseif ($gol == "II A" || $gol == "II B" || $gol == "II C" || $gol == "II D") {
                $user->pph = 0;
            }
        }

        return $user;
    }
    

    public function cek_jabatan()
    {   
        $user = Auth::user()->jabatan->jabatan;
        if($user == "Dekan"){
            return "dekan";
        }
        elseif ($user == "Wakil Dekan 1") {
            return "wadek1";
        }
        elseif ($user == "Wakil Dekan 2") {
            return "wadek2";
        }
        elseif($user == "Dosen") {
            return "dosen";
        }
        elseif($user == "Pemroses Mutasi Kepegawaian") {
            return "kepegawaian";
        }
        elseif($user == "Admin") {
            return "admin";
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\Http\Controllers\Controller;
use App\detail_pinjam_ruang;

class peminjamanRuangController extends Controller
{
    public function index()
    {
        try {
            $laporan = detail_pinjam_ruang::with(['data_ruang', 'peminjaman_ruang'])
                ->get();

            // dd($laporan);

            return view('perlengkapan.peminjaman_ruang.index', [
                'laporan' => $laporan
            ]);
        } catch (Exception $e) {
            return view('perlengkapan.peminjaman_ruang.index');
        }
    }
}

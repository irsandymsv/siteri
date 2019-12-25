<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\Http\Controllers\Controller;
use App\peminjaman_ruang;

class peminjamanRuangController extends Controller
{
    public function index()
    {
        try {
            $laporan = peminjaman_ruang::with(['detail_data_barang.data_barang', 'satuan'])
                ->get();

            return view('perlengkapan.peminjaman_ruang.index', [
                'laporan' => $laporan
            ]);
        } catch (Exception $e) {
            return view('perlengkapan.peminjaman_ruang.index');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\Http\Controllers\Controller;
use App\peminjaman_barang;

class peminjamanBarangController extends Controller
{
    public function index()
    {
        try {
            $laporan = peminjaman_barang::with(['detail_data_barang.data_barang', 'satuan'])
                ->get();

            // dd($laporan);

            return view('perlengkapan.peminjaman_barang.index', [
                'laporan' => $laporan
            ]);
        } catch (Exception $e) {
            return view('perlengkapan.peminjaman_barang.index');
        }
    }

    public function create()
    {
        // $kategori = kategori_barang::all();
        // //dd($kategori);
        // return view('perlengkapan.inventaris.create', [
        //     'kategori' => $kategori
        // ]);
    }
}

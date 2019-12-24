<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use App\Http\Controllers\Controller;
use App\peminjaman_barang;
use App\satuan;

class peminjamanBarangController extends Controller
{
    public function index()
    {
        try {
            $laporan = peminjaman_barang::with(['data_detail_barang.data_barang', 'satuan'])
                ->get();

            // dd($laporan);

            // $laporan = DB::table('pinjam_barang')
            //     ->select('tanggal_mulai', 'tanggal_berakhir', 'jam_mulai', 'jam_berakhir', 'kegiatan', 'namabarang', 'merk_barang', 'jumlah', 'satuan')
            //     ->join('datadetail_barang', 'pinjam_barang.iddatadetail_barang_fk', '=', 'datadetail_barang.id')
            //     ->join('databarang', 'datadetail_barang.idbarang_fk', '=', 'databarang.id')
            //     ->join('satuan', 'pinjam_barang.idsatuan_fk', '=', 'satuan.id')
            //     ->get();



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

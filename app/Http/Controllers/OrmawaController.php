<?php

namespace App\Http\Controllers;

use App\peminjaman_ruang;
use App\peminjaman_barang;

class OrmawaController extends Controller
{
    public function dashboard()
    {
        //Penimjaman Barang
        $pinjam_barang = peminjaman_barang::limit(10)->get();

        //Penimjaman Ruang
        $pinjam_ruang = peminjaman_ruang::limit(10)->get();



        return view(
            'ormawa.dashboard', [
            'pinjam_barang'         => $pinjam_barang,
            'pinjam_ruang'          => $pinjam_ruang
            ]
        );
    }
}

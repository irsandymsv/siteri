<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $user = User::where('no_pegawai', $user->no_pegawai)->with('jabatan')->first();
        // dd($user);

        if ($user->jabatan->jabatan == "Dosen") {
            return redirect()->route('dosen.dashboard');
        }
        elseif ($user->jabatan->jabatan == "Dekan") {
            return redirect()->route('dekan.dashboard');
        }
        elseif ($user->jabatan->jabatan == "Wakil Dekan 2") {
            return redirect()->route('wadek2.dashboard');
        }
        elseif ($user->jabatan->jabatan == "KTU") {
            return redirect()->route('ktu.dashboard');
        }
        elseif ($user->jabatan->jabatan == "BPP") {
            return redirect()->route('bpp.dashboard');
        }
        elseif ($user->jabatan->jabatan == "Pengelola Data Akademik") {
            return redirect()->route('akademik.dashboard');
        }
        elseif ($user->jabatan->jabatan == "Penata Dokumen Keuangan") {
            return redirect()->route('keuangan.dashboard');
        }
        elseif ($user->jabatan->jabatan == "Pengadministrasi Kemahasiswaan & Alumni") {
            return redirect()->route('kemahasiswaan.dashboard');
        }
        elseif ($user->jabatan->jabatan == "Pengadministrasi BMN") {
            return redirect()->route('perlengkapan.dashboard');
        }
        else {
            return view('home');
        }

    }
}

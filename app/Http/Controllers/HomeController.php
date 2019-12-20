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
        else {
            return view('home');
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SkSkripsiController extends Controller
{
    public function create(){
        
        return view('akademik.skripsi.create');
    }
}

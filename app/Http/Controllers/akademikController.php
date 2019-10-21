<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class akademikController extends Controller
{
    public function dashboard()
    {
    	return view('akademik.dashboard');
    }
}

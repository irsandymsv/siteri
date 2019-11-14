<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class templateController extends Controller
{
    public function index()
    {
    	return view('template_surat.index');
    }

    public function create()
    {
    	return view('template_surat.create');
    }

    public function store(Request $request)
    {
    	# code...
    }

    // public function show($id)
    // {
    // 	return view('template_surat.show');
    // }

    public function edit($id)
    {
    	return view('template_surat.edit');
    }

    public function update(Request $request, $id)
    {
    	# code...
    }

    //SK Akademik
    public function index_sk_akademik()
    {
        return view('akademik.SK_view.template_index');
    }

    public function create_sk_akademik()
    {
        return view('akademik.SK_view.template_create');
    }

    public function store_sk_akademik(Request $request)
    {
        # code...
    }

    // public function show_sk_akademik($id)
    // {
    //     return view('akademik.SK_view.show');
    // }

    public function edit_sk_akademik($id)
    {
        return view('akademik.SK_view.template_edit');
    }

    public function update_sk_akademik(Request $request, $id)
    {
        # code...
    }
}

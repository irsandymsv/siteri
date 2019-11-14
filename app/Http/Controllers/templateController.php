<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\nama_template;
use App\template;

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
        $this->validate($request, [
            'nama_surat' => 'required',
        ]);
        try {
            nama_template::insert([
                'nama_surat' => $request->input('nama_surat'),
            ]);
            return redirect()->route('template.create')->with('success', 'Data Berhasil Dibuat');
        } catch (Exception $e) {
            return redirect()->route('template.create')->with('error', $e->getMessage());
        }
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
        $this->validate($request, [
            'nama_surat' => 'required',
        ]);
        try {
            nama_template::insert([
                'nama_surat' => $request->input('nama_surat'),
            ]);
            return redirect()->route('template.edit',$id)->with('success', 'Data Berhasil Dibuat');
        } catch (Exception $e) {
            return redirect()->route('template.edit',$id)->with('error', $e->getMessage());
        }
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
        $this->validate($request,[
            'id_nama_surat' => 'required',
            'isi' => 'required'
        ]);
        try{
            template::insert([
                'id_nama_surat' => $request->input('id_nama_surat'),
                'isi' => $request->input('isi')
            ]);
            return redirect()->route('akademik.template-sk.create')->with('success','Data Berhasil Dibuat');
        }catch(Exception $e){
            return redirect()->route('akademik.template-sk.create')->with('error', $e->getMessage());
        }
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
        $this->validate($request, [
            'id_nama_surat' => 'required',
            'isi' => 'required'
        ]);
        try {
            template::where('id',$id)->update([
                'id_nama_surat' => $request->input('id_nama_surat'),
                'isi' => $request->input('isi')
            ]);
            return redirect()->route('akademik.template-sk.edit',$id)->with('success', 'Data Berhasil Dibuat');
        } catch (Exception $e) {
            return redirect()->route('akademik.template-sk.edit', $id)->with('error', $e->getMessage());
        }
    }
}

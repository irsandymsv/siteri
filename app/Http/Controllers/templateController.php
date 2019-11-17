<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Exception;
use App\nama_template;
use App\template;
use carbon\Carbon;

class templateController extends Controller
{
    public function index()
    {
        $nama_template = nama_template::all();
    	return view('template_surat.index', ['nama_template' => $nama_template]);
    }

    public function create()
    {
    	return view('template_surat.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);
        try {
            nama_template::insert([
                'nama' => $request->input('nama'),
            ]);
            return redirect()->route('template.index')->with('success', 'Data Berhasil Dibuat');
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
        $nama_template = nama_template::find($id);
    	return view('template_surat.edit', ['nama_template' => $nama_template]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);
        try {
            nama_template::where('id',$id)->update([
                'nama' => $request->input('nama'),
            ]);
            return redirect()->route('template.index')->with('success', 'Data Berhasil Dibuat');
        } catch (Exception $e) {
            return redirect()->route('template.edit',$id)->with('error', $e->getMessage());
        }
    }


    //SK Akademik
    public function index_sk_akademik()
    {
        $template_sempro = template::with('nama_template')
        ->whereHas('nama_template', function(Builder $query)
        {
            $query->where('nama','SK Sempro');
        })
        ->orderBy('created_at', 'desc')
        ->first();

        $template_skripsi = template::with('nama_template')
        ->whereHas('nama_template', function(Builder $query)
        {
            $query->where('nama','SK Skripsi');
        })
        ->orderBy('created_at', 'desc')
        ->first();

        // dd($template_sempro);
        return view('akademik.SK_view.template_index', [
            'template_sempro' => $template_sempro,
            'template_skripsi' => $template_skripsi
        ]);
    }

    public function create_sk_akademik()
    {
        $nama_template = nama_template::all();
        return view('akademik.SK_view.template_create', ['nama_template' => $nama_template]);
    }

    public function store_sk_akademik(Request $request)
    {
        $this->validate($request,[
            'id_nama_template' => 'required',
            'isi' => 'required'
        ]);
        try{
            template::insert([
                'id_nama_template' => $request->input('id_nama_template'),
                'isi' => $request->input('isi'),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
            return redirect()->route('akademik.template-sk.index')->with('success','Data Berhasil Dibuat');
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
        $nama_template = nama_template::all();
        $template = template::find($id);
        // dd($template);
        return view('akademik.SK_view.template_edit', [
            'nama_template' => $nama_template,
            'template' => $template
        ]);
    }

    public function update_sk_akademik(Request $request, $id)
    {
        $this->validate($request, [
            'id_nama_template' => 'required',
            'isi' => 'required'
        ]);
        try {
            template::where('id',$id)->update([
                'id_nama_template' => $request->input('id_nama_template'),
                'isi' => $request->input('isi')
            ]);
            return redirect()->route('akademik.template-sk.edit',$id)->with('success', 'Data Berhasil Diubah');
        } catch (Exception $e) {
            return redirect()->route('akademik.template-sk.edit', $id)->with('error', $e->getMessage());
        }
    }
}

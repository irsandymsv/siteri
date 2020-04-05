<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\data_ruang;

class ruangController extends Controller
{
    public function index()
    {
        $ruang = data_ruang::all();

        return view('perlengkapan.ruang.index', [
            'ruang'  => $ruang
        ]);
    }

    public function create()
    {
        return view('perlengkapan.ruang.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "kode_ruang"    => "required|array",
            "kode_ruang.*"  => "required|string|max:8",
            "nama_ruang"    => "required|array",
            "nama_ruang.*"  => "required|string|max:100",
            "kuota"         => "required|array",
            "kuota.*"       => "required|integer"
        ]);

        for ($i = 0; $i < count($request->nama_ruang); $i++) {
            data_ruang::create([
                'kode_ruang' => $request->kode_ruang[$i],
                'nama_ruang' => $request->nama_ruang[$i],
                'kuota'      => $request->kuota[$i]
            ]);
        }
        return redirect()->route('perlengkapan.ruang.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $ruang = data_ruang::where('id', $id)->first();

        return view('perlengkapan.ruang.edit', [
            'ruang' => $ruang
        ]);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            "kode_ruang"  => "required|string|max:8",
            "nama_ruang"  => "required|string|max:100",
            "kuota"       => "required|integer"
        ]);

        data_ruang::findOrfail($id)->update([
            'kode_ruang' => $request->kode_ruang,
            'nama_ruang' => $request->nama_ruang,
            'kuota'      => $request->kuota
        ]);

        return redirect()->route('perlengkapan.ruang.index');
    }

    public function destroy($id)
    {
        data_ruang::findOrfail($id)->delete();
    }
}

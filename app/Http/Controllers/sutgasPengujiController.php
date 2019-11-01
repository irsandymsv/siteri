<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sutgasPengujiController extends sutgasPengujiController
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_detail_skripsi' => 'required',
            'no_surat' => 'required',
            'id_penguji_utama' => 'required',
            'id_penguji_pendamping' => 'required',
            'status' => 'required'
        ]);
        try {
            $surat_tugas = $this->store_sutgas($request, 3, $request->status);
            $this->update_detail_skripsi(
                $request,
                $surat_tugas->id,
                'id_surat_tugas_penguji',
                'id_penguji_utama',
                'iid_penguji_pendamping'
            );
            return redirect()->route('akademik.sutgas-penguji.index')->with('success', 'Data Surat Tugas Berhasil Ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('akademik.sutgas-penguji.create')->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_detail_skripsi' => 'required',
            'no_surat' => 'required',
            'id_penguji_utama' => 'required',
            'id_penguji_pendamping' => 'required',
            'status' => 'required'
        ]);
        try {
            $this->update_sutgas($request, 3, $request->status, $id);
            $this->update_detail_skripsi(
                $request,
                $id,
                'id_surat_tugas_penguji',
                'id_penguji_utama',
                'iid_penguji_pendamping'
            );
            return redirect()->route('akademik.sutgas-pembahas.edit', $id)->with('success', 'Data Surat Tugas Berhasil Dirubah');
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect()->route('akademik.sutgas-pembahas.edit', $id)->with('error', $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\fungsional;
use App\golongan;
use App\jabatan;
use App\pangkat;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;

class manageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('username', '!=', 'admin')->paginate(10);
        return view('admin.pegawai.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pangkat = pangkat::where('id', '!=', '12')->get();;
        $golongan = golongan::where('id', '!=', '5')->get();
        $jabatan = jabatan::where('id', '!=', '1')->get();
        $fungsional = fungsional::all();

      //  dd($pangkat);

        return view('admin.pegawai.create', compact('pangkat', 'golongan', 'jabatan', 'fungsional'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'nama' => 'required|string|min:4|max:40',
            'username' => 'required|string|min:4|max:20|unique:users',
            'no_pegawai' => 'required|digits_between:1,25|max:25|unique:users',
            'jabatan' => 'required',
            'fungsional' => 'required',

        ]);

            $jabfung = $request->fungsional;
        if($jabfung == 6){
            $insert = ([
                'username' => $request->username,
                'password' => bcrypt("default"),
                'nama' => $request->nama,
                'no_pegawai' => $request->no_pegawai,
                'id_jabatan' => $request->jabatan,
                'id_pangkat' => 12,
                'id_golongan' => 5,
                'id_fungsional' => $request->fungsional,
                'is_dosen' => $request->dosen,
            ]);
        }
        else{
        $insert = ([
            'username' => $request->username,
            'password' => bcrypt("default"),
            'nama' => $request->nama,
            'no_pegawai' => $request->no_pegawai,
            'id_jabatan' => $request->jabatan,
            'id_pangkat' => $request->pangkat,
            'id_golongan' => $request->golongan,
            'id_fungsional' => $request->fungsional,
            'is_dosen' => $request->dosen,
        ]);
        }
        User::create($insert);
        return redirect('/admin')->with('success', 'Item created successfully!');
        // $data = User::where('username', '!=', 'admin')->paginate(10);
        // return view('admin.pegawai.index', compact('data'));

    }

    /* Search Function */
    public function search(Request $request)
    {
        $constraints = [
            'pangkat' => $request['pangkat'],
            'jabatan' => $request['jabatan'],
            'nama' => $request['nama']
        ];

        $data = $this->doSearchingQuery($constraints);
        return view('admin/pegawai/index', ['data' => $data, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints)
    {
        $query = User::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%' . $constraint . '%');
            }
            $index++;
        }
        return $query->paginate(10);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fungsional = DB::table('fungsional')->get();
        $golongan = DB::table('golongan')->get();
        $jabatan = DB::table('jabatan')->get();
        $pangkat = DB::table('pangkat')->get();
        // $pangkat = pangkat::get();
        $user = User::where('username', $id)->with(["fungsionalnya", "golongannya", "pangkatnya", "jabatannya"])->first();
        return view('admin/pegawai/edit', ['users' => $user, 'fungsional' => $fungsional, 'golongan' => $golongan, 'jabatan' => $jabatan, 'pangkat' => $pangkat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        $jabfung = $request->fungsional;
        if($jabfung == 6){
            $users = DB::table('users')->where('username', $username)->update([
                'nama' => $request->nama,
                'is_dosen' => $request->dosen,
                'id_fungsional' => $request->fungsional,
                'id_pangkat' => 12,
                'id_golongan' => 5,
                'id_jabatan' => $request->jabatan,
            ]);
        }
        else{
            $users = DB::table('users')->where('username', $username)->update([
                'nama' => $request->nama,
                'is_dosen' => $request->dosen,
                'id_fungsional' => $request->fungsional,
                'id_pangkat' => $request->pangkat,
                'id_golongan' => $request->golongan,
                'id_jabatan' => $request->jabatan,
            ]);
        }

        return redirect('/admin')->with('success', 'Berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::where('username', $id);
        $data->delete();
        return redirect()->back()->with('success', 'Berhasil dihapus!');
    }
    public function reset($id)
    {
        $users = DB::table('users')->where('username', $id)->update([
            'password' => bcrypt("default"),
        ]);
        return redirect()->back()->with('success', 'Berhasil direset!');
    }

    public function akademik_ganti_password()
    {
        $data = User::all();

        return view('akademik.ganti_password');
    }
    public function kemahasiswaan_ganti_password()
    {
        $data = User::all();

        return view('kemahasiswaan.ganti_password');
    }
    public function keuangan_ganti_password()
    {
        $data = User::all();

        return view('keuangan.ganti_password');
    }
    public function dosen_ganti_password()
    {
        $data = User::all();

        return view('dosen.ganti_password');
    }
    public function ormawa_ganti_password()
    {
        $data = User::all();

        return view('ormawa.ganti_password');
    }
    public function perlengkapan_ganti_password()
    {
        $data = User::all();

        return view('perlengkapan.ganti_password');
    }
    public function dekan_ganti_password()
    {
        $data = User::all();

        return view('dekan.ganti_password');
    }
    public function wadek1_ganti_password()
    {
        $data = User::all();

        return view('wadek1.ganti_password');
    }
    public function wadek2_ganti_password()
    {
        $data = User::all();

        return view('wadek2.ganti_password');
    }
    public function ktu_ganti_password()
    {
        $data = User::all();

        return view('ktu.ganti_password');
    }
    public function bpp_ganti_password()
    {
        $data = User::all();

        return view('bpp.ganti_password');
    }
    public function kepegawaian_ganti_password()
    {
        $data = User::all();

        return view('kepegawaian.ganti_password');
    }
    public function staffpim_ganti_password()
    {
        $data = User::all();

        return view('staff_pimpinan.ganti_password');
    }

    public function simpan_password(Request $request, $id)
    {
        $data = DB::table('users')->where('no_pegawai', $id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password Berhasil Diubah!');
    }
}

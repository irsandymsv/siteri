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
        $pangkat = pangkat::all();
        $golongan = golongan::all();
        $jabatan = jabatan::where('id', '!=', '1')->get();
        $fungsional = fungsional::all();

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
            'password' => 'required|string|min:8',
            'no_pegawai' => 'required|digits_between:1,25|max:25|unique:users',
            'jabatan' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'fungsional' => 'required',
        ]);

        $insert = ([
            'username' => $request->username,
            'password' => bcrypt($request['password']),
            'nama' => $request->nama,
            'no_pegawai' => $request->no_pegawai,
            'id_jabatan' => $request->jabatan,
            'id_pangkat' => $request->pangkat,
            'id_golongan' => $request->golongan,
            'id_fungsional' => $request->fungsional,
        ]);
       
        User::create($insert);
        return redirect('/admin/pegawai')->with('success','Item created successfully!');
        // $data = User::where('username', '!=', 'admin')->paginate(10);
        // return view('admin.pegawai.index', compact('data'));

    }

    
    public function search(Request $request) {

        $constraints = [
            'pangkat' => $request['pangkat'],
            'jabatan' => $request['jabatan'],
            'nama' => $request['nama']
            ];

       $pegawai = $this->doSearchingQuery($constraints);
       return view('admin/data-pegawai/index', ['pegawai' => $pegawai, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = Pegawai::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
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

        $users = DB::table('users')->where('username', $username)->update([
            'nama' => $request->nama,
            'id_fungsional' => $request->fungsional,
            'id_golongan' => $request->golongan,
            'id_pangkat' => $request->pangkat,
            'id_jabatan' => $request->jabatan,
        ]);

        // $data = User::get()->where('username', '!=', 'admin');
        // return view('admin.pegawai.index', compact('data'));
        return redirect('/admin/pegawai')->with('success','Berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::where('username',$id);
        $data->delete();
        return redirect()->back()->with('success','Berhasil dihapus!');
    }

    public function dosen_ganti_password()
    {
        $data = User::all();

        return view('dosen.ganti_password');
    }
    public function dekan_ganti_password()
    {
        $data = User::all();

        return view('dekan.ganti_password');
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

        return view('staffpim.ganti_password');
    }

    public function simpan_password(Request $request, $id)
    {
        $data = DB::table('users')->where('no_pegawai', $id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password Berhasil Diubah!');
    }
}

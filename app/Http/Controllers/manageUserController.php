<?php

namespace App\Http\Controllers;

use App\fungsional;
use App\golongan;
use App\jabatan;
use App\pangkat;
use App\prodi;
use App\bagian;
use App\User;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
        // $pangkat = pangkat::where('id', '!=', '12')->get();
        // $golongan = golongan::where('id', '!=', '5')->get();
        // $jabatan = jabatan::where('id', '!=', '1')->get();
        $pangkat = pangkat::all();
        $golongan = golongan::all();
        $jabatan = jabatan::all();
        $fungsional = fungsional::all();
        $prodi = prodi::all();
        $bagian = bagian::all();

        return view('admin.pegawai.create', compact('pangkat', 'golongan', 'jabatan', 'fungsional', 'prodi', 'bagian'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $valid = Validator::make($request->all(), [
            'nama' => 'required|string|min:4|max:40',
            'username' => 'required|string|min:4|max:20|unique:users',
            'no_pegawai' => 'required|digits_between:1,25|max:25|unique:users',
            'dosen' => 'required',
            'jabatan' => 'required'
            // 'fungsional' => 'required',
        ]);

        $valid->sometimes('fungsional', 'required', function($request){
            return $request->dosen == 1;
        });

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        // $jabfung = $request->fungsional;
        // if($jabfung == 6){
        //     $insert = ([
        //         'username' => $request->username,
        //         'password' => bcrypt("default"),
        //         'nama' => $request->nama,
        //         'no_pegawai' => $request->no_pegawai,
        //         'id_jabatan' => $request->jabatan,
        //         'id_pangkat' => 12,
        //         'id_golongan' => 5,
        //         'id_fungsional' => $request->fungsional,
        //         'is_dosen' => $request->dosen,
        //     ]);
        // }
        // else{
        // }

        $insert = ([
            'username' => $request->username,
            'password' => bcrypt("default"),
            'nama' => $request->nama,
            'no_pegawai' => $request->no_pegawai,
            'npwp' => $request->npwp,
            'is_dosen' => $request->dosen,
            'id_fungsional' => $request->fungsional,
            'jurusan' => $request->prodi,
            'id_bagian' => $request->bagian,
            'id_jabatan' => $request->jabatan,
            'id_pangkat' => $request->pangkat,
            'id_golongan' => $request->golongan,
        ]);
        User::create($insert);
        return redirect()->route('admin.pegawai.edit', $request->username)->with('success', 'Pegawai Berhasil Ditambahkan');
        // $data = User::where('username', '!=', 'admin')->paginate(10);
        // return view('admin.pegawai.index', compact('data'));

    }

    /* Search Function */
    public function search(Request $request)
    {
        $constraints = [
            // 'pangkat' => $request['pangkat'],
            // 'jabatan' => $request['jabatan'],
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
        $prodi = prodi::all();
        $bagian = bagian::all();

        $user = User::where('username', $id)->with(["fungsionalnya", "golongannya", "pangkatnya", "jabatannya"])->first();
        return view('admin/pegawai/edit', ['user' => $user, 'fungsional' => $fungsional, 'golongan' => $golongan, 'jabatan' => $jabatan, 'pangkat' => $pangkat, 'prodi' => $prodi, 'bagian' => $bagian]);
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
        $user = User::where('username', $username)->first();
        $valid = Validator::make($request->all(), [
            'no_pegawai' => ['required', 'digits_between:1,25', 'max:25',
                Rule::unique('users')->ignore($user)
            ],
            'nama' => 'required|string|min:4|max:40',
            'dosen' => 'required',
            'jabatan' => 'required'
            // 'username' => 'required|string|min:4|max:20|unique:users',
            // 'fungsional' => 'required',
        ]);

        $valid->sometimes('fungsional', 'required', function($request){
            return $request->dosen == 1;
        });

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        // $jabfung = $request->fungsional;
        // if($jabfung == 6){
        //     $users = DB::table('users')->where('username', $username)->update([
        //         'nama' => $request->nama,
        //         'is_dosen' => $request->dosen,
        //         'id_fungsional' => $request->fungsional,
        //         'id_pangkat' => 12,
        //         'id_golongan' => 5,
        //         'id_jabatan' => $request->jabatan,
        //     ]);
        // }
        // else{
        // }
        
        $user->nama = $request->nama;
        $user->no_pegawai = $request->no_pegawai;
        $user->npwp = $request->npwp;
        $user->is_dosen = $request->dosen;
        $user->id_fungsional = $request->fungsional;
        $user->jurusan = $request->prodi;
        $user->id_bagian = $request->bagian;
        $user->id_jabatan = $request->jabatan;
        $user->id_pangkat = $request->pangkat;
        $user->id_golongan = $request->golongan;
        $user->save();

        return redirect()->route('admin.pegawai.edit', $username)->with('success', 'Data Berhasil Diubah');
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
        return redirect()->back()->with('success', 'Data Pegawai Berhasil dihapus!');
    }

    public function reset($id)
    {
        $users = DB::table('users')->where('username', $id)->update([
            'password' => bcrypt("default"),
        ]);
        return redirect()->back()->with('success', 'Password '.$id.' Berhasil Direset!');
    }

    public function akademik_ganti_password()
    {
        // $data = User::all();

        return view('akademik.ganti_password');
    }
    public function kemahasiswaan_ganti_password()
    {
        // $data = User::all();

        return view('kemahasiswaan.ganti_password');
    }
    public function keuangan_ganti_password()
    {
        // $data = User::all();

        return view('keuangan.ganti_password');
    }
    public function dosen_ganti_password()
    {
        // $data = User::all();

        return view('dosen.ganti_password');
    }
    public function ormawa_ganti_password()
    {
        // $data = User::all();

        return view('ormawa.ganti_password');
    }
    public function perlengkapan_ganti_password()
    {
        // $data = User::all();

        return view('perlengkapan.ganti_password');
    }
    public function dekan_ganti_password()
    {
        // $data = User::all();

        return view('dekan.ganti_password');
    }
    public function wadek1_ganti_password()
    {
        // $data = User::all();

        return view('wadek1.ganti_password');
    }
    public function wadek2_ganti_password()
    {
        // $data = User::all();

        return view('wadek2.ganti_password');
    }
    public function ktu_ganti_password()
    {
        // $data = User::all();

        return view('ktu.ganti_password');
    }
    public function bpp_ganti_password()
    {
        // $data = User::all();

        return view('bpp.ganti_password');
    }
    public function kepegawaian_ganti_password()
    {
        // $data = User::all();

        return view('kepegawaian.ganti_password');
    }
    public function staffpim_ganti_password()
    {
        // $data = User::all();

        return view('staff_pimpinan.ganti_password');
    }
    public function admin_ganti_password()
    {
        return view('admin.ganti_password');
    }

    public function simpan_password(Request $request, $id)
    {
        $data = DB::table('users')->where('no_pegawai', $id)->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Password Berhasil Diubah!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Validation\Rule;
use App\dosen_tugas;
use App\jenis_sk;
use App\surat_kepegawaian;
use App\User;
use App\perjalanan;
use App\surat_in_out;
use App\pemateri;
use App\jenis_kendaraan;
use App\pendaftaran_acara;
use App\penginapan;
use App\bukti_perjalanan;
use App\spd;
use App\status_surat;
use Auth;
use DB;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use App\Rules\OrUploadBukti;
use App\Notifications\suratTugasKepegawaian;

class kepegawaianController extends Controller
{
    public function index()
    {   
        //Dashboard
        $memu = surat_kepegawaian::where('status', 1)->with('status_sk')->orderBy('memo_created_at', 'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();

        return view('kepegawaian.dashboard', compact('memu', 'dosen_sk', 'pemateri'));
    }

    public function create()
    {
        // $user = User::all();
        return view('kepegawaian.surat_tugas.create');
    }

    public function surat()
    {
        return view('kepegawaian.surat_tugas.index');
    }

    public function memu()
    {
        // $memu = surat_kepegawaian::where('status', 1)->get();
        $memu = surat_kepegawaian::orderBy('id', 'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();

        return view('wadek2.memu.index', compact('memu', 'dosen_sk', 'pemateri'));
    }

    public function surat_index()
    {
        $memu = surat_kepegawaian::where('status', '>=', 2)->with('status_sk')->orderBy('memo_created_at', 'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();
        return view('kepegawaian.surat_tugas.index', compact('memu', 'dosen_sk', 'pemateri'));
    }

    public function surat_create($id)
    {
        $surat = surat_kepegawaian::find($id);
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::where('id_sk', $id)->get();
        $dosen = User::where('is_dosen', '=', '1')->get();
        $pemateri = pemateri::where('id_sk', $id)->get();
 
        return view('kepegawaian.surat_tugas.create', compact('surat', 'dosen_sk', 'jenis', 'dosen', 'pemateri'));
    }

    public function surat_save(Request $request, $id)
    {
        // dd($request->all());
        $validator = validator::make($request->all(), [
            'nomor_surat' => 'required|unique:surat_kepegawaian',
            'keterangan' => 'required'
        ]);

        $validator->sometimes('biaya_pemateri', 'required', function($request){
            return $request->surat_in_out == 2;
        });

        $validator->sometimes(['jabatan_panitia', 'jabatan_panitia.*'], 'required', function($request){
            return $request->jenisSurat == 2;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $memu = ([
            'nomor_surat' => $request->nomor_surat,
            'status' => 3,
            'jenis_surat' => $request->jenisSurat,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now()
        ]);

        $data = surat_kepegawaian::where('id', $id)->first();
        $data->update($memu);

        //buat notifikasi
        $user_notif = User::with('jabatan')
        ->whereHas('jabatan', function(Builder $query)
        {
            $query->where('jabatan', 'KTU');
        })->first();
        $user_notif->notify(new suratTugasKepegawaian($data, 'butuh_verif'));

        $perjalanan = $request->perjalanan;
        $jenis = $request->jenisSurat;  
        $inout = surat_kepegawaian::where('id',$id)->first();
  
        if ($jenis==2) {
            $dosen_tugas = dosen_tugas::where('id_sk', $id)->get();
            $hitung = count($dosen_tugas);
            $dosen = dosen_tugas::where('id_sk', $id);
            $dosen->delete();

            for ($i = 0; $i < $hitung; $i++) {
                $dosen_sk = dosen_tugas::create([
                    'id_sk' => $id,
                    'id_dosen' => $request->dosen[$i],
                    'jabatan'=> $request->jabatan_panitia[$i],
                ]);
            }
        }

        if ($perjalanan == 1) {
         
            // $surat = surat_kepegawaian::find($id);

            // $jenis_kendaraan = jenis_kendaraan::all();
            // $pendaftaran_acara = pendaftaran_acara::all();
            // $penginapan = penginapan::all();
            // $dosen_tugas = dosen_tugas::where('id_sk', $id)->get();

    
            // return view('kepegawaian.surat_tugas.spd', compact('surat', 'jenis_kendaraan', 'pendaftaran_acara', 'penginapan', 'dosen_tugas'));
            return redirect()->route('kepegawaian.spd.create', $id);
        }
        else if($perjalanan == 2){
            if ($inout->surat_in_out == 2) {
                $surat = ([
                    'biaya' => $request->biaya_pemateri,
                ]);
        
                $data = pemateri::where('id_sk', $id)->update($surat);
                return redirect(route('kepegawaian.surat.preview', $id)); 
            }
            return redirect(route('kepegawaian.surat.preview', $id));
        } 
    }

    public function spd_create($id)
    {
        $surat = surat_kepegawaian::find($id);
        $jenis_kendaraan = jenis_kendaraan::all();
        $pendaftaran_acara = pendaftaran_acara::all();
        $penginapan = penginapan::all();
        $dosen_tugas = dosen_tugas::where('id_sk', $id)->get();
        
        return view('kepegawaian.surat_tugas.spd', compact('surat', 'jenis_kendaraan', 'pendaftaran_acara', 'penginapan', 'dosen_tugas'));
    }


    public function spd_save(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
            'jenis_kendaraan' => 'required',
            'asal' => 'required',
            'tujuan' => 'required',
            'uang_harian' => 'required',
            'penginapan' => 'required',
            'pendaftaran_acara' => 'required'
        ]);

        $validator->sometimes('biaya_penginapan', 'required', function($request){
            return $request->penginapan == 1;
        });

        $validator->sometimes('biaya_pendaftaran', 'required', function($request){
            return $request->pendaftaran_acara == 1;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dosen = dosen_tugas::where('id_sk', $id)->get();
        $spd = ([
            'id_sk' => $id,
            'id_jenis_kendaraan' => $request->jenis_kendaraan,
            'asal' => $request->asal,
            'tujuan' => $request->tujuan,
            'uang_harian' => $request->uang_harian,
            'id_penginapan' => $request->penginapan,
            'biaya_penginapan' => $request->biaya_penginapan,
            'id_pendaftaran' => $request->pendaftaran_acara,
            'biaya_pendaftaran_acara' => $request->biaya_pendaftaran,
        ]);

        $data = spd::create($spd);
        return redirect()->route('kepegawaian.surat.preview', $id);
    }

    public function ktu_memu()
    {
        $memu = surat_kepegawaian::where('status', 1)->orderBy('memo_created_at', 'desc')->get();
        $memus = surat_kepegawaian::where('status', '>=', 2)->orderBy('memo_created_at', 'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();
        $perjalanan = perjalanan::all();
        $inout = surat_in_out::all();
        // dd($memus);
        return view('ktu.memu.index', compact('memu', 'memus', 'dosen_sk', 'pemateri', 'perjalanan', 'inout'));
    }

    public function cekMemoBaru()
    {
        $jumlah_memo = surat_kepegawaian::where('status', 1)->count();
        echo $jumlah_memo;
    }

    public function ktu_approve($id)
    {
        $memu = ([
            'status' => 2,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($memu);
        return redirect()->back()->with('success', 'Memo Berhasil Disetujui');
    }

    public function sp_index()
    {
        $surat = surat_kepegawaian::where('status', 5)->orderBy('created_at', 'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();
        return view('staff_pimpinan.surat_tugas.index', compact('surat', 'dosen_sk','pemateri'));
    }

    public function sp_read()
    {
        $surat_tugas = surat_kepegawaian::where('status', '>=', 5)->orderBy('created_at', 'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();
        return view('staff_pimpinan.surat_tugas.read', compact('surat_tugas', 'dosen_sk','pemateri'));
    }

    public function createMemu()
    {
        $user = User::where('is_dosen', '=', '1')->get();
        $jenis = jenis_sk::all();
        $surat = surat_in_out::all();
        $perjalanan = perjalanan::all();
        return view('wadek2.memu.create', compact('user', 'jenis', 'surat', 'perjalanan'));
    }

    public function editMemu($id)
    {
        $surat = surat_kepegawaian::find($id);
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::where('id_sk', $id)->get();
        $dosen = User::where('is_dosen', '=', '1')->get();
        $inout = surat_in_out::all();
        $perjalanan = perjalanan::all();
        $pemateri = pemateri::where('id_sk', $id)->get();

        return view('wadek2.memu.edit', compact('surat', 'dosen_sk', 'jenis', 'dosen', 'pemateri', 'perjalanan', 'inout'));
    }

    public function saveMemu(Request $request)
    {
        // dd(Carbon::now()->format('Y-m-d H:i:s'));
        $validator = validator::make($request->all(), [
            'surat_in_out' => 'required',
            'keterangan' => 'required',
            'started_at' => 'required',
            'end_at' => 'required'
        ]);

        $validator->sometimes('jenisSurat', 'required', function($request){
            return $request->surat_in_out == 1;
        });

        $validator->sometimes(['dosen', 'dosen.*'], 'required', function($request){
            return $request->surat_in_out == 1;
        });

        $validator->sometimes(['pemateri', 'pemateri.*'], 'required', function($request){
            return $request->surat_in_out == 2;
        });

        $validator->sometimes('lokasi', 'required', function($request){
            return $request->perjalanan == 1;
        });

        $validator->sometimes('instansi', 'required', function($request){
            return $request->surat_in_out == 2;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $start = $request->started_at;
        $end = $request->end_at;

        $start_date = Carbon::parse($start);
        $start_date->format('d-m-Y');
        $end_date = Carbon::parse($end);
        $end_date->format('d-m-Y');
        $inout = $request->surat_in_out;
        $jalan = $request->perjalanan;
        if ($inout == 1 && $jalan == 2) {
            $insert = ([
                'nomor_surat' => null,
                'jenis_surat' => $request->jenisSurat,
                'keterangan' => $request->keterangan,
                'started_at' => $start_date,
                'end_at' => $end_date,
                'status' => 1,
                'surat_in_out' => 1,
                'perjalanan' => 2,
                'lokasi' => 'Universitas Jember',
                'memo_created_at' => Carbon::now(),
            ]);
            $data = surat_kepegawaian::create($insert);
    
            $dosen = $request->dosen;

            for ($i = 0; $i < count($dosen); $i++) {
                $dosen_sk = dosen_tugas::create([
                    'id_sk' => $data->id,
                    'id_dosen' => $request->dosen[$i],
                ]);
            } 
        }
        else if ($inout == 1 && $jalan == 1) {
            $insert = ([
                'nomor_surat' => null,  
                'jenis_surat' => $request->jenisSurat,
                'keterangan' => $request->keterangan,
                'started_at' => $start_date,
                'end_at' => $end_date,
                'status' => 1,
                'surat_in_out' => 1,
                'perjalanan' => 1,
                'lokasi' => $request->lokasi,
                'memo_created_at' => Carbon::now(),
            ]);
            $data = surat_kepegawaian::create($insert);
    
            $dosen = $request->dosen;

            for ($i = 0; $i < count($dosen); $i++) {
                $dosen_sk = dosen_tugas::create([
                    'id_sk' => $data->id,
                    'id_dosen' => $request->dosen[$i],
                ]);
            } 
        }
        else if ($inout == 2){
            // dd($request->all());
            $insert = ([
                'nomor_surat' => null,  
                'jenis_surat' => 3,
                'keterangan' => $request->keterangan,
                'started_at' => $start_date,
                'end_at' => $end_date,
                'status' => 1,
                'surat_in_out' => 2,
                'perjalanan' => 2,
                'lokasi' => 'Universitas Jember',
                'memo_created_at' => Carbon::now(),
            ]);
            $pemateri = $request->pemateri;
            $data = surat_kepegawaian::create($insert);

            for ($i=0; $i < count($pemateri) ; $i++) { 
                $pemateri_sk = pemateri::create([
                    'id_sk' => $data->id,
                    'nama' => $request->pemateri[$i],
                    'instansi' => $request->instansi,
                ]);
            }
        }
        return redirect()->route('wadek2.memu.index')->with('success', 'Memo Berhasil Dibuat');
    }

    public function updateMemu(Request $request, $id)
    {
        // dd($request->all());
        $validator = validator::make($request->all(), [
            'keterangan' => 'required',
            'started_at' => 'required',
            'end_at' => 'required'
        ]);

        $validator->sometimes('jenisSurat', 'required', function($request){
            return $request->surat_in_out == 1;
        });

        // $validator->sometimes(['dosen', 'dosen.*'], 'required', function($request){
        //     return $request->surat_in_out == 1;
        // });

        $validator->sometimes(['pemateri','pemateri.*'], 'required', function($request){
            return $request->surat_in_out == 2;
        });

        $validator->sometimes('lokasi', 'required', function($request){
            return $request->perjalanan == 1;
        });

        $validator->sometimes('instansi', 'required', function($request){
            return $request->surat_in_out == 2;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $start = $request->started_at;
        $end = $request->end_at;

        $start_date = Carbon::parse($start);
        $start_date->format('d-m-Y');
        $end_date = Carbon::parse($end);
        $end_date->format('d-m-Y');

        $memu = ([
            'nomor_surat' => null,
            'jenis_surat' => $request->jenisSurat,
            'keterangan' => $request->keterangan,
            'lokasi' => $request->lokasi,
            'started_at' => $start_date,
            'end_at' => $end_date,
            'status' => 1,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($memu);
        $dosen = $request->dosen;
        $pemateri = $request->pemateri;
        if ($request->surat_in_out == 2) {
            if (!is_null($pemateri)) {
                $hitung = count($pemateri); 
                $pemateri = pemateri::where('id_sk', $id);
                $pemateri->delete();

                for ($i=0; $i < $hitung ; $i++) { 
                    $pemateri_sk = pemateri::create([
                        'id_sk' => $id,
                        'nama' => $request->pemateri[$i],
                        'instansi' => $request->instansi
                    ]);
                }
            }
        } else {
            if(!is_null($dosen)){
                $hitung = count($dosen);
                $dosen = dosen_tugas::where('id_sk', $id);
                $dosen->delete();

                for ($i = 0; $i < $hitung; $i++) {
                    $dosen_sk = dosen_tugas::create([
                        'id_sk' => $id,
                        'id_dosen' => $request->dosen[$i],
                    ]);
                }
            }
            

        }   
        return redirect()->route('wadek2.memu.index');
    }

    public function deleteMemu($id)
    {
        $dosen = dosen_tugas::where('id_sk', $id);
        $surat = surat_kepegawaian::find($id);
        $dosen->delete();
        $surat->delete();

        return redirect()->back();
    }

    public function read()
    {
        $surat_tugas = surat_kepegawaian::where('status', 3)->get();
        $dosen_sk = dosen_tugas::all();

        $jabatan_user = $this->cek_jabatan();
        return view('kepegawaian.surat_tugas.read', compact('surat_tugas', 'dosen_sk', 'jabatan_user'));
    }

    //KTU Surat Tugas
    public function read_ktu()
    {
        $surat_tugas = surat_kepegawaian::all();
        $dosen_sk = dosen_tugas::all();
        $pemateri= pemateri::all();
        return view('ktu.surat_tugas.read', compact('surat_tugas', 'dosen_sk','pemateri'));
    }

    public function ktu_surat()
    {
        $surat = surat_kepegawaian::where('status', '>=', 3)->with('status_sk')->orderBy('created_at' ,'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri= pemateri::all();
        return view('ktu.surat_tugas.index', compact('surat', 'dosen_sk','pemateri'));
    }

    public function ktu_surat_approve($id)
    {
        $memu = ([
            'status' => 5,
        ]);

        $data = surat_kepegawaian::where('id', $id)->first();
        $data->update($memu);

        $user_notif = User::with('jabatan')
        ->whereHas('jabatan', function(Builder $query)
        {
            $query->where('jabatan', 'Sekretaris Pimpinan');
        })->first();
        $user_notif->notify(new suratTugasKepegawaian($data, 'butuh_verif'));

        return redirect()->back()->with('success', 'Surat tugas berhasil diverifikasi');
    }

    public function ktu_surat_reject(Request $request, $id)
    {
        $this->validate($request, [
            'pesan_revisi' => 'required'
        ]);

        $sk = ([
            'status' => 4,
            'revisi' => $request->pesan_revisi,
        ]);

        $data = surat_kepegawaian::where('id', $id)->first();
        // $data->status = 4;
        // $data->revisi = $request->pesan_revisi;
        $data->update($sk);

        $user_notif = User::with('jabatan')
        ->whereHas('jabatan', function(Builder $query)
        {
            $query->where('jabatan', 'Pemroses Mutasi Kepegawaian');
        })->first();
        $user_notif->notify(new suratTugasKepegawaian($data, 'butuh_revisi_ktu'));

        return redirect()->route('ktu.surat.index')->with('success', 'Status Surat Tugas Berhasil Diubah');
    }

    public function reject_view($id)
    {
        $surat = surat_kepegawaian::find($id);
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::where('id_sk', $id)->get();
        $pemateri = pemateri::where('id_sk', $id)->get();

        return view('ktu.surat_tugas.reject', compact('surat', 'dosen_sk', 'jenis', 'pemateri'));
    }

    //PDF
    public function kepegawaian_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $spd = spd::where('id_sk', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $pemateri = pemateri::all();
        $pematerinya = pemateri::where('id_sk', $id)->get();
        $jumlah = count($pematerinya);
     
      return view('kepegawaian.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
        'spd' => $spd,
        'dosen_tugas' => $dosen_tugas,
        'pematerinya' => $pematerinya,
        'pemateri' => $pematerinya,
        'jumlah' => $jumlah
      ]);
    }

    public function sp_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $spd = spd::where('id_sk', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $pemateri = pemateri::all();
        $pematerinya = pemateri::where('id_sk', $id)->get();
        $jumlah = count($pematerinya);
     
      return view('staff_pimpinan.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
        'spd' => $spd,
        'dosen_tugas' =>$dosen_tugas,
        'pemateri' => $pemateri,
        'pematerinya' => $pematerinya,
        'jumlah' => $jumlah
      ]);
    }

    public function sp_surat_approve($id)
    {
        $memu = ([
            'status' => 7,
        ]);

        $data = surat_kepegawaian::where('id', $id)->first();
        $data->update($memu);

        $user_notif = User::with('jabatan')
        ->whereHas('jabatan', function(Builder $query)
        {
            $query->where('jabatan', 'Wakil Dekan 2');
        })->first();
        $user_notif->notify(new suratTugasKepegawaian($data, 'butuh_verif'));

        return redirect()->route('staffpim.sp.preview', $id)->with('success', 'Surat Tugas Berhasil Diverifikasi');
    }

    public function sp_surat_reject(Request $request, $id)
    {
        $this->validate($request, [
            'pesan_revisi' => 'required'
        ]);
        $sk = ([
            'status' => 6,
            'revisi' => $request->pesan_revisi,
        ]);

        $data = surat_kepegawaian::where('id', $id)->first();
        $data->update($sk);

        $user_notif = User::with('jabatan')
        ->whereHas('jabatan', function(Builder $query)
        {
            $query->where('jabatan', 'Pemroses Mutasi Kepegawaian');
        })->first();
        $user_notif->notify(new suratTugasKepegawaian($data, 'butuh_revisi_staffpim'));

        return redirect()->route('staffpim.sp.read')->with('success', 'Status Surat Tugas Berhasil Diubah');
    }

    public function sp_reject_view($id)
    {
        $surat = surat_kepegawaian::find($id);
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::where('id_sk', $id)->get();
        $pemateri = pemateri::where('id_sk', $id)->get();

        return view('staff_pimpinan.surat_tugas.reject', compact('surat', 'dosen_sk', 'jenis', 'pemateri'));
    }

    public function wadek2_surat_index()
    {
        // $surat = surat_kepegawaian::where('status', 7)->get();
        $surat = surat_kepegawaian::where('status', '>=', 7)->with('status_sk')->orderBy('created_at', 'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();

        $surat2 = surat_kepegawaian::where('status', 8)->get();
        return view('wadek2.surat_tugas.index', compact('surat', 'surat2', 'dosen_sk', 'pemateri'));
    }

    public function wadek2_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $spd = spd::where('id_sk', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $pemateri = pemateri::all();
        $pematerinya= pemateri::where('id_sk', $id)->get();
        $jumlah = count($pematerinya);

        // dd($dosen_tugas);
        $self_check = false;
        $no_pegawai = Auth::user()->no_pegawai;
        foreach($dosen_tugas as $dt){
            if ($no_pegawai == $dt->id_dosen) {
                $self_check = true;
                break;
            }
        }
        $jabatan_user = $this->cek_jabatan();

      return view('wadek2.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
        'spd' => $spd,
        'dosen_tugas' =>$dosen_tugas,
        'pemateri' => $pemateri,
        'pematerinya' => $pematerinya,
        'jumlah' => $jumlah,
        'self_check' => $self_check,
        'jabatan_user' => $jabatan_user
      ]);
    }

    public function wadek2_surat_approve($id)
    {
        $surat = ([
            'status' => 8,
        ]);

        $data = surat_kepegawaian::where('id', $id)->first();
        $data->update($surat);

        $user_notif = User::with('jabatan')
        ->whereHas('jabatan', function(Builder $query)
        {
            $query->where('jabatan', 'BPP');
        })->first();
        $user_notif->notify(new suratTugasKepegawaian($data, 'butuh_verif'));

        return redirect()->route('wadek2.surat.preview', $id)->with('success', 'Surat Tugas Berhasil Diverifikasi');
    }

    public function kepegawaian_cetak()
    {
        $surat = surat_kepegawaian::where('status', 8)->get();
        $dosen_sk = dosen_tugas::all();
        return view('kepegawaian.surat_tugas.print', compact('surat', 'dosen_sk'));
    }

    public function ktu_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $spd = spd::where('id_sk', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $pemateri = pemateri::all();
        $pematerinya = pemateri::where('id_sk', $id)->get();
        $jumlah = count($pematerinya);
     
      return view('ktu.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' =>$dosen_tugas,
        'pemateri' => $pemateri,
        'pematerinya' => $pematerinya,
        'spd' => $spd,
        'jumlah' => $jumlah,
      ]);
    }

    public function cetak_pdf1($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $wadek2 = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Wakil Dekan 2");
        })->first();

        $pdf = PDF::loadview('template_print.print1', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas, 'wadek2' => $wadek2])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Peserta_Acara-" . $surat_tugas->nomor_surat . ".pdf");
    }
    public function cetak_pdf2($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $spd = spd::where('id_sk',$id)->first();
        $wadek2 = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Wakil Dekan 2");
        })->first();

        $pdf = PDF::loadview('template_print.print2', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas, 'spd' => $spd, 'wadek2' => $wadek2])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Panitia_Kegiatan-" . $surat_tugas->no_surat . ".pdf");
    }
    public function cetak_pdf3($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $pemateri = pemateri::where('id_sk', $id)->get();
        $wadek2 = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Wakil Dekan 2");
        })->first();

        $pdf = PDF::loadview('template_print.print3', ['surat_tugas' => $surat_tugas, 'pemateri' => $pemateri, 'wadek2' => $wadek2])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Pemateri-" . $surat_tugas->no_surat . ".pdf");
    }
  

    public function revisi()
    {
        $surat = surat_kepegawaian::where('status', 4)->orWhere('status', 6)->get();
        $dosen_sk = dosen_tugas::all();
        return view('kepegawaian.surat_tugas.revisi', compact('surat', 'dosen_sk'));
    }

    public function edit_sk($id)
    {
        $surat = surat_kepegawaian::find($id);
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::where('id_sk', $id)->with('user')->get();
        $dosen = User::where('is_dosen', '=', '1')->get();
        $inout = surat_in_out::all();
        $perjalanan = perjalanan::all();
        $pemateri = pemateri::where('id_sk', $id)->get();
        $id_dosen_tugas = array();
        foreach ($dosen_sk as $key) {
            $id_dosen_tugas[] = $key->id_dosen;
        }
        // dd($id_dosen_tugas);
        return view('kepegawaian.surat_tugas.edit', ['surat' => $surat, 'dosen_sk' => $dosen_sk, 'jenis' => $jenis, 'dosen' => $dosen, 'pemateri' => $pemateri, 'perjalanan' => $perjalanan, 'inout' => $inout, 'id_dosen_tugas' => $id_dosen_tugas]);
    }

    public function surat_revisian(Request $request, $id)
    {
        // dd($request->all());
        $validator = validator::make($request->all(), [
            'jenisSurat' => 'required',
            'keterangan' => 'required',
            'start_date' => 'started_at',
            'end_date' => 'end_at'
        ]);

        $validator->sometimes(['dosen','dosen.*'], 'required', function($request){
            return $request->surat_in_out == 1;
        });

        $validator->sometimes(['pemateri','pemateri.*'], 'required', function($request){
            return $request->surat_in_out == 2;
        });

        $validator->sometimes(['jabatan_panitia','jabatan_panitia.*'], 'required', function($request){
            return $request->jenisSurat == 2;
        });

        $validator->sometimes('biaya_pemateri', 'required', function($request){
            return $request->surat_in_out == 2;
        });

        $validator->sometimes('lokasi', 'required', function($request){
            return $request->perjalanan == 1;
        });

        $validator->sometimes('instansi', 'required', function($request){
            return $request->surat_in_out == 2;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $start = $request->started_at;
        $end = $request->end_at;

        $start_date = Carbon::parse($start);
        $start_date->format('d-m-Y');
        $end_date = Carbon::parse($end);
        $end_date->format('d-m-Y');

        $surat = ([
            // 'nomor_surat' => null,
            'jenis_surat' => $request->jenisSurat,
            'keterangan' => $request->keterangan,
            'lokasi' => $request->lokasi,
            'started_at' => $start_date,
            'end_at' => $end_date,
            'status' => 3,
        ]);

        $data = surat_kepegawaian::where('id', $id)->first();
        $data->update($surat);

        $user_notif = User::with('jabatan')
        ->whereHas('jabatan', function(Builder $query)
        {
            $query->where('jabatan', 'KTU');
        })->first();
        $user_notif->notify(new suratTugasKepegawaian($data, 'butuh_verif'));

        $dosen = $request->dosen;
        $pemateri = $request->pemateri;
        if ($request->surat_in_out == 2) {
            // if ($hitung > 0) {
        			$hitung = count($pemateri); 
               $pemateri = pemateri::where('id_sk', $id);
               $pemateri->delete();
    
               for ($i=0; $i < $hitung ; $i++) { 
                    $pemateri_sk = pemateri::create([
                        'id_sk' => $id,
                        'nama' => $request->pemateri[$i],
                        'instansi' => $request->instansi,
                        'biaya' => $request->biaya_pemateri
                    ]);
               }
            // }
        } else {
            $hitung = count($dosen);
            $dosen = dosen_tugas::where('id_sk', $id);
            $dosen->delete();

            for ($i = 0; $i < $hitung; $i++) {
                $dosen_sk = dosen_tugas::create([
                    'id_sk' => $id,
                    'id_dosen' => $request->dosen[$i],
                    'jabatan' => $request->jabatan_panitia[$i]
                ]);
            }

        }   
        return redirect()->route('kepegawaian.surat.preview', $id)->with('success', 'Surat Tugas Berhasil Diubah');
    }

    //BPP
    public function bpp_index()
    {
        $surat = surat_kepegawaian::whereIn ('status', [8,9])->with('status_sk')->orderBy('created_at', 'desc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();

        return view('bpp.surat_tugas.index', compact('surat', 'dosen_sk', 'pemateri'));
    }

    public function bpp_spd_index()
    {
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();
        // $surat = DB::table('spd')->join('surat_kepegawaian', 'surat_kepegawaian.id' , '=', 'spd.id_sk')->join('status_surat', 'status_surat.id' , '=', 'surat_kepegawaian.status')
        // ->where('surat_kepegawaian.status', '>=', 10)->get();
        $jenis = jenis_sk::all();

        $surat = spd::with('surat_tugas.status_sk')
        ->whereHas('surat_tugas', function(Builder $query){
        	$query->where('status', '>=', 10);
        })->orderBy('created_at', 'desc')->get();
        
        // dd($surat_kepeg);
        return view('bpp.surat_tugas.spd', compact('surat', 'dosen_sk', 'pemateri', 'jenis'));
    }

    public function bpp_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $id)->get();
        $pemateri = pemateri::where('id_sk', $id)->get();
        $spd = spd::where('id_sk', $id)->first();
        $pematerinya= pemateri::where('id_sk', $id)->get();
        $jumlah = count($pematerinya);

      return view('bpp.surat_tugas.preview_surat', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' =>$dosen_tugas,
        'pemateri' => $pemateri,
        'spd' => $spd,
        'pematerinya' => $pematerinya,
        'jumlah' => $jumlah
      ]);
    }

    public function bpp_spd_preview($id)
    {
        $surat_tugas = DB::table('spd')->join('surat_kepegawaian', 'surat_kepegawaian.id' , '=', 'spd.id_sk')
        ->where('spd.id_spd', $id)->first();
        $id_sk = $surat_tugas->id;
        $dosen_tugas = dosen_tugas::where('id_sk', $id_sk)->get();
        $jenis = jenis_sk::all();
        $status = status_surat::all();
        $bukti = bukti_perjalanan::where('id_spd', $id)->get();
        // dd($bukti);
        return view('bpp.surat_tugas.preview_spd', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' =>$dosen_tugas,
        'jenis' => $jenis,
        'status' => $status,
        'bukti' => $bukti,
      ]);
    }

    public function download_bukti($id,$index,$jenis_bukti)
    {
        $pathToFile;
        $type;
        $ext;
        $bukti = bukti_perjalanan::where('id', $id)->first();
        switch ($jenis_bukti) {
            case 1:
              $pathToFile = $bukti->transportasi[$index][1];
              $ext = $bukti->transportasi[$index][2];
              $type='transportasi';
              break;
            case 2:
              $pathToFile = $bukti->pendaftaran[$index][1];
              $ext = $bukti->pendaftaran[$index][2];
              $type='pendaftaran';
              break;
            case 3:
              $pathToFile = $bukti->penginapan[$index][1];
              $ext = $bukti->penginapan[$index][2];
              $type='penginapan';
              break;
          }
        return Storage::download($pathToFile, 'bukti'.$type.'$index'.'.'.$ext);
    }
    
    public function bpp_selesai($id)
    {
        $surat = ([
            'status' => 11,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($surat);
        return redirect()->back()->with('success', 'Surat Perjalanan Dinas telah Selesai!');
    }

    public function bpp_approve($id)
    {
        $surat = ([
            'status' => 9,
        ]);

        $data = surat_kepegawaian::where('id', $id)->first();
        $data->update($surat);

        if ($data->surat_in_out == 1) {
            $dosen_tugas = dosen_tugas::where('id_sk', $id)->with('user')->get();
            foreach ($dosen_tugas as $item) {
                $item->user->notify(new suratTugasKepegawaian($data, 'sudah_siap'));
            }
        }

        return redirect()->route('bpp.surat.preview', $id)->with('success', 'Surat Tugas Berhasil Disetujui');
    }

    //Dosen
    public function dosen_index()
    {
        $user = Auth::user()->no_pegawai;
        // $dengan_spd = DB::table('spd')->join('surat_kepegawaian', 'spd.id_sk' , '=', 'surat_kepegawaian.id')->join('dosen_tugas','dosen_tugas.id_sk','=','surat_kepegawaian.id')
        // ->where('surat_kepegawaian.status', 9)->where('dosen_tugas.id_dosen', $user)->get();
        // $tanpa_spd = DB::table('dosen_tugas')->join('surat_kepegawaian', 'dosen_tugas.id_sk' , '=', 'surat_kepegawaian.id')
        // ->where('surat_kepegawaian.status', 9)->where('dosen_tugas.id_dosen', $user)->get();
        // if (count($dengan_spd) > 0) {
        //     $surat_tugas = $dengan_spd;
        // } else {
        //     $surat_tugas = $tanpa_spd;
        // }

        $tugas_dosen = dosen_tugas::where('id_dosen', $user)->with([
            'surat_tugas',
            'surat_tugas.status_sk'
        ])->whereHas('surat_tugas', function(Builder $query){
            $query->where('status', '>=', 9);
        })->get();
        // dd($tugas_dosen);

        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::all();
        // $dosen = User::all();

        $jabatan_user = $this->cek_jabatan();
        
        // dd($surat_tugas);
        return view('dosen.surat_tugas.index', [
        'tugas_dosen' => $tugas_dosen,
        'dosen_sk' => $dosen_sk,
        'jenis' => $jenis,
        'jabatan_user' => $jabatan_user
        ]);
    }

    public function dosen_index_upload()
    {
        $user = Auth::user()->no_pegawai;
        $surat_tugas = DB::table('spd')->join('surat_kepegawaian', 'spd.id_sk' , '=', 'surat_kepegawaian.id')->join('dosen_tugas','dosen_tugas.id_sk','=','surat_kepegawaian.id')
        ->where('surat_kepegawaian.status', 9)->where('dosen_tugas.id_dosen', $user)->get();
        $surat_tugas2 = DB::table('spd')->join('surat_kepegawaian', 'spd.id_sk' , '=', 'surat_kepegawaian.id')->join('dosen_tugas','dosen_tugas.id_sk','=','surat_kepegawaian.id')
        ->where('surat_kepegawaian.status', 10)->where('dosen_tugas.id_dosen', $user)->get();
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::all();
        $dosen = User::all();
        $pemateri = pemateri::all();
        // $id = DB::table('spd')->join('surat_tugas', 'spd.id_sk' , '=', 'surat_tugas.id')->join('dosen_tugas','dosen_tugas.id_sk','=','surat_tugas.id')
        // ->where('surat_tugas.status', 9)->where('dosen_tugas.id_dosen', $user)->select('spd.id')->get();

        $jabatan_user = $this->cek_jabatan();
      
        return view('dosen.surat_tugas.upload', [
        'surat_tugas' => $surat_tugas,
        'dosen_sk' => $dosen_sk,
        'pemateri' => $pemateri,
        'jenis' => $jenis,
        'surat_tugas2' => $surat_tugas2,
        'jabatan_user' => $jabatan_user
        ]);
    }

    public function dosen_edit_upload($id)
    {
        $espede = DB::table('spd')->join('surat_kepegawaian', 'spd.id_sk' , '=', 'surat_kepegawaian.id')->join('dosen_tugas','dosen_tugas.id_sk','=','surat_kepegawaian.id')
        ->where('spd.id_spd', $id)->first();
        $spd = spd::where('id_spd', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $spd->id_sk)->get();
        $id_sk = $espede->id_sk;
        $bukti = bukti_perjalanan::where('id_spd',$id)->first();

        $jabatan_user = $this->cek_jabatan();
        

        return view('dosen.surat_tugas.edit_upload', [
        'spd' => $spd,
        'dosen_tugas' => $dosen_tugas,
        'jabatan_user' => $jabatan_user,
        'bukti'=> $bukti
       
      ]);
     
       
    //     $dosen_tugas = dosen_tugas::where('id_sk', $id_sk)->get();
    
    //     return view('dosen.surat_tugas.edit_upload', [
    
    //     'dosen_tugas' => $dosen_tugas,
    //     'spd' => $spd,
    //   ]);
    }

    public function dosen_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $id)->get();
        $spd = spd::where('id_sk', $id)->first();

        $jabatan_user = $this->cek_jabatan();
    
      return view('dosen.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' => $dosen_tugas,
        'spd' => $spd,
        'jabatan_user' => $jabatan_user
      ]);
    }

    public function dosen_upload_preview($id)
    {
        $spd = spd::where('id_spd', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $spd->id_sk)->get();

        $jabatan_user = $this->cek_jabatan();

      return view('dosen.surat_tugas.preview_upload', [
        'spd' => $spd,
        'dosen_tugas' => $dosen_tugas,
        'jabatan_user' => $jabatan_user
      ]);
    }
    
    public function dosen_cetak1($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $wadek2 = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Wakil Dekan 2");
        })->first();

        $pdf = PDF::loadview('template_print.print1', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas, 'wadek2' => $wadek2])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Peserta_Acara-" . $surat_tugas->nomor_surat . ".pdf");
    }

    public function dosen_cetak2($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $spd = spd::where('id_sk', $id)->first();
        $wadek2 = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Wakil Dekan 2");
        })->first();

        $pdf = PDF::loadview('template_print.print2', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas, 'spd' => $spd, 'wadek2' => $wadek2])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Panitia_Kegiatan-" . $surat_tugas->no_surat . ".pdf");
    }

    public function dosen_cetak_spd($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $spd = spd::where('id_sk', $id)->first();
        // $terbit = Carbon::now()->locale('id_ID');
        $terbit = $spd->created_at;
        $dekan = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Dekan");
        })->first();

        $pdf = PDF::loadview('template_print.spd1', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas, 'spd' => $spd, 'terbit' => $terbit, 'dekan' => $dekan])->setPaper('legal', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Panitia_Kegiatan-" . $surat_tugas->no_surat . ".pdf");
    }


    public function dosen_upload($id){
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $id)->get();
        $spd = spd::where('id_sk', $id)->first();

      return view('dosen.surat_tugas.preview_upload', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' => $dosen_tugas,
        'spd' => $spd,
      ]);
    }

    public function dosen_store(Request $request, $id)
    {

        $error = [
             'transportasi' => 'Salah Satu Bukti Harus Diisi.',
             'penginapan' => 'Salah Satu Bukti Harus Diisi.',
             'pendaftaran' => 'Salah Satu Bukti Harus Diisi.'
        ];
        $this->validate($request, [
                'transportasi' => 'required_without_all:penginapan,pendaftaran|max:1024',
                'penginapan' => 'required_without_all:transportasi,pendaftaran|max:1024',
                'pendaftaran' => 'required_without_all:penginapan,transportasi|max:1024',
                'transportasi.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx',
                'penginapan.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx',
                'pendaftaran.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx'
        ],$error);

        $transportasi = null;
        $penginapan = null;
        $pendaftaran = null;
        $t=0;       
        $g=0;
        $d=0;
        if($request->transportasi !=null)
        {
            try{
                $transportasi = $this->upload_bukti($request->file('transportasi'));
                $t=1;
            }catch(Exception $e){
                return redirect()->route($jabatan.'.file.upload')->with('error', $e->getMessage());
            }
        }
        if($request->penginapan !=null)
        {
            try{
                $penginapan = $this->upload_bukti($request->file('penginapan'));
                $g=1;
            }catch(Exception $e){
                return redirect()->route($jabatan.'.file.upload')->with('error', $e->getMessage());
            }
            
        }
        if($request->pendaftaran !=null)
        {
            try{
                $pendaftaran = $this->upload_bukti($request->file('pendaftaran'));
                $d=1;
            }catch(Exception $e){
                return redirect()->route($jabatan.'.file.upload')->with('error', $e->getMessage());
            }
            
        }

        $time = Carbon::now();
        $user = Auth::user()->no_pegawai; 
        try{
            $data = bukti_perjalanan::create([
                'id_spd' => $id,
                'transportasi' => $transportasi,
                'penginapan' => $penginapan,
                'pendaftaran' => $pendaftaran,
                'pake_transportasi' => $t,
                'pake_pendaftaran' => $d,
                'pake_penginapan' => $g,
                'uploaded_at' => $time,
                'id_user' => $user
            ]);
        
            $surat = ([
                'status' => 10,
            ]);

            $id_surat = spd::where('id_spd',$id)->first();
            
            $data = surat_kepegawaian::where('id', $id_surat->id_sk)->first();
            $data->update($surat);

            $user_notif = User::with('jabatan')
            ->whereHas('jabatan', function(Builder $query)
            {
                $query->where('jabatan', 'BPP');
            })->first();
            $user_notif->notify(new suratTugasKepegawaian($data, 'sudah_upload_bukti'));

        }catch(Exception $e){
            return redirect()->route($jabatan.'.edit.upload')->with('error', $e->getMessage());
        }
 
        return back()->with('success', 'Data berhasil diupload!');

    }

    protected function dosen_update_upload(Request $request, $id){
        
        $jabatan_user = $this->cek_jabatan();
        $this->validate($request, [
            'transportasi' => 'max:1024',
            'penginapan' => 'max:1024',
            'pendaftaran' => 'max:1024',
            'transportasi.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx',
            'penginapan.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx',
            'pendaftaran.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx'
        ]);

        $bukti = bukti_perjalanan::where('id', $id)->first();

        $transportasi = array();
        $penginapan = array();
        $pendaftaran = array();

        if($bukti->pake_transportasi == 1)
        {
            
            if($request->transportasi !=null){
                $transportasiLama = $this->update_bukti_lama($bukti,$request->deleteTransportasi,1);
                $transportasi = $this->update_bukti($transportasiLama,$request->file('transportasi'));
            }else {
                $transportasi = $this->update_bukti_lama($bukti,$request->deleteTransportasi,1);
            }
                
        }
        if($bukti->pake_penginapan == 1)
        {
            if($request->penginapan !=null){
                $penginapanLama = $this->update_bukti_lama($bukti,$request->deletePenginapan,3);
                $penginapan = $this->update_bukti($penginapanLama,$request->file('penginapan'));
            }else{
                $penginapan = $this->update_bukti_lama($bukti,$request->deletePenginapan,3);
            }
        }
        if($bukti->pake_pendaftaran == 1)
        {
            
            if($request->pendaftaran !=null){
                $pendaftaranLama = $this->update_bukti_lama($bukti,$request->deletePendaftaran,2);
                $pendaftaran = $this->update_bukti($pendaftaranLama,$request->file('pendaftaran'));
            }else{
                $pendaftaran = $this->update_bukti_lama($bukti,$request->deletePendaftaran,2);
            }
        }
        
        try{
            bukti_perjalanan::find($id)->update([
                'transportasi' => $transportasi,
                'penginapan' => $penginapan,
                'pendaftaran' => $pendaftaran
            ]);

            $spd = spd::where('id_spd', $bukti->id_spd)->with('surat_tugas')->first();
            
            $user_notif = User::with('jabatan')
            ->whereHas('jabatan', function(Builder $query)
            {
                $query->where('jabatan', 'BPP');
            })->first();
            $user_notif->notify(new suratTugasKepegawaian($spd->surat_tugas, 'sudah_upload_bukti'));

        }catch(Exception $e){
            return redirect()->route($jabatan.'.edit.upload')->with('error', $e->getMessage());
        }

        return back()->with('success', 'Data berhasil diubah');
    }

    protected function update_bukti_lama($buktiDB, $isDeleted, $jenis_bukti){
        $notDeleted = array();
        if($isDeleted != null){
            $panjangData = count($isDeleted);
            for($i=0;$i<$panjangData;$i++){
                if($isDeleted[$i] == 0 ){
                    switch ($jenis_bukti) {
                        case 1:
                        $temp = $buktiDB->transportasi[$i];
                        break;
                        case 2:
                        $temp = $buktiDB->pendaftaran[$i];
                        break;
                        case 3:
                        $temp = $buktiDB->penginapan[$i];
                        break;
                    }
                    
                    try{
                        Storage::delete($temp[1]);
                    }catch(Exception $e){
                        return redirect()->route($jabatan.'.edit.upload')->with('error', $e->getMessage());
                    }
                    array_push($notDeleted,$temp);
                }
            }
        }

        return $notDeleted;
    }

    protected function update_bukti($bukti, $file){
        foreach($file as $f)
            {
                $name = array();
                $ext= $f->getClientOriginalExtension();
                array_push($name,$f->getClientOriginalName());
                $path =Storage::putFile('Bukti', $f);
                array_push($name,$path);
                array_push($name,$ext);
                array_push($bukti,$name);
            }
        return $bukti;
    }

    protected function upload_bukti($file){
        $bukti = array();
        foreach($file as $f)
            {
                $name = array();
                $ext= $f->getClientOriginalExtension();
                array_push($name,$f->getClientOriginalName());
                
                // array_push($bukti,$name);
                // $f->move(public_path().'/files/', $name);
                $path =Storage::putFile('Bukti', $f);
                array_push($name,$path);
                array_push($name,$ext);
                array_push($bukti,$name);
            }
        return $bukti;
    }

}

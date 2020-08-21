<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
class kepegawaianController extends Controller
{
    public function index()
    {
        return view('kepegawaian.dashboard');
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
        $memu = surat_kepegawaian::where('status', 1)->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();

        return view('wadek2.memu.index', compact('memu', 'dosen_sk', 'pemateri'));
    }

    public function surat_index()
    {
        $memu = surat_kepegawaian::where('status', 2)->get();
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
        $memu = ([
            'nomor_surat' => $request->nomor_surat,
            'status' => 3,
            'jenis_surat' => $request->jenisSurat,
            
        ]);
        $data = surat_kepegawaian::where('id', $id)->update($memu);

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
         
            $surat = surat_kepegawaian::find($id);

            $jenis_kendaraan = jenis_kendaraan::all();
            $pendaftaran_acara = pendaftaran_acara::all();
            $penginapan = penginapan::all();
            $dosen_tugas = dosen_tugas::where('id_sk', $id)->get();

    
            return view('kepegawaian.surat_tugas.spd', compact('surat', 'jenis_kendaraan', 'pendaftaran_acara', 'penginapan', 'dosen_tugas'));
        }
        else if($perjalanan == 2){
            if ($inout->surat_in_out == 2) {
                $surat = ([
                    'biaya' => $request->biaya_pemateri,
                ]);
        
                $data = pemateri::where('id_sk', $id)->update($surat);
                return redirect(route('kepegawaian.surat.index')); 
            }
            else
            return redirect(route('kepegawaian.surat.index'));

        } 
        
    }


    public function spd_save(Request $request, $id)
    {
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
        return redirect()->route('kepegawaian.surat.index');
    }

    public function ktu_memu()
    {
        $memu = surat_kepegawaian::where('status', 1)->orderBy('id', 'asc')->get();
        $memus = surat_kepegawaian::where('status', 2)->orderBy('id', 'asc')->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();
        $perjalanan = perjalanan::all();
        $inout = surat_in_out::all();
        // dd($memus);
        return view('ktu.memu.index', compact('memu', 'memus', 'dosen_sk', 'pemateri', 'perjalanan', 'inout'));
    }

    public function ktu_approve($id)
    {
        $memu = ([
            'status' => 2,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($memu);
        return redirect()->back();
    }

    public function sp_index()
    {
        $surat = surat_kepegawaian::where('status', 5)->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();
        return view('staff_pimpinan.surat_tugas.index', compact('surat', 'dosen_sk','pemateri'));
    }

    public function sp_read()
    {
        $surat_tugas = surat_kepegawaian::all();
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
                'lokasi' => $request->lokasi,
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
            $insert = ([
                'nomor_surat' => null,  
                'jenis_surat' => 3,
                'keterangan' => $request->keterangan,
                'started_at' => $start_date,
                'end_at' => $end_date,
                'status' => 1,
                'surat_in_out' => 2,
                'perjalanan' => 2,
                'lokasi' => $request->lokasi,
            ]);
            $pemateri = $request->pemateri;
            $data = surat_kepegawaian::create($insert);

                    for ($i=0; $i < count($pemateri) ; $i++) { 
                        $pemateri_sk = pemateri::create([
                            'id_sk' => $data->id,
                            'nama' => $request->pemateri[$i],
                            'instansi' =>$request->instansi,
                        ]);
        
        }

        }

        return redirect()->route('wadek2.memu.index');
    }

    public function updateMemu(Request $request, $id)
    {
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
            'started_at' => $start_date,
            'end_at' => $end_date,
            'status' => 1,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($memu);
        $dosen = $request->dosen;
        $pemateri = $request->pemateri;
        if ($dosen == null) {
            $hitung = count($pemateri); 
            $pemateri = pemateri::where('id_sk', $id);
            $pemateri->delete();

            for ($i=0; $i < $hitung ; $i++) { 
                $pemateri_sk = pemateri::create([
                    'id_sk' => $id,
                    'nama' => $request->pemateri[$i],
                ]);
            }
        } else {
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
        return view('kepegawaian.surat_tugas.read', compact('surat_tugas', 'dosen_sk'));
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
        $surat = surat_kepegawaian::where('status', 3)->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri= pemateri::all();
        return view('ktu.surat_tugas.index', compact('surat', 'dosen_sk','pemateri'));
    }

    public function ktu_surat_approve($id)
    {
        $memu = ([
            'status' => 5,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($memu);
        return redirect(route('ktu.surat.index'));
    }

    public function ktu_surat_reject(Request $request, $id)
    {
        $sk = ([
            'status' => 4,
            'revisi' => $request->pesan_revisi,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($sk);
        return redirect(route('ktu.surat.index'));
    }

    public function reject_view($id)
    {
        $surat = surat_kepegawaian::find($id);
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::where('id_sk', $id)->get();

        return view('ktu.surat_tugas.reject', compact('surat', 'dosen_sk', 'jenis'));
    }

    //PDF
    public function kepegawaian_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $pemateri = pemateri::where('id_sk', $id)->get();
     
      return view('kepegawaian.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' => $dosen_tugas,
        'pemateri' => $pemateri,
      ]);
    }

    public function sp_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $pemateri = pemateri::all();
        $pematerinya= pemateri::where('id_sk', $id)->get();
        $jumlah = count($pematerinya);
     
      return view('staff_pimpinan.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
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

        $data = surat_kepegawaian::where('id', $id)->update($memu);
        return redirect(route('staffpim.index'));
    }

    public function sp_surat_reject(Request $request, $id)
    {
        $sk = ([
            'status' => 6,
            'revisi' => $request->pesan_revisi,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($sk);
        return redirect(route('staffpim.index'));
    }

    public function sp_reject_view($id)
    {
        $surat = surat_kepegawaian::find($id);
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::where('id_sk', $id)->get();

        return view('staff_pimpinan.surat_tugas.reject', compact('surat', 'dosen_sk', 'jenis'));
    }

    public function wadek2_surat_index()
    {
        $surat = surat_kepegawaian::where('status', 7)->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();

        $surat2 = surat_kepegawaian::where('status', 8)->get();
        return view('wadek2.surat_tugas.index', compact('surat', 'surat2', 'dosen_sk', 'pemateri'));
    }

    public function wadek2_preview($id)
    {
        $surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $pemateri = pemateri::all();
        $pematerinya= pemateri::where('id_sk', $id)->get();
        $jumlah = count($pematerinya);

      return view('wadek2.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' =>$dosen_tugas,
        'pemateri' => $pemateri,
        'pematerinya' => $pematerinya,
        'jumlah' => $jumlah
      ]);
    }

    public function wadek2_surat_approve($id)
    {
        $surat = ([
            'status' => 8,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($surat);
        return redirect(route('wadek2.surat.index'));
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
        $pemateri= pemateri::all();
        $pematerinya= pemateri::where('id_sk', $id)->get();
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

        $pdf = PDF::loadview('template_print.print1', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Peserta_Acara-" . $surat_tugas->nomor_surat . ".pdf");
    }
    public function cetak_pdf2($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $spd = spd::where('id_sk',$id)->first();

        $pdf = PDF::loadview('template_print.print2', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas, 'spd' => $spd])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Panitia_Kegiatan-" . $surat_tugas->no_surat . ".pdf");
    }
    public function cetak_pdf3($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $pemateri = pemateri::where('id_sk', $id)->get();

        $pdf = PDF::loadview('template_print.print3', ['surat_tugas' => $surat_tugas, 'pemateri' => $pemateri])->setPaper('a4', 'portrait')->setWarnings(false);
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
        $dosen_sk = dosen_tugas::where('id_sk', $id)->get();
        $dosen = User::where('is_dosen', '=', '1')->get();
        $inout = surat_in_out::all();
        $perjalanan = perjalanan::all();
        $pemateri = pemateri::where('id_sk', $id)->get();
        return view('kepegawaian.surat_tugas.edit', compact('surat', 'dosen_sk', 'jenis', 'dosen', 'pemateri', 'perjalanan', 'inout'));
    }

    public function surat_revisian(Request $request, $id)
    {
        $start = $request->started_at;
        $end = $request->end_at;

        $start_date = Carbon::parse($start);
        $start_date->format('d-m-Y');
        $end_date = Carbon::parse($end);
        $end_date->format('d-m-Y');

        $surat = ([
            'nomor_surat' => null,
            'jenis_surat' => $request->jenisSurat,
            'keterangan' => $request->keterangan,
            'started_at' => $start_date,
            'end_at' => $end_date,
            'status' => 3,
        ]);

        $data = surat_kepegawaian::where('id', $id)->update($surat);
        $dosen = $request->dosen;
        $pemateri = $request->pemateri;
        if ($dosen == null) {
            if ($pemateri != null) {
                $hitung = count($pemateri); 
                $pemateri = pemateri::where('id_sk', $id);
                $pemateri->delete();
    
                for ($i=0; $i < $hitung ; $i++) { 
                    $pemateri_sk = pemateri::create([
                        'id_sk' => $id,
                        'nama' => $request->pemateri[$i],
                    ]);
            }
            }
        } else {
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
        return redirect()->route('kepegawaian.surat.revisi');
    }

    //BPP
    public function bpp_index()
    {
        $surat = surat_kepegawaian::where('status', 8)->get();
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();

        return view('bpp.surat_tugas.index', compact('surat', 'dosen_sk', 'pemateri'));
    }

    public function bpp_spd_index()
    {
        $dosen_sk = dosen_tugas::all();
        $pemateri = pemateri::all();
        $surat = DB::table('spd')->join('surat_kepegawaian', 'surat_kepegawaian.id' , '=', 'spd.id_sk')
        ->where('surat_kepegawaian.status', 10)->get();
        $jenis = jenis_sk::all();

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
    
      return view('bpp.surat_tugas.preview_spd', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' =>$dosen_tugas,
        'jenis' => $jenis,
        'status' => $status,
        'bukti' => $bukti,
      ]);
    }

    public function download_bukti($id)
    {
        $pdf = bukti_perjalanan::where('id', $id)->first();
        $pathToFile = public_path('files/' . $pdf->nama);
        return response()->download($pathToFile);
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

        $data = surat_kepegawaian::where('id', $id)->update($surat);
        return redirect()->route('bpp.surat.index');
    }

    //Dosen
    public function dosen_index()
    {
        $user = Auth::user()->no_pegawai;
        $dengan_spd = DB::table('spd')->join('surat_kepegawaian', 'spd.id_sk' , '=', 'surat_kepegawaian.id')->join('dosen_tugas','dosen_tugas.id_sk','=','surat_kepegawaian.id')
        ->where('surat_kepegawaian.status', 9)->where('dosen_tugas.id_dosen', $user)->get();
        $tanpa_spd = DB::table('dosen_tugas')->join('surat_kepegawaian', 'dosen_tugas.id_sk' , '=', 'surat_kepegawaian.id')
        ->where('surat_kepegawaian.status', 9)->where('dosen_tugas.id_dosen', $user)->get();
        if (count($dengan_spd) > 0) {
            $surat_tugas = $dengan_spd;
        } else {
            $surat_tugas = $tanpa_spd;
        }
        $jenis = jenis_sk::all();
        $dosen_sk = dosen_tugas::all();
        $dosen = User::all();
        $pemateri = pemateri::all();
        
        // dd($surat_tugas);
        return view('dosen.surat_tugas.index', [
        'surat_tugas' => $surat_tugas,
        'dosen_sk' => $dosen_sk,
        'pemateri' => $pemateri,
        'jenis' => $jenis,
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
      
        return view('dosen.surat_tugas.upload', [
        'surat_tugas' => $surat_tugas,
        'dosen_sk' => $dosen_sk,
        'pemateri' => $pemateri,
        'jenis' => $jenis,
        'surat_tugas2' => $surat_tugas2,
      
        ]);
    }

    public function dosen_edit_upload($id)
    {
        $espede = DB::table('spd')->join('surat_kepegawaian', 'spd.id_sk' , '=', 'surat_kepegawaian.id')->join('dosen_tugas','dosen_tugas.id_sk','=','surat_kepegawaian.id')
        ->where('spd.id_spd', $id)->first();
        $spd = spd::where('id_spd', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $spd->id_sk)->get();
        $id_sk = $espede->id_sk;
        // dd($id_sk = $espede->id);

        return view('dosen.surat_tugas.edit_upload', [
        'spd' => $spd,
        'dosen_tugas' => $dosen_tugas,
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
    
      return view('dosen.surat_tugas.preview_print', [
        'surat_tugas' => $surat_tugas,
        'dosen_tugas' => $dosen_tugas,
        'spd' => $spd,
      ]);
    }

    public function dosen_upload_preview($id)
    {
        $spd = spd::where('id_spd', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $spd->id_sk)->get();

      return view('dosen.surat_tugas.preview_upload', [
        'spd' => $spd,
        'dosen_tugas' => $dosen_tugas,
      ]);
    }
    
    public function dosen_cetak1($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();

        $pdf = PDF::loadview('template_print.print1', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Peserta_Acara-" . $surat_tugas->nomor_surat . ".pdf");
    }

    public function dosen_cetak2($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $spd = spd::where('id_sk', $id)->first();

        $pdf = PDF::loadview('template_print.print2', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas, 'spd' => $spd])->setPaper('a4', 'portrait')->setWarnings(false);
    	return $pdf->download("Surat_Tugas_Panitia_Kegiatan-" . $surat_tugas->no_surat . ".pdf");
    }

    public function dosen_cetak_spd($id)
    {
    	$surat_tugas = surat_kepegawaian::where('id', $id)->first();
        $dosen_tugas = dosen_tugas::where('id_sk', $surat_tugas->id)->get();
        $spd = spd::where('id_sk', $id)->first();
        $terbit = Carbon::now()->locale('id_ID');

        $pdf = PDF::loadview('template_print.spd1', ['surat_tugas' => $surat_tugas, 'dosen_tugas' => $dosen_tugas, 'spd' => $spd, 'terbit' => $terbit])->setPaper('legal', 'portrait')->setWarnings(false);
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
            'required_with'=> 'Bukti :attribute Harus Diisi'
        ];
        $this->validate($request, [
                'transportasi' => 'required_with:transport',
                'penginapan' => 'required_with:nginap',
                'pendaftaran' => 'required_with:daftar',
                'transportasi.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx',
                'penginapan.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx',
                'pendaftaran.*' => 'mimes:doc,pdf,docx,zip,docx,rar,png,jpg,jpeg,webp,xls,xlsx'
        ],$error);

        $transportasi = null;
        $penginapan = null;
        $pendaftaran = null;
        if($request->transport !=null)
        {
            $transportasi = $this->upload_bukti($request->file('transportasi'));
        }
        if($request->nginap !=null)
        {
            $penginapan = $this->upload_bukti($request->file('penginapan'));
        }
        if($request->daftar !=null)
        {
            $pendaftaran = $this->upload_bukti($request->file('pendaftaran'));
        }

        $time = Carbon::now();
        $user = Auth::user()->no_pegawai;
        $data = bukti_perjalanan::create([
            'id_spd' => $id,
            'transportasi' => $transportasi,
            'penginapan' => $penginapan,
            'pendaftaran' => $pendaftaran,
            'uploaded_at' => $time,
            'id_user' => $user
        ]);
    
        $surat = ([
            'status' => 10,
        ]);

        $id_surat = spd::where('id_spd',$id)->first();
        
    
        $data = surat_kepegawaian::where('id', $id_surat->id_sk)->update($surat);
         
 
        return back()->with('success', 'Data berhasil diupload!');

    }

    protected function upload_bukti($file){
        $bukti = array();
        foreach($file as $f)
            {
                $name=$f->getClientOriginalName();
                array_push($bukti,$name);
                $f->move(public_path().'/files/', $name);  
            }
        return $bukti;
    }

}

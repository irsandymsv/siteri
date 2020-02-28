<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\prodi;
use App\User;
use App\sk_sempro;
use App\detail_skripsi;
use App\skripsi;
use App\mahasiswa;
use App\template;
use App\nama_template;
use App\Http\Controllers\Controller;
use App\status_sk;
use Carbon\Carbon;
use PDF;
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use PdfMerger;
use Storage;
use App\Notifications\verifSKSemproKtu;

class SkSemproController extends Controller
{
   public function index()
   {
      try {
         $sk = sk_sempro::with('status_sk')
            ->orderBy('updated_at', 'desc')
            ->get();
            // dd($sk);
         return view('akademik.SK_view.index', [
            'sk' => $sk,
            'tipe' => "SK Sempro"
         ]);
      } catch (Exception $e) {
         return view('akademik.SK_view.index');
      }
   }

   public function create(Request $request)
   {
      $old_data = [];
      $old_mahasiswa = "";
      if (array_key_exists('nim', $request->old())) {
         // dd($request->old());
         $old_data = $request->old();
         $old_mahasiswa = mahasiswa::whereIn('nim', $request->old()["nim"])
            ->with([
               "prodi",
               "skripsi",
               "skripsi.status_skripsi",
               "skripsi.detail_skripsi" => function($query)
               {
                  $query->orderBy('created_at', 'desc');
               },
               "skripsi.detail_skripsi.surat_tugas" => function($query)
               {
                  $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
               },
               "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
               "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
               "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
         ])->get();
      }

      $dosen = user::where('is_dosen', 1)->get();
      $mahasiswa = mahasiswa::with([
         "prodi",
         "skripsi",
         "skripsi.status_skripsi",
         "skripsi.detail_skripsi" => function($query)
         {
            $query->orderBy('created_at', 'desc');
         },
         "skripsi.detail_skripsi.surat_tugas" => function($query)
         {
            $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
         },
         "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
         "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
         "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
      ])
      ->whereHas("skripsi.status_skripsi", function(Builder $query)
      {
         $query->where("status", "Sudah punya pembahas");
      })->get();

      // dd($mahasiswa);
      return view('akademik.SK_view.create_sk_sempro', [
         'dosen' => $dosen,
         'mahasiswa' => $mahasiswa,
         'old_data' => $old_data,
         'old_mahasiswa' => $old_mahasiswa
      ]);
   }

   public function store(Request $request)
   {
      if($request->input("status")==2){
         $this->validate($request, [
            "no_surat" => "required|unique:surat_tugas,no_surat|unique:sk_skripsi,no_surat_pembimbing|unique:sk_skripsi,no_surat_penguji|unique:sk_sempro,no_surat|",
            'tgl_sempro1' => "required",
            'tgl_sempro2' => "required",
            "nim" => "required|array",
            "nim.*" => "required|string"
         ]);
      }else{
         $this->validate($request, [
            "no_surat" => "required|unique:sk_sempro,no_surat",
            "nim" => "required|array",
            "nim.*" => "required|string"
         ]);
      }

      try {
         $template = template::whereHas('nama_template', function (Builder $query){
            $query->where('nama','SK Sempro');
         })->orderBy('created_at','desc')->first();
         if($template==false){
            return redirect()->route('akademik.sempro.create')->with('error', 'Template Untuk SK Sempro Tidak Ditemukan');
         }else{
            $sk_sempro = sk_sempro::create([
               "no_surat" => $request->input("no_surat"),
               "tgl_sempro1" => carbon::parse($request->input("tgl_sempro1")),
               "tgl_sempro2" => carbon::parse($request->input("tgl_sempro2")),
               "id_status_sk" => $request->input("status"),
               "id_template" => $template->id
            ]);
            foreach ($request->nim as $nim) {
               $this->update_id_sk_sempro($nim, $sk_sempro->no_surat);
            }
         }

         // return redirect()->route('akademik.sempro.show', $sk_sempro->no_surat)->with('success', 'Data Berhasil Ditambahkan');
         return redirect()->route('akademik.sempro.show', $sk_sempro->no_surat)->with('success', 'Data Berhasil Ditambahkan');
         } catch (Exception $e) {
            return redirect()->route('akademik.sempro.create')->with('error', $e->getMessage());
         }
   }

   public function show($id)
   {
      $sk = sk_sempro::find($id);
      $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
      ->with([
         'skripsi',
         'skripsi.mahasiswa',
         'skripsi.mahasiswa.prodi',
         'surat_tugas' => function($query)
         {
            $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
         },
         'surat_tugas.tipe_surat_tugas',
         'surat_tugas.dosen1:no_pegawai,nama',
         'surat_tugas.dosen2:no_pegawai,nama',
      ])->get();
      return view('akademik.SK_view.show_sk_sempro', [
         'sk' => $sk,
         'detail_skripsi' => $detail_skripsi,
         'tipe' => 'sk sempro'
      ]);
   }

   public function edit(Request $request, $id)
   {
      $old_data = [];
      $old_mahasiswa = "";
      $nim_dihapus = [];
      if (array_key_exists('nim', $request->old())) {

         $old_data = $request->old();
         $old_mahasiswa = mahasiswa::whereIn('nim', $request->old()["nim"])
         ->with([
            "prodi",
            "skripsi",
            "skripsi.status_skripsi",
            "skripsi.detail_skripsi" => function($query)
            {
               $query->orderBy('created_at', 'desc');
            },
            "skripsi.detail_skripsi.surat_tugas" => function($query)
            {
               $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
            },
            "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
            "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
            "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
         ])->get();

         foreach ($old_data["nim"] as $key => $value) {
            if ($old_data["pilihan_nim"][$key] == 3) {
               $nim_dihapus [] = $value;
            }
         }
            // dd($nim_dihapus);
      }

      $sk = sk_sempro::find($id);
      $dosen = user::where('is_dosen', 1)->get();
      $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
      ->with([
         'skripsi',
         'skripsi.mahasiswa',
         'skripsi.mahasiswa.prodi',
         'surat_tugas' => function($query)
         {
            $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
         },
         'surat_tugas.tipe_surat_tugas',
         'surat_tugas.dosen1:no_pegawai,nama',
         'surat_tugas.dosen2:no_pegawai,nama',
      ])->get();
      $nim_detail = [];
      foreach ($detail_skripsi as $val) {
         $nim_detail[] = $val->skripsi->nim;
      }

      $mahasiswa = mahasiswa::with([
         "prodi",
         "skripsi",
         "skripsi.status_skripsi",
         "skripsi.detail_skripsi" => function($query)
         {
               $query->orderBy('created_at', 'desc');
         },
         "skripsi.detail_skripsi.surat_tugas" => function($query)
         {
            $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
         },
         "skripsi.detail_skripsi.surat_tugas.tipe_surat_tugas",
         "skripsi.detail_skripsi.surat_tugas.dosen1:no_pegawai,nama",
         "skripsi.detail_skripsi.surat_tugas.dosen2:no_pegawai,nama"
      ])
      ->whereHas("skripsi.status_skripsi", function(Builder $query)
      {
         $query->where("status", "Sudah punya pembahas");
      })
      ->get();
      return view('akademik.SK_view.edit_sk_sempro', [
         'sk' => $sk,
         'detail_skripsi' => $detail_skripsi,
         'nim_detail' => $nim_detail,
         'mahasiswa' => $mahasiswa,
         'dosen' => $dosen,
         'old_data' => $old_data,
         'old_mahasiswa' => $old_mahasiswa,
         'nim_dihapus' => $nim_dihapus,
         'tipe' => 'sk sempro'
      ]);
   }

   public function update(Request $request, $id)
   {
      if ($request->input("status") == 2) {

        $validator = Validator::make($request->all(), [
            'no_surat' => [
                'required',
                Rule::unique('sk_sempro', 'no_surat')->ignore($id,'no_surat'),
                'unique:sk_skripsi,no_surat_pembimbing',
                'unique:sk_skripsi,no_surat_penguji',
                'unique:surat_tugas,no_surat'

            ],
            'tgl_sempro1' => "required",
            'tgl_sempro2' => "required",
            "nim" => "required|array",
            "nim.*" => "required|string"
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('akademik.sempro.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

      } else {

        $validator = Validator::make($request->all(), [
            'no_surat' => [
                'required',
                Rule::unique('sk_sempro', 'no_surat')->ignore($id,'no_surat'),
                'unique:sk_skripsi,no_surat_pembimbing',
                'unique:sk_skripsi,no_surat_penguji',
                'unique:surat_tugas,no_surat'

            ],
            "nim" => "required|array",
            "nim.*" => "required|string"
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('akademik.sempro.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
      }

      try {
         $sk = sk_sempro::find($id);
         $verif_ktu = $sk->verif_ktu;

         if($request->status == 2){
            $verif_ktu = 0;
         }
         sk_sempro::where('no_surat', $id)->update([
            "no_surat" => $request->input("no_surat"),
            "tgl_sempro1" => carbon::parse($request->input("tgl_sempro1")),
            "tgl_sempro2" => carbon::parse($request->input("tgl_sempro2")),
            "id_status_sk" => $request->input("status"),
            "verif_ktu" => $verif_ktu
         ]);
         for($i =0; $i<count($request->nim);$i++){
            if($request->pilihan_nim[$i] == 1 ){
               $this->update_id_sk_sempro($request->nim[$i], $id);
            }else if($request->pilihan_nim[$i] == 3){
               $this->update_id_sk_sempro($request->nim[$i], null);
            }
         }
         return redirect()->route('akademik.sempro.show', $request->input("no_surat"))->with('success', 'Data Berhasil Diedit');
      } catch (Exception $e) {
         return redirect()->route('akademik.sempro.edit', $id)->with('error', $e->getMessage());
      }
   }

   private function update_id_sk_sempro($nim,$id){
      $detail_skripsi = detail_skripsi::whereHas('skripsi', function (builder $query) use ($nim) {
         $query->where('nim', $nim);
      })->orderBy('created_at', 'desc')->first();
      $detail_skripsi->id_sk_sempro = $id;
      $detail_skripsi->save();
   }

   public function destroy($id = null)
   {
      if (!is_null($id)) {
         sk_sempro::find($id)->delete();
         echo 'Data SK Berhasil Dihapus';
      }
   }

   public function cetak_pdf($id)
   {
        $sk = sk_sempro::where('no_surat', $id)->with('template')->first();

        $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
        ->with([
            'skripsi',
            'skripsi.mahasiswa',
            'skripsi.mahasiswa.prodi',
            'surat_tugas' => function($query)
            {
                $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
            },
            'surat_tugas.tipe_surat_tugas',
            'surat_tugas.dosen1:no_pegawai,nama',
            'surat_tugas.dosen2:no_pegawai,nama',
        ])->get();

        $dekan = User::with("jabatan")
        ->wherehas("jabatan", function (Builder $query){
            $query->where("jabatan", "Dekan");
        })->first();
        $tahun_akademik = $this->get_tahun_akademik($sk->created_at);


        $m = new Merger();
        $pdf = PDF::loadview('akademik.SK_view.pdf.sempro.pdf_sk_sempro', [
            'sk' => $sk,
            'detail_skripsi' => $detail_skripsi,
            'dekan' => $dekan,
            'tahun_akademik' => $tahun_akademik
        ])->setPaper('a4', 'portrait')->setWarnings(false);
        $m->addRaw($pdf->output());
        $pdf = PDF::loadview('akademik.SK_view.pdf.sempro.lampiran_sk_sempro', [
            'sk' => $sk,
            'detail_skripsi' => $detail_skripsi,
            'dekan' => $dekan,
            'tahun_akademik' => $tahun_akademik
        ])->setPaper('a4', 'landscape')->setWarnings(false);
        $m->addRaw($pdf->output());

      file_put_contents('storage/sempro/SK Sempro-' . $sk->no_surat . ".pdf", $m->merge());
      return response()->download(
          storage_path('app/public/sempro/SK Sempro-' . $sk->no_surat . ".pdf")
      )->deleteFileAfterSend(true);
   }


    //KTU
   public function ktu_index()
   {
      $sk = sk_sempro::with('status_sk')
      ->whereHas('status_sk', function(Builder $query){
         $query->whereIn('id', [2,3,4]);
      })
      ->orderBy('updated_at', 'desc')->get();

      return view('ktu.SK_view.sk_index', [
         'sk' => $sk,
         'tipe' => "SK Sempro"
      ]);
   }

   public function ktu_show($id)
   {
      $sk = sk_sempro::where('no_surat', $id)->with('template')->first();
      // dd($sk);
      $status = $sk->status_sk->status;
      if($status == "Draft"){
         return redirect()->route('ktu.sk-sempro.index');
      }

      $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
      ->with([
         'skripsi',
         'skripsi.mahasiswa',
         'skripsi.mahasiswa.prodi',
         'surat_tugas' => function($query)
         {
            $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
         },
         'surat_tugas.tipe_surat_tugas',
         'surat_tugas.dosen1:no_pegawai,nama',
         'surat_tugas.dosen2:no_pegawai,nama',
      ])->get();

      $dekan = User::with("jabatan")
      ->wherehas("jabatan", function (Builder $query){
         $query->where("jabatan", "Dekan");
      })->first();
      $tahun_akademik = $this->get_tahun_akademik($sk->created_at);
      return view('ktu.SK_view.sk_sempro_show', [
         'sk' => $sk,
         'detail_skripsi' => $detail_skripsi,
         'dekan' => $dekan,
         'tahun_akademik' => $tahun_akademik
      ]);
   }

   public function ktu_verif(Request $request, $id)
   {
      // dd($request);
      $sk = sk_sempro::find($id);
      $sk->verif_ktu = $request->verif_ktu;
      if($request->verif_ktu == 2){
         $request->validate([
               'pesan_revisi' => 'required|string'
         ]);

         $sk->id_status_sk = 1;
         $sk->pesan_revisi = $request->pesan_revisi;
         $sk->save();
         return redirect()->route('ktu.sk-sempro.index')->with("verif_ktu", 'SK berhasil ditarik, status kembali menjadi "Draft"');
      }
      else if ($request->verif_ktu == 1) {
         $sk->id_status_sk = 3;
         $sk->pesan_revisi = null;
         $sk->save();

         $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)->get();
         // dd($detail_skripsi);
         foreach ($detail_skripsi as $value) {
            skripsi::whereHas('detail_skripsi', function (Builder $query) use ($value) {
               $query->where('id', $value->id);
            })->update([
               'id_status_skripsi' => 4
            ]);
         }

         $akademik = User::with('jabatan')
            ->whereHas('jabatan', function(Builder $query)
            {
                $query->where('jabatan', 'Pengelola Data Akademik');
            })->first();
         $akademik->notify(new verifSKSemproKtu($sk));

         return redirect()->route('ktu.sk-sempro.show', $id)->with('verif_ktu', 'verifikasi SK berhasil, status SK saat ini "Disetujui KTU"');
      }
   }


   //Wadek2
   public function wadek2_index()
   {
      $sk = sk_sempro::with('status_sk')
      ->whereHas('status_sk', function(Builder $query){
         $query->where('status', 'Disetujui KTU');
      })
      ->orderBy('updated_at', 'desc')->get();

      return view('Wadek2.SK_view.sk_index', [
         'sk' => $sk,
         'tipe' => "SK Sempro"
      ]);
   }

   public function wadek2_show($id)
   {
      $sk = sk_sempro::where('no_surat', $id)->with('template')->first();
      $status = $sk->status_sk->status;
      if($status == "Draft"){
         return redirect()->route('ktu.sk-sempro.index');
      }

      $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
      ->with([
         'skripsi',
         'skripsi.mahasiswa',
         'skripsi.mahasiswa.prodi',
         'surat_tugas' => function($query)
         {
            $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
         },
         'surat_tugas.tipe_surat_tugas',
         'surat_tugas.dosen1:no_pegawai,nama',
         'surat_tugas.dosen2:no_pegawai,nama',
      ])->get();

      $dekan = User::with("jabatan")
      ->wherehas("jabatan", function (Builder $query){
         $query->where("jabatan", "Dekan");
      })->first();
      $tahun_akademik = $this->get_tahun_akademik($sk->created_at);

      return view('wadek2.SK_view.sk_sempro_show', [
         'sk' => $sk,
         'detail_skripsi' => $detail_skripsi,
         'dekan' => $dekan,
         'tahun_akademik' => $tahun_akademik
      ]);
   }

    //DEKAN
   public function dekan_index()
   {
      $sk = sk_sempro::with('status_sk')
      ->whereHas('status_sk', function(Builder $query){
         $query->where('status', 'Disetujui KTU');
      })
      ->orderBy('updated_at', 'desc')->get();

      return view('dekan.SK_view.sk_index', [
         'sk' => $sk,
         'tipe' => "SK Sempro"
      ]);
    }

   public function dekan_show($id)
   {
      $sk = sk_sempro::where('no_surat', $id)->with('template')->first();
      $status = $sk->status_sk->status;
      if($status == "Draft"){
         return redirect()->route('ktu.sk-sempro.index');
      }

      $detail_skripsi = detail_skripsi::where('id_sk_sempro', $id)
      ->with([
         'skripsi',
         'skripsi.mahasiswa',
         'skripsi.mahasiswa.prodi',
         'surat_tugas' => function($query)
         {
            $query->where('id_tipe_surat_tugas', 2)->orderBy('created_at', 'desc');
         },
         'surat_tugas.tipe_surat_tugas',
         'surat_tugas.dosen1:no_pegawai,nama',
         'surat_tugas.dosen2:no_pegawai,nama',
      ])->get();

      $dekan = User::with("jabatan")
      ->wherehas("jabatan", function (Builder $query){
         $query->where("jabatan", "Dekan");
      })->first();
      $tahun_akademik = $this->get_tahun_akademik($sk->created_at);

      // dd($detail_sk);
      return view('dekan.SK_view.sk_sempro_show', [
         'sk' => $sk,
         'detail_skripsi' => $detail_skripsi,
         'dekan' => $dekan,
         'tahun_akademik' => $tahun_akademik
      ]);
   }

    // public function dekan_verif(Request $request, $id)
    // {
    //     $sk_akademik = sk_akademik::find($id);
    //     $sk_akademik->verif_dekan = $request->verif_dekan;
    //     if($request->verif_dekan == 2){
    //         $request->validate([
    //             'pesan_revisi' => 'required|string'
    //         ]);

    //         $sk_akademik->id_status_sk_akademik = 1;
    //         $sk_akademik->pesan_revisi = $request->pesan_revisi;
    //         $sk_akademik->save();
    //         return redirect()->route('dekan.sk-sempro.index')->with("verif_dekan", 'SK berhasil ditarik, status kembali menjadi "Draft"');
    //     }
    //     else if ($request->verif_dekan == 1) {
    //         $sk_akademik->id_status_sk_akademik = 4;
    //         $sk_akademik->pesan_revisi = null;
    //         $sk_akademik->save();
    //         return redirect()->route('dekan.sk-sempro.index')->with('verif_dekan', 'verifikasi SK berhasil, status SK saat ini "Disetujui Dekan"');
    //     }
    // }
}

@extends('layouts.template')

@section('side_menu')
   @include('include.dekan_menu')
@endsection

@section('page_title')
  Daftar Honorarium SK Sempro
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
   <style type="text/css">
      /*.font-sm{
         font-size: 65%;
      }*/

      .box-body{
         font-size: 15px;
      }

      .ket_tabel{
         border-collapse: inherit;
      }

      .ket_tabel td:first-child{
         padding-right: 10px;
      }

      .tabel_honor{
         width: 100%;
         border-collapse: collapse;
         border: 1px solid black;
      }

      .tabel_honor td,tr,th{
         border-collapse: collapse;
         border: 1px solid black;
      }

      .tabel_honor td{
          padding: 3px;
      }

      .th_pph{
         width: 90px;;
      }

      .th_ttd{
         width: 70px;
      }

      thead th{
         text-align: center;
      }

      .nama_dosen{
         width: 300px;
      }

      .first_td{
         text-align: center;
         width: 25px;
      }

      .jml_total td{
        font-weight: bold;
        background-color: white;
      }

      .jml_total td:first-child{
        text-align: center;
      }

      .span_uang{
         /*margin-left: 20px;*/
      }

      .to_center{
         text-align: center;
      }

      .to_left{
         float: left;
         margin-left: 35px;
      }

      .to_right{
         float: right;
         margin-right: 25%;
      }

      .ttd_row{
         clear: both;
         width: 100%;

      }

      .ttd_row div{
         width: 30%;
         float: left;
         margin-left: 35px;
      }
   </style>
@endsection

@section('judul_header')
  Honorarium SK Sempro
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>

   <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Daftar Honor Pembahas Sempro</h3>

               {{-- @if($sk_honor->bpp == 0)
               <br>
               <b>Belum Diverifikasi</b>
               @elseif($sk_honor->verif_dekan == 2) 
                 <label class="label bg-red">Butuh Revisi</label>
               @else
                 <label class="label bg-green">Sudah Diverifikasi</label>
               @endif --}}

               @if(session()->has('verif_dekan'))
                  <br><br>
                  <div class="alert alert-success alert-dismissible" style="margin: auto;">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h4><i class="icon fa fa-check"></i> Berhasil</h4>
                     {{ session('verif_dekan') }}
                  </div>
               @endif
        </div>

        <div class="box-body">
            <table class="ket_tabel">
               <tr>
                  <td valign="top">DAFTAR</td>
                  <td valign="top">: </td>
                  <td valign="top">
                     Honorarium Dosen Pembahas Seminar Proposal Skripsi Mahasiswa Fak. Ilmu Komputer Universitas Jember T.A {{ $tahun_akademik['tahun_awal'] }}/{{ $tahun_akademik['tahun_akhir'] }} Di Lingkungan Fakultas Ilmu Komputer Universitas Jember
                  </td>
               </tr>
               <tr>
                  <td valign="top">SESUAI</td>
                  <td valign="top">: </td>
                  <td valign="top">
                     SK Dekan Fak. Ilmu Komputer UNEJ  No. {{ $sk_honor->sk_sempro->no_surat }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->year}} Tanggal {{Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
                  </td>
               </tr>
            </table>
            <br>
            <div class="main_table">
               <table class="tabel_honor" style="margin-top:5px">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Tim Pembahas I/II</th>
                        <th>NPWP</th>
                        <th>Nama Mahasiswa/NIM</th>
                        <th>Gol</th>
                        <th>Honorarium</th>
                        <th class="th_pph">PPH psl 21 5%-15%</th>
                        <th>Penerimaan</th>
                        <th class="th_ttd">Tanda Tangan</th>
                     </tr>
                  </thead>

                  <tbody id="tbl_pembahas">
                     @php $no=0; $a = 1; $b = 1; $total_honor=0; $total_pph=0; $total_penerimaan=0; @endphp

                     @foreach($detail_skripsi as $item)
                        @if ($no+1 == 4*$a-1)
                           @php $a+=1; @endphp
                           <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                        @else
                           <tr id="{{ $no+=1 }}">
                        @endif
                           <td class="first_td">{{ $no }}</td>
                           <td class="nama_dosen">{{ $item->surat_tugas[0]->dosen1->nama }}</td>
                           <td class="to_center">{{ $item->surat_tugas[0]->dosen1->npwp }}</td>
                           <td rowspan="2">
                              <p>{{ $item->skripsi->mahasiswa->nama }}</p>
                              <p>NIM: {{ $item->skripsi->nim }}</p>
                           </td>
                           <td class="to_center">
                              @if (is_null($item->surat_tugas[0]->dosen1->golongan))
                                 -
                              @else
                              @php
                                 $gol = $item->surat_tugas[0]->dosen1->golongan->golongan;
                              @endphp
                                 {{ substr($gol,0,(strlen($gol)-2 )) }}
                              @endif
                           </td>
                           <td id="penguji_{{$no}}" class="pengujiHonor">Rp
                              {{ number_format($sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor, 0, ",", ".") }}
                           </td>
                           <td class="pph" id="pph_{{$no}}">Rp
                              @php
                                 $pph = ($item->surat_tugas[0]->dosen1->pph * $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor)/100;
                              @endphp
                              <span class="span_uang">{{ number_format($pph, 0, ",", ".") }}</span>
                           </td>
                           <td class="penerimaan" id="penerimaan_{{$no}}">Rp
                              @php
                                 $penerimaan = $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor - $pph;
                              @endphp
                              <span class="span_uang">{{ number_format($penerimaan, 0, ",", ".") }}</span>
                           </td>
                           <td>{{ $no }}.</td>

                           @php
                              $total_honor+=$sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor;
                              $total_pph+=$pph;
                              $total_penerimaan+=$penerimaan;
                           @endphp
                        </tr>

                        @if ($no+1 == 4*$b)
                           @php $b+=1; @endphp
                           <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                        @else
                           <tr id="{{ $no+=1 }}">
                        @endif
                           <td class="first_td">{{ $no }}</td>
                           <td class="nama_dosen">{{ $item->surat_tugas[0]->dosen2->nama }}</td>
                           <td class="to_center">{{ $item->surat_tugas[0]->dosen2->npwp }}</td>
                           <td class="to_center">
                              @if (is_null($item->surat_tugas[0]->dosen2->golongan))
                                 -
                              @else
                              @php
                                 $gol = $item->surat_tugas[0]->dosen2->golongan->golongan;
                              @endphp
                                 {{ substr($gol,0,(strlen($gol)-2 )) }}
                              @endif
                           </td>
                           <td id="penguji_{{$no}}" class="pengujiHonor">Rp
                              {{ number_format($sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor, 0, ",", ".") }}
                           </td>
                           <td class="pph" id="pph_{{$no}}">Rp
                              @php
                                 $pph = ($item->surat_tugas[0]->dosen2->pph * $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor)/100;
                              @endphp
                              <span class="span_uang">{{ number_format($pph, 0, ",", ".") }}</span>
                           </td>
                           <td class="penerimaan" id="penerimaan_{{$no}}">Rp
                              @php
                                 $penerimaan = $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor - $pph;
                              @endphp
                              <span class="span_uang">{{ number_format($penerimaan, 0, ",", ".") }}</span>
                           </td>
                           <td>{{ $no }}.</td>

                           @php
                              $total_honor+=$sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor;
                              $total_pph+=$pph;
                              $total_penerimaan+=$penerimaan;
                           @endphp
                        </tr>
                     @endforeach

                     <tr class="jml_total">
                        <td colspan="5">Jumlah</td>
                        <td>Rp {{ number_format($total_honor, 0, ",", ".") }}</td>
                        <td>Rp {{ number_format($total_pph, 0, ",", ".") }}</td>
                        <td>Rp {{ number_format($total_penerimaan, 0, ",", ".") }}</td>
                        <td></td>
                     </tr>
                      @php
                          function penyebut($nilai) {
                              $nilai = abs($nilai);
                              $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
                              $temp = "";
                              if ($nilai < 12) {
                                  $temp = " ". $huruf[$nilai];
                              } else if ($nilai <20) {
                                  $temp = penyebut($nilai - 10). " Belas";
                              } else if ($nilai < 100) {
                                  $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
                              } else if ($nilai < 200) {
                                  $temp = " Seratus" . penyebut($nilai - 100);
                              } else if ($nilai < 1000) {
                                  $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
                              } else if ($nilai < 2000) {
                                  $temp = " Seribu" . penyebut($nilai - 1000);
                              } else if ($nilai < 1000000) {
                                  $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
                              } else if ($nilai < 1000000000) {
                                  $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
                              } else if ($nilai < 1000000000000) {
                                  $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
                              } else if ($nilai < 1000000000000000) {
                                  $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
                              }
                              return $temp;
                          }
                          function terbilang($nilai) {
                              if($nilai<0) {
                                  $hasil = "minus ". trim(penyebut($nilai));
                              } else {
                                  $hasil = trim(penyebut($nilai));
                              }
                              return $hasil;
                          }
                      @endphp
                     <tr class="jml_total">
                        <td colspan="9">Terbilang:
                              @php
                                  echo(terbilang($total_honor).' Rupiah');
                              @endphp
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <br>
            <span class="to_left">Mengetahui</span>
            <span class="to_right">Jember</span><br>
            <div class="ttd_row">
               <div>
                  PPK,
                  <br><br><br><br>
                  <span><b>{{ $dekan->nama }}</b></span><br>
                  <span>NIP. {{ $dekan->no_pegawai }}</span>
               </div>

               <div>
                 Kasubag TU,
                 <br><br><br><br>
                 <span><b>{{ $ktu->nama }}</b></span><br>
                 <span>NIP. {{ $ktu->no_pegawai }}</span>
               </div>

               <div>
                 BPP Fakultas Ilmu Komputer,
                 <br><br><br><br>
                 <span><b>{{ $bpp->nama }}</b></span><br>
                 <span>NIP. {{ $bpp->no_pegawai }}</span>
               </div>
            </div>
        </div>

         <div class="box-footer">
            {{-- @if ($sk_honor->verif_dekan != 1)
               <div class="form-group" style="float: right;">
                  <form method="post" action="{{ route('dekan.honor-sempro.verif', $sk_honor->id) }}">
                     @csrf
                     @method('put')
                     <input type="hidden" name="verif_dekan" value="{{$sk_honor->verif_dekan}}">
                     
                     <button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>
                     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik</button>
                  </form>
               </div>
            @endif --}}

            <a href="{{ route('dekan.honor-sempro.index') }}" class="btn btn-default pull-right">Kembali</a>
         </div>
      </div>
    </div>
   </div>

   <div class="row">
      <div class="col-xs-12">
         
      </div>
   </div>

   {{-- <div class="modal fade" id="modal-tarik-sk">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-red">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Pesan Penarikan Honorarium</h4>
            </div>
            <form method="post" action="{{ route('dekan.honor-sempro.verif', $sk_honor->id) }}">
               @csrf
               @method('PUT')

               <div class="modal-body">
                  <label for="pesan_revisi">Masukkan Pesan Revisi</label>
                  <textarea name="pesan_revisi" id="pesan_revisi" class="form-control">{{old('pesan_revisi')}}</textarea>
                  <input type="hidden" name="verif_dekan" value="{{$sk_honor->verif_dekan}}">

                  @error('pesan_revisi')
                     <p style="color: red;">{{ $message }}</p>
                  @enderror
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>           
                  <button type="submit" name="tarik_btn" class="btn btn-danger">Tarik</button>
               </div>
            </form>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div> --}}
@endsection

@section('script')
   <script src="{{asset('/js/btn_backTop.js')}}"></script>
   <script type="text/javascript">
    @error('pesan_revisi')
      $("#modal-tarik-sk").modal("show");
    @enderror
    
    $("button[name='setuju_btn']").click(function(event) {
       event.preventDefault();
       $("input[name='verif_dekan']").val(1);
       $(this).parents("form").trigger('submit');
    });

    $("button[name='tarik_btn']").click(function(event) {
       event.preventDefault();
       $("input[name='verif_dekan']").val(2);
       $(this).parents("form").trigger('submit');
    });
   </script>
@endsection
@extends('layouts.template')

@section('side_menu')
   @include('include.bpp_menu')
@endsection

@section('page_title')
	Daftar Honorarium SK Sempro
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="/css/custom_style.css">
   <style type="text/css">
      table th{
         text-align: center;
      }

      #tabel_keterangan tr td:first-child{
         margin-right: 80px;
      }

      .revisi_wrap{
        margin-top: 5px;
      }
   </style>
@endsection

@section('judul_header')
	Honorarium SK Sempro
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
   
   <div class="row">
      <div class="col-xs-12" id="top_title">
            <div class="box box-success">
               <div class="box-header">
                  <h3 class="box-title">Honorarium SK Sempro</h3>

                  <div class="box-tools pull-right">
                   <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                   </button>
                 </div>
               </div>

               <div class="box-body">
                  <p>Tanggal SK Sempro: {{Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</p>
                  <p>Sesuai SK Dekan: {{ $sk_honor->sk_sempro->no_surat }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->year}}</p>
               </div>
            </div>
      </div>
   </div>

   <div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
   				<h3 class="box-title">Daftar Honor Pembahas Sempro</h3>

               @if($sk_honor->bpp == 0)
               <br>
               <b>Belum Diverifikasi</b>
               @elseif($sk_honor->verif_bpp == 2) 
                 <label class="label bg-red">Butuh Revisi</label>
               @else
                 <label class="label bg-green">Sudah Diverifikasi</label>
               @endif

               @if(session()->has('verif_bpp'))
                  <br><br>
                  <div class="alert alert-success alert-dismissible" style="margin: auto;">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h4><i class="icon fa fa-check"></i> Berhasil</h4>
                     {{ session('verif_bpp') }}
                  </div>
               @endif
   			</div>

   			<div class="box-body">
               <table id="tabel_keterangan">
                  <tr>
                     <td>DAFTAR</td>
                     <td>: Honorarium Dosen Pembahas Seminar Proposal Skripsi Mahasiswa Fak. Ilmu Komputer Universitas Jember T.A {{ $tahun_akademik['tahun_awal'] }}/{{ $tahun_akademik['tahun_akhir'] }} Di Lingkungan Fakultas Ilmu Komputer Universitas Jember</td>
                  </tr>
                  <tr>
                     <td>SESUAI</td>
                     <td>: SK Dekan Fak. Ilmu Komputer UNEJ  No. {{ $sk_honor->sk_sempro->no_surat }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->year}} Tanggal {{Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</td>
                  </tr>
               </table>

               <table id="tabel_honor">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Tim Pembahas I/II</th>
                        <th>NPWP</th>
                        <th>Nama Mahasiswa/NIM</th>
                        <th>Gol</th>
                        <th>Honorarium</th>
                        <th>PPH psl 5%-15%</th>
                        <th>Penerimaan</th>
                     </tr>
                  </thead>

                  <tbody id="tbl_penguji">
                     @php $no=0; $a = 1; $b = 1; $total_honor=0; $total_pph=0; $total_penerimaan=0; @endphp

                     @foreach($detail_skripsi as $item)
                        @if ($no+1 == 4*$a-1)
                           @php $a+=1; @endphp 
                           <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                        @else
                           <tr id="{{ $no+=1 }}">   
                        @endif
                           <td>{{ $no }}</td>
                           <td>{{ $item->surat_tugas[0]->dosen1->nama }}</td>
                           <td>{{ $item->surat_tugas[0]->dosen1->npwp }}</td>
                           <td rowspan="2">
                              <p>{{ $item->skripsi->mahasiswa->nama_mhs }}</p>
                              <p>NIM: {{ $item->skripsi->nim }}</p>
                           </td>
                           <td>{{ $item->surat_tugas[0]->dosen1->golongan->golongan }}</td>
                           <td id="penguji_{{$no}}" class="pengujiHonor">Rp 
                              {{ number_format($sk_honor->detail_honor->histori_besaran_honor->jumlah_honor, 0, ",", ".") }}
                           </td>
                           <td class="pph" id="pph_{{$no}}">Rp
                              @php
                                 $pph = ($item->surat_tugas[0]->dosen1->golongan->pph * $sk_honor->detail_honor->histori_besaran_honor->jumlah_honor)/100;
                              @endphp
                              {{ number_format($pph, 0, ",", ".") }}
                           </td>
                           <td class="penerimaan" id="penerimaan_{{$no}}">Rp
                              @php
                                 $penerimaan = $sk_honor->detail_honor->histori_besaran_honor->jumlah_honor - $pph;
                              @endphp
                              {{ number_format($penerimaan, 0, ",", ".") }}
                           </td>

                           @php
                              $total_honor+=$sk_honor->detail_honor->histori_besaran_honor->jumlah_honor;
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
                           <td>{{ $no }}</td>
                           <td>{{ $item->surat_tugas[0]->dosen2->nama }}</td>
                           <td>{{ $item->surat_tugas[0]->dosen2->npwp }}</td>
                           <td>{{ $item->surat_tugas[0]->dosen2->golongan->golongan }}</td>
                           <td id="penguji_{{$no}}" class="pengujiHonor">Rp
                              {{ number_format($sk_honor->detail_honor->histori_besaran_honor->jumlah_honor, 0, ",", ".") }}
                           </td>
                           <td class="pph" id="pph_{{$no}}">Rp
                              @php
                                 $pph = ($item->surat_tugas[0]->dosen2->golongan->pph * $sk_honor->detail_honor->histori_besaran_honor->jumlah_honor)/100;
                              @endphp
                              {{ number_format($pph, 0, ",", ".") }}
                           </td>
                           <td class="penerimaan" id="penerimaan_{{$no}}">Rp
                              @php
                                 $penerimaan = $sk_honor->detail_honor->histori_besaran_honor->jumlah_honor - $pph;
                              @endphp
                              {{ number_format($penerimaan, 0, ",", ".") }}
                           </td>

                           @php
                             $total_honor+=$sk_honor->detail_honor->histori_besaran_honor->jumlah_honor;
                             $total_pph+=$pph;
                             $total_penerimaan+=$penerimaan;
                           @endphp
                        </tr>
                     @endforeach

                     <tr class="jml_total">
                        <td colspan="5" style="text-align: center;">Jumlah</td>
                        <td>Rp {{ number_format($total_honor, 0, ",", ".") }}</td>
                        <td>Rp {{ number_format($total_pph, 0, ",", ".") }}</td>
                        <td>Rp {{ number_format($total_penerimaan, 0, ",", ".") }}</td>
                     </tr>
                     
                     <tr>
                        <td colspan="8">Terbilang: </td>
                     </tr>
                  </tbody>
               </table>
   			</div>

            <div class="box-footer">
               @if ($sk_honor->verif_bpp != 1)
                  <div class="form-group" style="float: right;">
                     <form method="post" action="{{ ( $sk_honor->tipe_sk->tipe == "SK Skripsi"? route('bpp.honor-skripsi.verif', $sk_honor->id) : route('bpp.honor-sempro.verif', $sk_honor->id) ) }}">
                        @csrf
                        @method('put')
                        <input type="hidden" name="verif_bpp" value="{{$sk_honor->verif_bpp}}">
                        
                        <button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik</button>
                     </form>
                  </div>
               @endif

               <a href="{{ route('bpp.honor-sempro.index') }}" class="btn btn-default pull-right">Kembali</a>
            </div>
   		</div>
   	</div>
   </div>

   <div class="row">
      <div class="col-xs-12">
         
      </div>
   </div>

   <div class="modal fade" id="modal-tarik-sk">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-red">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Pesan Penarikan Honorarium</h4>
            </div>
            <form method="post" action="{{ ( $sk_honor->tipe_sk->tipe == "SK Skripsi"? route('bpp.honor-skripsi.verif', $sk_honor->id) : route('bpp.honor-sempro.verif', $sk_honor->id) ) }}">
               @csrf
               @method('PUT')

               <div class="modal-body">
                  <label for="pesan_revisi">Masukkan Pesan Revisi</label>
                  <textarea name="pesan_revisi" id="pesan_revisi" class="form-control">{{old('pesan_revisi')}}</textarea>
                  <input type="hidden" name="verif_bpp" value="{{$sk_honor->verif_bpp}}">

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
   </div>
@endsection

@section('script')
   <script src="/js/btn_backTop.js"></script>
   <script type="text/javascript">
    @error('pesan_revisi')
      $("#modal-tarik-sk").modal("show");
    @enderror
    
    $("button[name='setuju_btn']").click(function(event) {
       event.preventDefault();
       $("input[name='verif_bpp']").val(1);
       $(this).parents("form").trigger('submit');
    });

    $("button[name='tarik_btn']").click(function(event) {
       event.preventDefault();
       $("input[name='verif_bpp']").val(2);
       $(this).parents("form").trigger('submit');
    });
   </script>
@endsection
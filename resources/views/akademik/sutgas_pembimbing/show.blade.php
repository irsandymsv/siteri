@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Detail Surat Tugas Pembimbing Skripsi
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold;: 
      }
	</style>	
@endsection

@section('judul_header')
	Surat Tugas Pembimbing Skripsi
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Detail Surat Tugas Pembimbing Skripsi</h3>
               
               @if($surat_tugas->verif_ktu == 2)
                  <label class="label bg-red">Butuh Revisi</label>
               @endif

               @if ($surat_tugas->verif_ktu == 1)
                  <div style="float: right;">
                     <a href="{{ route("akademik.sutgas-pembimbing.cetak", $surat_tugas->id) }}" class="btn bg-teal"><i class="fa fa-print"></i> Download PDF</a>
                  </div>
               @endif

               <h5><b>Progres</b> :</h5>
               <div class="tl_wrap">
                  <div class="item_tl" id="progres_1">
                     <div><i class="fa fa-check"></i></div>
                     <h4>Disimpan</h4>
                  </div>

                  <div class="item_tl" id="progres_2">
                     <div><i></i></div>
                     <h4>Dikirim</h4>
                  </div>

                  <div class="item_tl" id="progres_3">
                     <div><i></i></div>
                     <h4>Disetujui KTU</h4>
                  </div>
               </div>

               @if(!is_null($surat_tugas->pesan_revisi))
               <div class="revisi_wrap">
                  <h4><b>Pesan Revisi</b> : </h4>
                  <blockquote>
                     <p>{{ $surat_tugas->pesan_revisi }}</p>
                  </blockquote>
               </div>
               @endif

               @if (session('success'))
               <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-check"></i> Sukses</h4>
                   {{session('success')}}
               </div>
               @php
               Session::forget('success');
               @endphp
               @endif
            </div>

            <div class="box-body">
         		<div class="table-responsive">
                  <table class="table table-striped table-bordered">
                     <tr>
                        <td>Tanggal Dibuat</td>   
                        <td>{{ Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                     </tr>

                     <tr>
                        <td>No Surat</td>
                        <td>{{ $surat_tugas->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($surat_tugas->created_at)->year }}</td>
                     </tr>

                     <tr>
                        <td>Pembimbing Utama</td>
                        <td>
                           <p>{{ $surat_tugas->dosen1->nama }}</p>
                           <p>{{ $surat_tugas->dosen1->no_pegawai }}</p>
                        </td>
                     </tr>

                     <tr>
                        <td>Pembimbing Pendamping</td>
                        <td>
                           <p>{{ $surat_tugas->dosen2->nama }}</p>
                           <p>{{ $surat_tugas->dosen2->no_pegawai }}</p>
                        </td>
                     </tr>

                     <tr>
                        <td>Keris</td>
                        <td>{{ $surat_tugas->detail_skripsi->keris->nama }}</td>
                     </tr>

                     <tr>
                        <td>Nama Mahasiswa</td>
                        <td>{{ $surat_tugas->detail_skripsi->skripsi->mahasiswa->nama }}</td>
                     </tr>

                     <tr>
                        <td>NIM</td>
                        <td>{{ $surat_tugas->detail_skripsi->skripsi->nim }}</td>
                     </tr>

                     <tr>
                        <td>Program Studi</td>
                        <td>{{ $surat_tugas->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
                     </tr>

                     <tr>
                        <td>Judul</td>
                        <td>
                           {{ $surat_tugas->detail_skripsi->judul }}
                        </td>
                     </tr>

                     <tr>
                        <td>Status Surat</td>
                        <td>{{ $surat_tugas->status_surat_tugas->status }}</td>
                     </tr>
                  </table>    
               </div>
            </div>

            <div class="box-footer">
               <a href="{{ route('akademik.sutgas-pembimbing.edit', $surat_tugas->id) }}" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Ubah</a> &ensp;   
            </div>
            
   		</div>
   	</div>
	</div>
@endsection

@section('script')
   <script type="text/javascript">
      var status = @json($surat_tugas->id_status_surat_tugas);
      for (var i = status; i > 0; i--) {
         // $("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
         $("#progres_"+i).addClass('verified');
         $("#progres_"+i).find('i').addClass('fa fa-check');
      }
   </script>
@endsection
@extends('akademik.akademik_view')

@section('page_title')
	Detail Surat Tugas Pembimbing
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.table-responsive{
         width: 85%;
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
	Surat Tugas Pembimbing
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
              <h3 class="box-title">Detail Surat Tugas Pembimbing</h3>
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
                           <p>{{ $surat_tugas->surat_tugas_pembimbing->pembimbing_utama->nama }}</p>
                           <p>{{ $surat_tugas->surat_tugas_pembimbing->pembimbing_utama->no_pegawai }}</p>
                        </td>
                     </tr>

                     <tr>
                        <td>Pembimbing Pendamping</td>
                        <td>
                           <p>{{ $surat_tugas->surat_tugas_pembimbing->pembimbing_pendamping->nama }}</p>
                           <p>{{ $surat_tugas->surat_tugas_pembimbing->pembimbing_pendamping->no_pegawai }}</p>
                        </td>
                     </tr>

                     <tr>
                        <td>Keris</td>
                        <td>{{ $surat_tugas->surat_tugas_pembimbing->keris->nama }}</td>
                     </tr>

                     <tr>
                        <td>Nama Mahasiswa</td>
                        <td>{{ $surat_tugas->surat_tugas_pembimbing->mahasiswa->nama }}</td>
                     </tr>

                     <tr>
                        <td>NIM</td>
                        <td>{{ $surat_tugas->surat_tugas_pembimbing->nim }}</td>
                     </tr>

                     <tr>
                        <td>Program Studi</td>
                        <td>{{ $surat_tugas->surat_tugas_pembimbing->mahasiswa->bagian->bagian }}</td>
                     </tr>

                     <tr>
                        <td>Judul</td>
                        <td>
                           {{ $surat_tugas->surat_tugas_pembimbing->judul }}
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
               <a href="{{ route('akademik.sutgas-pembimbing.edit', $surat_tugas->id) }}" class="btn btn-warning">Ubah</a> &ensp;   
            </div>
            
   		</div>
   	</div>
	</div>
@endsection

@section('script')

@endsection
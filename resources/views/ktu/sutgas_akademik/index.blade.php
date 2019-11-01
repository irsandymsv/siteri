@extends('ktu.ktu_view')

@section('page_title')
	@if ($tipe == "surat tugas pembimbing")
		Surat Tugas Pembimbing Skripsi
	@endif
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('judul_header')
	@if ($tipe == "surat tugas pembimbing")
		Surat Tugas Pembimbing Skripsi
	@endif
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-success">
   			<div class="box-header">
   				<h3 class="box-title">
              		@if ($tipe == "surat tugas pembimbing")
							Daftar Surat Tugas Pembimbing Skripsi
						@endif
           		</h3>
            	
              	@if(session()->has('verif_ktu'))
              	<div class="alert alert-info alert-dismissible" style="width: 80%; margin: auto;">
               	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               	<h4><i class="icon fa fa-info"></i> Berhasil</h4>
	           		{{session('verif_ktu')}}
	          	</div>
	          	@endif 

	          	@php 
	          		Session::forget('verif_ktu'); 
	          	@endphp
            </div>

            <div class="box-body">
            	<div class="table-responsive">
            		<table id="table_data1" class="table table-bordered table-hovered">
	            		<thead>
		            		<tr>
		            			<th>No</th>
		            			<th>No Surat</th>
		            			<th>Status</th>
		            			<th>Nama Mahasiswa</th>
		            			<th>Verifikasi KTU</th>
		            			<th>Tanggal Dibuat</th>
		            			<th>Pilihan</th>
		            		</tr>
		            	</thead>
		            	<tbody>
		            		@foreach ($surat_tugas as $item)
		            			<tr>
		            				<td>{{ $loop->index + 1 }}</td>
		            				<td>
		            					{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
		            				</td>
		            				<td>{{ $item->status_surat_tugas->status }}</td>
		            				<td>{{ $item->surat_tugas_pembimbing->mahasiswa->nama }}</td>
		            				<td>
		            					@if ($item->verif_ktu == null)
		            						Belum Diverifikasi
		            					@elseif($item->verif_ktu == 2)
		            						<label class="label bg-red">Butuh Revisi</label>
		            					@else
		            						<label class="label bg-green">Sudah Diverifikasi</label>
		            					@endif
		            				</td>
		            				<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
		            				<td>
		            					<a href="{{ route('ktu.sutgas-pembimbing.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
		            				</td>
		            			</tr>
		            		@endforeach
		            	</tbody>
		            </table>
            	</div>
            </div>
   		</div>
   	</div>
	</div>
@endsection
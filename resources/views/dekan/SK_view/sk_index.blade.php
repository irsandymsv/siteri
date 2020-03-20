@extends('layouts.template')

@section('side_menu')
   @include('include.dekan_menu')
@endsection

@section('page_title')
	@if($tipe == "SK Skripsi")
		Daftar Semua SK skripsi
	@else
		Daftar Semua SK Sempro
	@endif
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
@endsection

@section('judul_header')
	@if($tipe == "SK Skripsi")
		SK Skripsi
	@else
		SK Sempro
	@endif
@endsection

@section('content')
<p style="color: red;">{{session('error')}}</p>

@php
	Session::forget('error');
@endphp
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Daftar SK {{ ($tipe == "SK Skripsi"? 'Skripsi' : 'Sempro') }}</h3>
	            </div>

	            <div class="box-body">
	            	<div class="table-responsive">
	            		<table id="tbl_data1" class="table table-bordered table-hovered">
		            		<thead>
			            		<tr>
			            			<th>No</th>
			            			@if($tipe == "SK Skripsi")
				            			<th>No Surat SK Pembimbing</th>
				            			<th>No Surat SK Penguji</th>
			            			@else
			            				<th>No Surat</th>
			            			@endif
			            			<th>Tanggal Dibuat</th>
			            			<th>Status</th>
			            			{{-- <th>Verifikasi KTU</th> --}}
			            			{{-- <th>Verifikasi Dekan</th> --}}
			            			<th>Aksi</th>
			            		</tr>
			            	</thead>
			            	<tbody>
			            		@foreach($sk as $item)
			            			<tr id="{{ ($tipe == "SK Skripsi"? 'sk_'.$item->id:'sk_'.$item->no_surat) }}">
			            				<td>{{$loop->index + 1}}</td>
			            				@if($tipe == "SK Skripsi")
				            				<td>{{ $item->no_surat_pembimbing }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
				            				<td>{{ $item->no_surat_penguji }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
			            				@else
			            					<td>{{ $item->no_surat }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
			            				@endif
			            				<td>
			            					{{Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
			            				</td>
			            				<td>{{$item->status_sk->status}}</td>
			            				{{-- <td>
			            					@if($item->verif_ktu == 0) 
			            						Belum Diverifikasi
			            					@elseif($item->verif_ktu == 2) 
			            						<label class="label bg-red">Butuh Revisi</label>
			            					@else
			            						<label class="label bg-green">Sudah Diverifikasi</label>
			            					@endif
			            				</td> --}}
			            				{{-- <td>
			            					@if($item->verif_dekan == 0) 
			            						Belum Diverifikasi
			            					@elseif($item->verif_dekan == 2) 
			            						<label class="label bg-red">Butuh Revisi</label> 
			            					@else
			            						<label class="label bg-green">Sudah Diverifikasi</label>
			            					@endif
			            				</td> --}}
			            				<td>
			            					@if($tipe == "SK Skripsi")
			            					<a href="{{ route('dekan.sk-skripsi.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					@else
			            					<a href="{{ route('dekan.sk-sempro.show', $item->no_surat) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					@endif
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

@section('script')
	<script type="text/javascript">
		$(function() {
			$('#tbl_data1').DataTable()
		})
	</script>
@endsection
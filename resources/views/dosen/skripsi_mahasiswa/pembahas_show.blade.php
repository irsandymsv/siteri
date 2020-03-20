@extends('layouts.template')

@section('side_menu')
   @if (Auth::user()->jabatan->jabatan == "Dekan")
      @include('include.dekan_menu')
   @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 1")
   	@include('include.wadek1_menu')
   @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 2")
   	@include('include.wadek2_menu')
   @elseif(Auth::user()->jabatan->jabatan == "Dosen")
      @include('include.dosen_menu')
   @endif
@endsection

@section('page_title')
	Pembahas Sempro
@endsection

@section('judul_header')
	Detail Sempro Mahasiswa <small>Pembahas sempro</small>
@endsection

@section('content')
	<div class="row">
		<div class="col col-md-8">
			<div class="box box-primary">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Data Mahasiswa</h3>
			  	</div>
			  	<!-- /.box-header -->
			  	<div class="box-body">
			    	<table class="table table-striped table-bordered">
			      	<tr>
			      		<td>NIM</td>
			      		<td>{{ $mahasiswa->nim }}</td>
			      	</tr>

			      	<tr>
			      		<td>Nama</td>
			      		<td>{{ $mahasiswa->nama }}</td>
			      	</tr>

			      	<tr>
			      		<td>Program Studi</td>
			      		<td>{{ $mahasiswa->prodi->nama }}</td>
			      	</tr>

			      	<tr>
			      		<td>Judul Skripsi</td>
			      		<td>{{ $mahasiswa->skripsi->detail_skripsi[0]->judul }}</td>
			      	</tr>

			      	<tr>
			      		<td>Tanggal Sempro</td>
			      		<td>{{ Carbon\Carbon::parse($mahasiswa->skripsi->detail_skripsi[0]->surat_tugas[0]->tanggal)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
			      	</tr>
			    	</table>
			  	</div>
			  	<!-- /.box-body -->

			  	<div class="box-footer">
			  		@if (Auth::user()->jabatan->jabatan == "Dekan")
                  <a href="{{ route('dekan.pembahas-sempro') }}" class="btn btn-default pull-right">Kembali</a>
               @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 1")
               	<a href="{{ route('wadek1.pembahas-sempro') }}" class="btn btn-default pull-right">Kembali</a>
               @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 2")
               	<a href="{{ route('wadek2.pembahas-sempro') }}" class="btn btn-default pull-right">Kembali</a>
               @elseif(Auth::user()->jabatan->jabatan == "Dosen")
                  <a href="{{ route('dosen.pembahas-sempro') }}" class="btn btn-default pull-right">Kembali</a>
               @endif

			  		{{-- <a href="{{ route('dosen.pembahas-sempro') }}" class="btn btn-default pull-right">Kembali</a> --}}
			  	</div>
			</div>
		</div>

		<div class="col col-md-4">
			<div class="box box-success">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Pembayaran Honor</h3>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-striped table-bordered">
			    		<tr>
			    			<td>Sebagai</td>
			    			<td>
			    				@if (Auth::user()->no_pegawai == $mahasiswa->skripsi->detail_skripsi[0]->surat_tugas[0]->id_dosen1)
			    					Pembahas 1
			    				@else
			    					Pembahas 2
			    				@endif
			    			</td>
			    		</tr>
			      	<tr>
			      		<td>Status Honor</td>
			      		<td>
			      			@if (!is_null($status_honor = $mahasiswa->skripsi->detail_skripsi[0]->sk_sempro) && !is_null($status_honor = $mahasiswa->skripsi->detail_skripsi[0]->sk_sempro->sk_honor))
			      				@php
			      					$status_honor = $mahasiswa->skripsi->detail_skripsi[0]->sk_sempro->sk_honor->status_sk_honor->status;
			      				@endphp
			      				@if ($status_honor != "Telah Dibayarkan")
			      					Belum Dibayarkan 
			      					{{-- <i class="fa fa-check-circle" style="color: #ddd; float: right; font-size: 24px;"></i> --}}
			      				@else
			      					{{ $status_honor }} <i class="fa fa-check-circle" style="color: green; float: right; font-size: 24px;"></i>
			      				@endif

			      			@else
			      				-
			      			@endif
			      		</td>
			      	</tr>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>
	</div>
@endsection
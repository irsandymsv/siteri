@extends('layouts.template')

@section('side_menu')
   @include('include.dosen_menu')
@endsection

@section('page_title')
	Pembimbing Skripsi
@endsection

@section('judul_header')
	Detail Skripsi Mahasiswa <small>Pembimbing Skripsi</small>
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
			      		<td>{{ $mahasiswa->bagian->bagian }}</td>
			      	</tr>

			      	<tr>
			      		<td>Judul Skripsi</td>
			      		<td>{{ $mahasiswa->skripsi->detail_skripsi[0]->judul }}</td>
			      	</tr>

			      	<tr>
			      		<td>Status Skripsi</td>
			      		<td>{{ $mahasiswa->skripsi->status_skripsi->status }}</td>
			      	</tr>
			    	</table>
			  </div>
			  <!-- /.box-body -->

			  	<div class="box-footer">
			  		<a href="{{ route('dosen.pembimbing-skripsi') }}" class="btn btn-default pull-right">Kembali</a>
			  	</div>
			</div>

			<div class="box box-warning">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Timeline Skripsi</h3>
			  	</div>
			  	<!-- /.box-header -->
			  	<div class="box-body">
			    	<table class="table table-striped table-bordered">
			      	<tr>
			      		<td>Tanggal Penetapan Pembimbing</td>
			      		<td>{{ $tgl_pembimbing }}</td>
			      	</tr>

			      	<tr>
			      		<td>Tanggal Sempro</td>
			      		<td>{{ $tgl_sempro }}</td>
			      	</tr>

			      	<tr>
			      		<td>Tanggal Sidang</td>
			      		<td>{{ $tgl_sidang }}</td>
			      	</tr>
			   	</table>
			  	</div>
			  	<!-- /.box-body -->
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
			    				@if (Auth::user()->no_pegawai == $no_pembimbing['utama'])
			    					Pembimbing Utama
			    				@else
			    					Pembimbing Pendamping
			    				@endif
			    			</td>
			    		</tr>
			      	<tr>
			      		<td>Status Honor</td>
			      		<td>
			      			@if (!is_null($status_honor = $mahasiswa->skripsi->detail_skripsi[0]->sk_skripsi) && !is_null($status_honor = $mahasiswa->skripsi->detail_skripsi[0]->sk_skripsi->sk_honor))
			      				@php
			      					$status_honor = $mahasiswa->skripsi->detail_skripsi[0]->sk_skripsi->sk_honor->status_sk_honor->status;
			      				@endphp
			      				@if ($status_honor != "Telah Dibayarkan")
			      					Belum Dibayarkan <i class="fa fa-check-circle" style="color: #ddd; float: right; font-size: 24px;"></i>
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
@extends('layouts.template')

@section('side_menu')
   @include('include.keuangan_menu')
@endsection

@section('page_title')
	Dashboard
@endsection

@section('judul_header')
	Dashboard
@endsection

@section('content')
	<div class="row">
		<div class="col col-xs-12">
			<div class="box box-primary">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">SK Sempro Baru</h3>

			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>No Surat</th>
			        		<th>Tanggal Dibuat</th>
			        		<th>Opsi</th>
			      	</tr>

				      <tbody>
				      	@if ($sk_sempro_baru->isEmpty())
				      		<tr>
				      			<td colspan="4" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sk_sempro_baru as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
	   			      			<td>{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</td>
	   			      			<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
	   			      			<td>
				      					<a href="{{ route('keuangan.honor-sempro.store', $item->no_surat) }}" title="Buat Daftar honor untuk SK ini" class="btn btn-success">Generate</a>
				      				</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col col-xs-12">
			<div class="box box-success">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">SK Skripsi Baru</h3>

			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>No SK Pembimbing</th>
			        		<th>No SK Penguji</th>
			        		<th>Tanggal Dibuat</th>
			        		<th>Opsi</th>
			      	</tr>

				      <tbody>
				      	@if ($sk_skripsi_baru->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sk_skripsi_baru as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
	   			      			<td>{{ $item->no_surat_pembimbing }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</td>
	   			      			<td>{{ $item->no_surat_penguji }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</td>
	   			      			<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
	   			      			<td>
				      					<a href="{{ route('keuangan.honor-skripsi.store', $item->id) }}" title="Buat Daftar honor untuk SK ini" class="btn btn-success">Generate</a>
				      				</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>
	</div>
@endsection
@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Dashboard Akademik
@endsection

@section('judul_header')
	Dashboard
@endsection

@section('content')
	<div class="row">
		<div class="col col-md-6">
			<div class="box box-primary">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Surat Tugas Berstatus Draft</h3>

			   	<div class="box-tools">
				    	<div class="btn-group">
							<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expand="false">Buat Baru <i class="fa fa-caret-down"></i></button>
							<ul class="dropdown-menu">
								<li>
									<a href="{{ route('akademik.sutgas-pembimbing.create') }}">Surat Tugas Pembimbing Skripsi</a>
								</li>
								<li>
									<a href="{{ route('akademik.sutgas-pembahas.create') }}">Surat Tugas Pembahas Sempro</a>
								</li>
								<li>
									<a href="{{ route('akademik.sutgas-penguji.create') }}">Surat Tugas Penguji Skripsi</a>
								</li>
							</ul>
						</div>
			   	</div>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>No Surat</th>
			        		<th>Tipe Surat</th>
			        		<th>Tanggal</th>
			        		{{-- <th style="width: 40px">Opsi</th> --}}
			      	</tr>

				      <tbody>
				      	@if ($sutgas_draft->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sutgas_draft as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
				      				@if($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing")
					      				<td>
					      					<a href="{{ route('akademik.sutgas-pembimbing.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
					      				</td>
					      			@elseif($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembahas")
					      				<td>
					      					<a href="{{ route('akademik.sutgas-pembahas.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
					      				</td>
					      			@else
					      				<td>
					      					<a href="{{ route('akademik.sutgas-penguji.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
					      				</td>
				      				@endif
	   			      			<td>{{ $item->tipe_surat_tugas->tipe_surat }}</td>
	   			      			<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>

		<div class="col col-md-6">
			<div class="box box-danger">
			  	<div class="box-header with-border">
			    	<h3 class="box-title">Surat Tugas Butuh Revisi</h3>
			  	</div>
			  	<!-- /.box-header -->
			  	<div class="box-body">
				   <table class="table table-bordered">
				      <tr>
				        <th style="width: 10px">#</th>
				        <th>No Surat</th>
				        <th>Tipe Surat</th>
				        <th>Tanggal</th>
				      </tr>

				      <tbody>
				      	@if ($sutgas_revisi->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sutgas_revisi as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
				      				@if($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing")
					      				<td>
					      					<a href="{{ route('akademik.sutgas-pembimbing.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
					      				</td>
					      			@elseif($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembahas")
					      				<td>
					      					<a href="{{ route('akademik.sutgas-pembahas.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
					      				</td>
					      			@else
					      				<td>
					      					<a href="{{ route('akademik.sutgas-penguji.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
					      				</td>
				      				@endif
	   			      			<td>{{ $item->tipe_surat_tugas->tipe_surat }}</td>
	   			      			<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
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
		<div class="col col-md-6">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">SK Sempro Berstatus Draft</h3>

			    <div class="box-tools">
			    	<a href="{{ route('akademik.sempro.create') }}" class="btn btn-success" title="Buat SK Sempro Baru"><i class="fa fa-plus"></i> Buat Baru</a>
			    </div>
			  </div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    <table class="table table-bordered">
			      <tr>
			        <th style="width: 10px">#</th>
			        <th>No Surat</th>
			        <th>Tanggal</th>
			      </tr>

			      <tbody>
			      	@if ($sk_sempro_draft->isEmpty())
			      		<tr><td colspan="4" style="text-align: center;">Tidak Ada Data</td></tr>
			      	@else
			      		@foreach ($sk_sempro_draft as $item)
				      		<tr>
				      			<td>{{ $loop->index+1 }}</td>
				      			<td><a href="{{ route('akademik.sempro.show', $item->no_surat) }}" title="Lihat Detail">{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a></td>
				      			<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
				      		</tr>
			      		@endforeach
			      	@endif
			      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>

		<div class="col col-md-6">
			<div class="box box-danger">
			  <div class="box-header with-border">
			    <h3 class="box-title">SK Sempro Butuh Revisi</h3>
			  </div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    <table class="table table-bordered">
			      <tr>
			        <th style="width: 10px">#</th>
			        <th>No Surat</th>
			        <th>Tanggal</th>
			      </tr>

			      <tbody>
			      	@if ($sk_sempro_revisi->isEmpty())
			      		<tr><td colspan="4" style="text-align: center;">Tidak Ada Data</td></tr>
			      	@else
			      		@foreach ($sk_sempro_revisi as $item)
				      		<tr>
				      			<td>{{ $loop->index+1 }}</td>
				      			<td><a href="{{ route('akademik.sempro.show', $item->no_surat) }}" title="Lihat Detail">{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a></td>
				      			<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
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
		<div class="col col-md-6">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">SK Skripsi Berstatus Draft</h3>

			    <div class="box-tools">
			    	<a href="{{ route('akademik.skripsi.create') }}" class="btn btn-success" title="Buat SK Skripsi Baru"><i class="fa fa-plus"></i> Buat Baru</a>
			    </div>
			  </div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    <table class="table table-bordered">
			      <tr>
			        <th style="width: 10px">#</th>
			        <th>No Surat Pembimbing</th>
			        <th>No Surat Penguji</th>
			        <th>Tanggal</th>
			      </tr>

			      <tbody>
			      	@if ($sk_skripsi_draft->isEmpty())
			      		<tr><td colspan="4" style="text-align: center;">Tidak Ada Data</td></tr>
			      	@else
			      		@foreach ($sk_skripsi_draft as $item)
				      		<tr>
				      			<td>{{ $loop->index+1 }}</td>
				      			<td>
				      				<a href="{{ route('akademik.sempro.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat_pembimbing }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
				      			</td>
				      			<td>
				      				<a href="{{ route('akademik.sempro.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat_penguji }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
				      			</td>
				      			<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
				      		</tr>
			      		@endforeach
			      	@endif
			      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>

		<div class="col col-md-6">
			<div class="box box-danger">
			  <div class="box-header with-border">
			    <h3 class="box-title">SK Skripsi Butuh Revisi</h3>
			  </div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    <table class="table table-bordered">
			      <tr>
			        <th style="width: 10px">#</th>
			        <th>No Surat Pembimbing</th>
			        <th>No Surat Penguji</th>
			        <th>Tanggal</th>
			      </tr>

			      <tbody>
			      	@if ($sk_sempro_revisi->isEmpty())
			      		<tr><td colspan="4" style="text-align: center;">Tidak Ada Data</td></tr>
			      	@else
			      		@foreach ($sk_sempro_revisi as $item)
				      		<tr>
				      			<td>{{ $loop->index+1 }}</td>
				      			<td>
				      				<a href="{{ route('akademik.sempro.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat_pembimbing }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
				      			</td>
				      			<td>
				      				<a href="{{ route('akademik.sempro.show', $item->id) }}" title="Lihat Detail">{{ $item->no_surat_penguji }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}</a>
				      			</td>
				      			<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
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
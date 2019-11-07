@extends('akademik.akademik_view')

@section('page_title')
	Data Skripsi
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('judul_header')
	Data Skripsi
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-success">
   			<div class="box-header">
              <h3 class="box-title">Data Skripsi</h3>
            </div>

            <div class="box-body">
            	<div class="table-responsive">
            		<table id="table_data1" class="table table-bordered table-hovered">
	            		<thead>
		            		<tr>
		            			<th>No</th>
		            			<th>NIM</th>
		            			<th>Nama</th>
		            			<th>Status Skripsi</th>
		            			<th>Pilihan</th>
		            		</tr>
		            	</thead>
		            	<tbody>
		            		@foreach ($data_skripsi as $item)
		            			<tr>
		            				<td>{{ $loop->index + 1 }}</td>
		            				<td>{{ $item->nim }}</td>
		            				<td>{{ $item->mahasiswa->nama }}</td>
		            				<td>{{ $item->status_skripsi->status }}</td>
		            				<td>
		            					<div class="btn-group">
		            						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expand="false"></button>
		            						<ul class="dropdown-menu">
		            							<li>
		            								<a href="{{ route('akademik.data-skripsi.ubah-judul', $item->id) }}">Ubah Judul</a>
		            							</li>
		            							<li>
		            								<a href="{{ route('akademik.sutgas-pembimbing.create') }}">Ubah Pembimbing</a>
		            							</li>
		            						</ul>
		            					</div>
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
		})
	</script>
@endsection

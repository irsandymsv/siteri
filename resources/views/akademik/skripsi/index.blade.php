@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Data Skripsi
@endsection

@section('css_link')
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.btn-group{
			width: 100%;
		}

		/*.btn-group button{
			width: 100%;
			text-align: left;
		}*/

		/*.btn-group button i{
			float: right;
		}*/

	</style>
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
		            					@if ($item->status_skripsi->status == "Sudah Lulus")
		            						-
		            					@else
		            						<div class="btn-group">
			            						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expand="false">Pilih <i class="fa fa-caret-down"></i></button>
			            						<ul class="dropdown-menu">
			            							<li>
			            								<a href="{{ route('akademik.data-skripsi.ubah-judul', $item->id) }}">Ubah Judul</a>
			            							</li>
			            							<li>
			            								<a href="{{ route('akademik.data-skripsi.ubah-judul-pembimbing', $item->id) }}">Ubah Judul & Pembimbing</a>
			            							</li>
			            							<li>
			            								<a href="{{ route('akademik.data-skripsi.update-judul', $item->id) }}">Update Judul</a>
			            							</li>
			            							@if ($item->status_skripsi->status == "Sudah Punya Penguji")
			            								<li>
			            									<a href="{{ route('akademik.data-skripsi.edit-status', $item->id) }}">Edit Status</a>
			            								</li>
			            							@endif
			            						</ul>
			            					</div>
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
		})
	</script>
@endsection

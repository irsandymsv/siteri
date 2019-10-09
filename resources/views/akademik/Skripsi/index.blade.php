@extends('akademik.akademik_view')

@section('page_title')
	Daftar Semua SK skripsi
@endsection

@section('judul_header')
	SK Skripsi
@endsection

@section('content')
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Daftar SK Skripsi</h3>
	            </div>

	            <div class="box-body">
	            	<div class="table-responsive">
	            		<table id="tbl_data1" class="table table-bordered table-hovered">
		            		<thead>
			            		<tr>
			            			<th>No</th>
			            			<th>Tanggal Dibuat</th>
			            			<th>Status</th>
			            			<th>Verifikasi KTU</th>
			            			<th>Verifikasi Dekan</th>
			            			<th>Pilihan</th>
			            		</tr>
			            	</thead>
			            	<tbody>
			            		@php $no = 0 @endphp
			            		@foreach($sk_akademik as $item)
			            			<tr>
			            				<td>{{$no+=1}}</td>
			            				<td>
			            					{{Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
			            				</td>
			            				<td>{{$item->status_sk_akademik->status}}</td>
			            				<td>
			            					@if($item->verif_ktu == 0) 
			            						<label class="label bg-red">Belum Diverifikasi</label> 
			            					@else 
			            						<label class="label bg-green">Sudah Diverifiaksi</label>
			            					@endif
			            				</td>
			            				<td>
			            					@if($item->verif_dekan == 0) 
			            						<label class="label bg-red">Belum Diverifikasi</label> 
			            					@else 
			            						<label class="label bg-green">Sudah Diverifiaksi</label>
			            					@endif
			            				</td>
			            				<td>
			            					<a href="{{ route('akademik.skripsi.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					@if($item->verif_dekan == 0)
			            					<a href="{{ route('akademik.skripsi.edit', $item->id) }}" class="btn btn-warning" title="Ubah SK"><i class="fa fa-edit"></i></a>
			            					@endif
			            					<a href="#" class="btn btn-danger" title="Hapus SK"><i class="fa fa-trash"></i></a>
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
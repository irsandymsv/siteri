@extends('akademik.akademik_view')

@section('judul_header')
	SK Skripsi
@endsection

@section('content')
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-warning">
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
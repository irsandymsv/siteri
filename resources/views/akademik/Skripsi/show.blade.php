@extends('akademik.akademik_view')

@section('page_title')
Data SK Skripsi
@endsection

@section('css_link')
	<style type="text/css">
		.proges_wrap{
			padding: 8px;
			overflow: hidden;
		}
	</style>
@endsection

@section('judul_header')
	Detail SK Skripsi 
@endsection

@section('content')
	
	<div class="row">
		<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Progress SK Skripsi Ini</h3>

	              <div class="box-tools pull-right">
	                <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
	                </button>
	                <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
	                </button>
	              </div>
	            </div>

	            <div class="box-body">
	            	<h5>Tanggal Dibuat : 09 Oktober 2019</h5>
	            	<h5>Progres :</h5>
	            	<div class="proges_wrap">
	            		<div class="progres_card">
	            			<ul class="timeline">
					            <!-- timeline item -->
					            <li id="progres_1">
					              <i class="fa bg-grey"></i>

					              <div class="timeline-item">
					                <h3 class="timeline-header">SK Disimpan</h3>
					              </div>
					            </li>

					            <li id="progres_2">
					              <i class="fa bg-grey"></i>

					              <div class="timeline-item">
					                <h3 class="timeline-header">SK Telah Dikirim</h3>
					              </div>
					            </li>

					            <li id="progres_3">
					              <i class="fa bg-grey"></i>

					              <div class="timeline-item">
					                <h3 class="timeline-header">SK Telah Disetujui KTU</h3>
					              </div>
					            </li>

					            <li id="progres_4">
					              <i class="fa bg-grey"></i>

					              <div class="timeline-item">
					                <h3 class="timeline-header">SK Telah Disetujui Dekan</h3>
					              </div>
					            </li>
					            <!-- END timeline item -->
					          </ul>
	            		</div>
	            		
	            	</div>
	            </div>
      		</div>
      	</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
	              <h3 class="box-title">Data SK Skripsi</h3>

	              <div class="form-group" style="float: right;">
	            	<a href="{{ route('akademik.skripsi.edit', $data->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
	              </div>
	            </div>

	            <div class="box-body">
	            	<div class="table-responsive">
	            		<table id="dataTable" class="table table-bordered table-hovered">
		            		<thead>
			            		<tr>
			            			<th>Nama Mahasiswa</th>
			            			<th>NIM</th>
			            			<th>Jurusan</th>
			            			<th>Judul</th>
			            			<th>Pembimbing</th>
			            			<th>Penguji</th>
			            		</tr>
			            	</thead>
			            	<tbody>
			            		
			            	</tbody>
			            </table>

			            <div class="form-group" style="float: right;">
			            	<a href="{{ route('akademik.skripsi.edit', $data->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
			            </div>
	            	</div>
	            </div>
      		</div>
      	</div>
	</div>

@endsection

@section('script')
<script type="text/javascript">
	var status = @json($data->status);
	for (var i = status; i > 0; i--) {
		$("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
	}
</script>
@endsection
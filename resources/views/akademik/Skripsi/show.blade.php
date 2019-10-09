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

		.tbl_row{
			display: table;
			width: 100%;
			border-bottom: 0.1px solid lightgrey;
			margin-top: 5px;
		}

		/*.tbl_row div{
			display: table-cell;
		}*/
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

	              @if($sk_akademik->verif_dekan == 0)
		              <div class="form-group" style="float: right;">
		            	<a href="{{ route('akademik.skripsi.edit', $sk_akademik->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
		              </div>
	              @endif
	            </div>

	            <div class="box-body">
	            	<div class="table-responsive">
	            		<table id="dataTable" class="table table-bordered table-hover">
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
			            		@foreach($detail_sk as $item)
		            			<tr>
		            				<td>{{$item->nama_mhs}}</td>
		            				<td>{{$item->nim}}</td>
		            				<td>{{$item->bagian->bagian}}</td>
		            				<td>{{$item->judul}}</td>
		            				<td >
		            					<div class="tbl_row">
	            							1. {{$item->pembimbing->pembimbing_utama->nama}}
	            						</div>
	            						<div class="tbl_row">
	            							2. {{$item->pembimbing->pembimbing_pendamping->nama}}
	            						</div>	
		            				</td>
		            				<td>
		            					<div class="tbl_row">
		            						1. {{$item->penguji->penguji_utama->nama}}	
		            					</div>
		            					<div class="tbl_row">
		            						2. {{$item->penguji->penguji_pendamping->nama}}	
		            					</div>
		            				</td>
		            			</tr>
			            		@endforeach
			            	</tbody>
			            </table>

			            @if($sk_akademik->verif_dekan == 0)
			              <br>
			              <div class="form-group" style="float: right;">
			            	<a href="{{ route('akademik.skripsi.edit', $sk_akademik->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
			              </div>
		              	@endif
	            	</div>
	            </div>
      		</div>
      	</div>
	</div>

@endsection

@section('script')
<script type="text/javascript">
	var status = @json($sk_akademik->id_status_sk_akademik);
	for (var i = status; i > 0; i--) {
		$("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
	}
</script>
@endsection
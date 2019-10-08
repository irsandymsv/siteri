@extends('akademik.akademik_view')

@section('judul_header')
	SK Skripsi
@endsection

@section('content')
	<section class="content">

    	<div class="row">
	      	<div class="col-xs-12">
	      		<div class="box box-warning">
	      			<div class="box-header">
		              <h3 class="box-title">Daftar SK Penguji Skripsi</h3>
		            </div>

		            <div class="box-body">
		            	<div class="table-responsive">
		            		<table id="tbl_data" class="table table-bordered table-hovered">
			            		<tr>
			            			<th>No</th>
			            			<th>Tanggal Dibuat</th>
			            			<th>Status</th>
			            			<th>Verifikasi KTU</th>
			            			<th>Verifikasi Dekan</th>
			            			<th>Pilihan</th>
			            		</tr>

			            		<tr>
			            			
			            		</tr>
				            </table>
		            	</div>
		            </div>
	      		</div>
	      	</div>
    	</div>

    	<div class="row">
	      	<div class="col-xs-12">
	      		<div class="box box-success">
	      			<div class="box-header">
		              <h3 class="box-title">Daftar SK Pembimbing Skripsi </h3>
		            </div>

		            <div class="box-body">
		            	<div class="table-responsive">
		            		<table id="tbl_data" class="table table-bordered table-hovered">
			            		<tr>
			            			<th>No</th>
			            			<th>Tanggal Dibuat</th>
			            			<th>Status</th>
			            			<th>Verifikasi KTU</th>
			            			<th>Verifikasi Dekan</th>
			            			<th>Pilihan</th>
			            		</tr>

			            		<tr>
			            			
			            		</tr>
				            </table>
		            	</div>
		            </div>
	      		</div>
	      	</div>
    	</div>

  </section>
@endsection
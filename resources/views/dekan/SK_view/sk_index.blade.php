@extends('dekan.dekan_view')

@section('page_title')
	@if($tipe == "SK Skripsi")
		Daftar Semua SK skripsi
	@else
		Daftar Semua SK Sempro
	@endif
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('judul_header')
	@if($tipe == "SK Skripsi")
		SK Skripsi
	@else
		SK Sempro
	@endif
@endsection

@section('content')
<p style="color: red;">{{session('error')}}</p>

@php
	Session::forget('error');
@endphp
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Daftar SK {{ ($tipe == "SK Skripsi"? 'Skripsi' : 'Sempro') }}</h3>

	              @if(session()->has('verif_dekan'))
	              <div class="alert alert-info alert-dismissible" style="width: 35%; margin: auto;">
	                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	                <h4><i class="icon fa fa-info"></i> Berhasil</h4>
		            {{session('verif_dekan')}}
		          </div>
		          @endif 

		          @php 
		          	Session::forget('verif_dekan'); 
		          @endphp
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
			            			<th>Aksi</th>
			            		</tr>
			            	</thead>
			            	<tbody>
			            		@php $no = 0 @endphp
			            		@foreach($sk_akademik as $item)
			            			<tr id="sk_{{$item->id}}">
			            				<td>{{$no+=1}}</td>
			            				<td>
			            					{{Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
			            				</td>
			            				<td>{{$item->status_sk_akademik->status}}</td>
			            				<td>
			            					@if($item->verif_ktu == 0) 
			            						Belum Diverifikasi
			            					@elseif($item->verif_ktu == 2) 
			            						<label class="label bg-red">Butuh Revisi</label>
			            					@else
			            						<label class="label bg-green">Sudah Diverifikasi</label>
			            					@endif
			            				</td>
			            				<td>
			            					@if($item->verif_dekan == 0) 
			            						Belum Diverifikasi
			            					@elseif($item->verif_dekan == 2) 
			            						<label class="label bg-red">Butuh Revisi</label> 
			            					@else
			            						<label class="label bg-green">Sudah Diverifikasi</label>
			            					@endif
			            				</td>
			            				<td>
			            					@if($tipe == "SK Skripsi")
			            					<a href="{{ route('dekan.sk-skripsi.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					@else
			            					<a href="{{ route('dekan.sk-sempro.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					@endif
			            					{{-- <a href="#" class="btn btn-success" id="{{ $item->id }}" name="verif_sk" title="Setujui SK" data-toggle="modal" data-target="#modal-success"><i class="fa fa-check"></i></a> --}}
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

	<div id="success_verif" class="pop_up_info">
        <h4><i class="icon fa fa-check"></i>  <span></span></h4>
    </div>

	<div class="modal modal-success fade" id="modal-success">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi persetujuan</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin menyetujui SK ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>           
			<button type="button" id="verifBtn" data-dismiss="modal" class="btn btn-outline">Setujui</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
	<script type="text/javascript">
		$(function() {
			$('#tbl_data1').DataTable()

			$("a[name='verif_sk']").click(function(event) {
				event.preventDefault();
				var id_sk = $(this).attr('id');
				
				$('div.modal-footer').off().on('click', '#verifBtn', function(event) {
					$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});

					$.ajax({
						url: '',
						type: 'POST',
						// dataType: '',
						data: {_method: 'PUT'},
					})
					.done(function(hasil) {
						console.log("success");
						// $("tr#sk_"+id_sk).hide();
						$("#success_verif").show();
						$("#success_verif").find('span').html(hasil);
						$("#success_verif").fadeOut(1800);
					})
					.fail(function() {
						console.log("error");
					});
				});
			
			});
		})
	</script>
@endsection
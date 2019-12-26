@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

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

              <div style="float: right;">
            	<a href="{{ ($tipe == "SK Skripsi"? route('akademik.skripsi.create') : route('akademik.sempro.create')) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Buat SK Baru</a>
              </div>
            </div>

            <div class="box-body">
            	<div class="table-responsive">
            		<table id="tbl_data1" class="table table-bordered table-hovered">
	            		<thead>
		            		<tr>
		            			<th>No</th>
		            			@if($tipe == "SK Skripsi")
			            			<th>No Surat SK Pembimbing</th>
			            			<th>No Surat SK Penguji</th>
		            			@else
		            				<th>No Surat</th>
		            			@endif
		            			<th>Tanggal Dibuat</th>
		            			<th>Status</th>
		            			<th>Verifikasi KTU</th>
		            			{{-- <th>Verifikasi Dekan</th> --}}
		            			<th>Pilihan</th>
		            		</tr>
		            	</thead>
		            	<tbody>
		            		@foreach($sk as $item)
		            			<tr id="{{ ($tipe == "SK Skripsi"? 'sk_'.$item->id:'sk_'.$item->no_surat) }}">
		            				<td>{{$loop->index + 1}}</td>
		            				@if($tipe == "SK Skripsi")
			            				<td>{{ $item->no_surat_pembimbing }}//UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
			            				<td>{{ $item->no_surat_penguji }}//UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
		            				@else
		            					<td>{{ $item->no_surat }}//UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
		            				@endif
		            				<td>
		            					{{Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
		            				</td>
		            				<td>{{$item->status_sk->status}}</td>
		            				<td>
		            					@if($item->verif_ktu == 0)
		            						Belum Diverifikasi
		            					@elseif($item->verif_ktu == 2)
		            						<label class="label bg-red">Butuh Revisi</label>
		            					@else
		            						<label class="label bg-green">Sudah Diverifikasi</label>
		            					@endif
		            				</td>
		            				{{-- <td>
		            					@if($item->verif_dekan == 0)
		            						Belum Diverifikasi
		            					@elseif($item->verif_dekan == 2)
		            						<label class="label bg-red">Butuh Revisi</label>
		            					@else
		            						<label class="label bg-green">Sudah Diverifikasi</label>
		            					@endif
		            				</td> --}}
		            				<td>
		            					@if($tipe == "SK Skripsi")
		            						<a href="{{ route('akademik.skripsi.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					@if($item->verif_ktu != 1)
			            					<a href="{{ route('akademik.skripsi.edit', $item->id) }}" class="btn btn-warning" title="Ubah SK"><i class="fa fa-edit"></i></a>
			            					@endif
						              	@else
						              		<a href="{{ route('akademik.sempro.show', $item->no_surat) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					@if($item->verif_ktu != 1)
			            					<a href="{{ route('akademik.sempro.edit', $item->no_surat) }}" class="btn btn-warning" title="Ubah SK"><i class="fa fa-edit"></i></a>
			            					@endif
						              	@endif

<<<<<<< HEAD
						              	{{-- @if($item->verif_ktu != 1)
		            					<a href="#" class="btn btn-danger" id="{{ ($tipe == "SK Skripsi"? $item->id : $item->no_surat) }}" name="delete_sk" title="Hapus SK" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash"></i></a>
											@endif --}}

											@if ($item->verif_ktu == 1)
	                    					<a href="{{ ($tipe == "SK Skripsi"? route('akademik.skripsi.cetak', $item->id) : route('akademik.sempro.cetak', $item->no_surat)) }}" id="{{ $item->id }}" name="cetak_sk" class="btn btn-info" title="Cetak SK"><i class="fa fa-print"></i></a>
						  					@endif
=======
						              	@if($item->verif_dekan != 1)
		            					<a href="#" class="btn btn-danger" id="{{ $item->id }}" name="delete_sk" title="Hapus SK" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash"></i></a>
										@endif

										@if ($item->verif_dekan == 1)
                    					<a href="{{ route('akademik.skripsi.cetak', $item->id) }}" id="{{ $item->id }}" name="cetak_sk" class="btn btn-info" title="Cetak SK"><i class="fa fa-print"></i></a>
					  					@endif
>>>>>>> ae6e48a7bd5524d0144a461d36e9981390439304
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

	<div id="success_delete" class="pop_up_info">
        <h4><i class="icon fa fa-check"></i>  <span></span></h4>
    </div>

	<div class="modal modal-danger fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi Penghapusan</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus data SK ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
			<button type="button" id="hapusBtn" data-dismiss="modal" class="btn btn-outline">Hapus SK</button>
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

			$("a[name='delete_sk']").click(function(event) {
				event.preventDefault();
				var id_sk = $(this).attr('id');

				@if($tipe == "SK Skripsi")
				var url_del = "{{route('akademik.skripsi.destroy')}}" + '/' + id_sk;
				@else
				var url_del = "{{route('akademik.sempro.destroy')}}" + '/' + id_sk;
				@endif
				console.log(url_del);

				$('div.modal-footer').off().on('click', '#hapusBtn', function(event) {
					$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});

					$.ajax({
						url: url_del,
						type: 'POST',
						// dataType: '',
						data: {_method: 'DELETE'},
					})
					.done(function(hasil) {
						console.log("success");
						$("tr#sk_"+id_sk).hide();
						$("#success_delete").show();
						$("#success_delete").find('span').html(hasil);
						$("#success_delete").fadeOut(1800);
					})
					.fail(function() {
						console.log("error");
					});
				});

			});
		})
	</script>
@endsection

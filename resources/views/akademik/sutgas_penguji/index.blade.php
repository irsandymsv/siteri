@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Surat Tugas Penguji Skripsi
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
@endsection

@section('judul_header')
	Surat Tugas Penguji Skripsi
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-success">
   			<div class="box-header">
              <h3 class="box-title">Daftar Surat Tugas Penguji Skripsi</h3>

              <div style="float: right;">
            	<a href="{{ route('akademik.sutgas-penguji.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Surat Tugas</a>
              </div>
              <br><br>
               @if (session('success'))
               <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-check"></i> Sukses</h4>
                   {{session('success')}}
               </div>
               @php
               Session::forget('success');
               @endphp

               @endif
               @if (session('error'))
               <div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-ban"></i>Error</h4>
                   {{session('error')}}
               </div>

               @php
               Session::forget('error');
               @endphp
               @endif
            </div>

            <div class="box-body">
            	<div class="table-responsive">
            		<table id="table_data1" class="table table-bordered table-hovered">
	            		<thead>
		            		<tr>
		            			<th>No</th>
		            			<th>No Surat</th>
		            			<th>Status</th>
		            			<th>Nama Mahasiswa</th>
		            			<th>Verifikasi KTU</th>
		            			<th>Tanggal Dibuat</th>
		            			<th>Pilihan</th>
		            		</tr>
		            	</thead>
		            	<tbody>
		            		@foreach ($surat_tugas as $item)
		            			<tr>
		            				<td>{{ $loop->index + 1 }}</td>
		            				<td>
		            					{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
		            				</td>
		            				<td>{{ $item->status_surat_tugas->status }}</td>
		            				<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
		            				<td>
		            					@if ($item->verif_ktu == 0)
		            						Belum Diverifikasi
		            					@elseif($item->verif_ktu == 2)
		            						<label class="label bg-red">Butuh Revisi</label>
		            					@else
		            						<label class="label bg-green">Sudah Diverifikasi</label>
		            					@endif
		            				</td>
		            				<td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
		            				<td>
		            					<a href="{{ route('akademik.sutgas-penguji.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
		            					<a href="{{ route('akademik.sutgas-penguji.edit', $item->id) }}" class="btn btn-warning" title="Ubah Surat Tugas"><i class="fa fa-edit"></i></a>

		            					@if ($item->verif_ktu == 1)
		            					<a href="{{ route("akademik.sutgas-penguji.cetak", $item->id) }}" class="btn bg-teal" title="Download PDF"><i class="fa fa-print"></i></a>
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
            <p>Apakah anda yakin ingin menghapus surat tugas ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
			<button type="button" id="hapusBtn" data-dismiss="modal" class="btn btn-outline">Hapus</button>
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

			$("a[name='delete_sk']").click(function(event) {
				event.preventDefault();
				var id_sk = $(this).attr('id');
				var url_del = "";

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

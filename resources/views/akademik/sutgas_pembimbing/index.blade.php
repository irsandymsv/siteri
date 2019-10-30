@extends('akademik.akademik_view')

@section('page_title')
	Surat Tugas Pembimbing
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('judul_header')
	Surat Tugas Pembimbing
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-success">
   			<div class="box-header">
              <h3 class="box-title">Daftar Surat Tugas Pembimbing</h3>
            
              <div style="float: right;">
            	<a href="{{ route('akademik.sutgas-pembimbing.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Surat Tugas</a>
              </div>
            </div>

            <div class="box-body">
            	<div class="table-responsive">
            		<table id="table_data1" class="table table-bordered table-hovered">
	            		<thead>
		            		<tr>
		            			<th>No</th>
		            			<th>No Surat</th>
		            			<th>Tanggal Dibuat</th>
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
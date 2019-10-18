@extends('dekan.dekan_view')

@section('page_title')
	@if($sk_akademik->tipe_sk->tipe == "SK Skripsi")
		Detail SK skripsi
	@else
		Detail SK Sempro
	@endif
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

		#tgl_sk{
			margin-top: 15px;
		}
	</style>
@endsection

@section('judul_header')
	@if($sk_akademik->tipe_sk->tipe == "SK Skripsi")
		SK Skripsi
	@else
		SK Sempro
	@endif
@endsection

@section('content')
	
	{{-- <div class="row">
		<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Progress SK {{ ($sk_akademik->tipe_sk->tipe == "SK Skripsi"? "Skripsi" : "Sempro") }} Ini</h3>

	              <div class="box-tools pull-right">
	                <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
	                </button>
	                <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
	                </button>
	              </div>
	            </div>

	            <div class="box-body">
	            	<h5>Tanggal Dibuat : {{Carbon\Carbon::parse($sk_akademik->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>
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
	</div> --}}

	<div class="row">
		<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
      				<h3 class="box-title">Data SK {{ ($sk_akademik->tipe_sk->tipe == "SK Skripsi"? "Skripsi" : "Sempro") }} </h3>

		            @if($sk_akademik->verif_dekan != 1)
		              <div class="form-group" style="float: right;">
		              	<form method="post" action="{{ ( $sk_akademik->tipe_sk->tipe == "SK Skripsi"? route('dekan.sk-skripsi.verif', $sk_akademik->id) : route('dekan.sk-sempro.verif', $sk_akademik->id) ) }}">
		              		@csrf
		              		@method('put')
		              		<input type="hidden" name="verif_dekan" value="{{$sk_akademik->verif_dekan}}">
		              		<button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>
		              		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik SK</button>
		              	</form>
		              </div>
		            @endif
		            
	              	<div id="tgl_sk">
	              		<h5><b>Tanggal Dibuat</b> : {{Carbon\Carbon::parse($sk_akademik->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>

		              	@if($sk_akademik->verif_dekan == 0)
							<b>Belum Diverifikasi</b>
							@elseif($sk_akademik->verif_dekan == 2) 
								<label class="label bg-red">Butuh Revisi</label>
							@else
								<label class="label bg-green">Sudah Diverifikasi</label>
							@endif
	              	</div>
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
			            			<th>
			            				@if($sk_akademik->tipe_sk->tipe == "SK Skripsi")
			            					Penguji
			            				@else
			            					Pembahas
			            				@endif
			            			</th>
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
	            							1. {{$item->pembimbing_utama->nama}}
	            						</div>
	            						<div class="tbl_row">
	            							2. {{$item->pembimbing_pendamping->nama}}
	            						</div>	
		            				</td>
		            				<td>
		            					<div class="tbl_row">
		            						1. {{$item->penguji_utama->nama}}	
		            					</div>
		            					<div class="tbl_row">
		            						2. {{$item->penguji_pendamping->nama}}	
		            					</div>
		            				</td>
		            			</tr>
			            		@endforeach
			            	</tbody>
			            </table>

			            @if($sk_akademik->verif_dekan != 1)
			              <br>
			               <div class="form-group" style="float: right;">
			              	<form method="post" action="{{ ( $sk_akademik->tipe_sk->tipe == "SK Skripsi"? route('dekan.sk-skripsi.verif', $sk_akademik->id) : route('dekan.sk-sempro.verif', $sk_akademik->id) ) }}">
			              		@csrf
			              		@method('put')
			              		<input type="hidden" name="verif_dekan" value="{{$sk_akademik->verif_dekan}}">
			              		<button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>	
			              		<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik SK</button>
			              	</form>
			              </div>
		              	@endif
	            	</div>
	            </div>
      		</div>
      	</div>
	</div>

	<div class="modal fade" id="modal-tarik-sk">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-red">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pesan Penarikan SK</h4>
          </div>
          <form method="post" action="{{ ( $sk_akademik->tipe_sk->tipe == "SK Skripsi"? route('dekan.sk-skripsi.verif', $sk_akademik->id) : route('dekan.sk-sempro.verif', $sk_akademik->id) ) }}">
          	@csrf
          	@method('PUT')
	          <div class="modal-body">
	            <label for="pesan_revisi">Masukkan Pesan Revisi</label>
	            <textarea name="pesan_revisi" id="pesan_revisi" class="form-control">{{old('pesan_revisi')}}</textarea>
	            <input type="hidden" name="verif_dekan" value="{{$sk_akademik->verif_dekan}}">

	            @error('pesan_revisi')
	            	<p style="color: red;">{{ $message }}</p>
	            @enderror
	          </div>
	          <div class="modal-footer">
	            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>           
				<button type="submit" name="tarik_btn" class="btn btn-danger">Tarik SK</button>
	          </div>
      	  </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

@endsection

@section('script')
<script type="text/javascript">
	@error('pesan_revisi')
		$("#modal-tarik-sk").modal("show");
	@enderror
	
	var status = @json($sk_akademik->id_status_sk_akademik);
	for (var i = status; i > 0; i--) {
		$("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
	}

	$("button[name='setuju_btn']").click(function(event) {
		event.preventDefault();
		$("input[name='verif_dekan']").val(1);
		$(this).parents("form").trigger('submit');
	});

	$("button[name='tarik_btn']").click(function(event) {
		event.preventDefault();
		$("input[name='verif_dekan']").val(2);
		$(this).parents("form").trigger('submit');
	});
</script>
@endsection
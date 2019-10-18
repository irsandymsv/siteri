@extends('akademik.akademik_view')

@section('page_title')
	@if($sk_akademik->tipe_sk->tipe == "SK Skripsi")
		Detail SK skripsi
	@else
		Detail SK Sempro
	@endif
@endsection

@section('css_link')
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.tbl_row{
			display: table;
			width: 100%;
			border-bottom: 0.1px solid lightgrey;
			margin-top: 5px;			
		}

		.revisi_wrap{
        margin-top: 5px;
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
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
	
	<div class="row">
		<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Progress SK {{ ($sk_akademik->tipe_sk->tipe == "SK Skripsi"? "Skripsi" : "Sempro") }} Ini</h3>
              	  <span style="margin-left: 5px;">
	            	@if($sk_akademik->verif_ktu == 2) 
							<label class="label bg-red">Butuh Revisi (KTU)</label>
						@elseif($sk_akademik->verif_dekan == 2) 
							<label class="label bg-red">Butuh Revisi (Dekan)</label>
						@else
						@endif
					  </span>
	          	  

	              <div class="box-tools pull-right">
	                <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
	                </button>
	                <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
	                </button>
	              </div>
	            </div>

	            <div class="box-body">
            		<h5><b>Tanggal Dibuat</b> : {{Carbon\Carbon::parse($sk_akademik->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>
            	
	            	<h5><b>Progres</b> :</h5>
	            	<div class="tl_wrap">
	            	  <div class="item_tl" id="progres_1">
	            	    <div><i class="fa fa-check"></i></div>
	            	    <h4>Disimpan</h4>
	            	  </div>

	            	  <div class="item_tl" id="progres_2">
	            	    <div><i></i></div>
	            	    <h4>Dikirim</h4>
	            	  </div>

	            	  <div class="item_tl" id="progres_3">
	            	    <div><i></i></div>
	            	    <h4>Disetujui KTU</h4>
	            	  </div>

	            	  <div class="item_tl" id="progres_4">
	            	    <div><i></i></div>
	            	    <h4>Disetujui Dekan</h4>
	            	  </div>
	            	</div>

         			@if(!is_null($sk_akademik->pesan_revisi))
         			<div class="revisi_wrap">
            			<h5><b>Pesan Revisi</b> : </h5>
         				<p>"{{ $sk_akademik->pesan_revisi }}"</p>
         			</div>
         			@endif
	            	
	            </div>
      		</div>
      	</div>
	</div>

	<div class="row">
		<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
	              <h3 class="box-title">Data SK {{ ($sk_akademik->tipe_sk->tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}</h3>

	              @if($sk_akademik->verif_dekan != 1)
		              <div class="form-group" style="float: right;">
		              	<a href="{{ ($sk_akademik->tipe_sk->tipe == "SK Skripsi"? route('akademik.skripsi.edit', $sk_akademik->id) : route('akademik.sempro.edit', $sk_akademik->id)) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
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
	            	</div>
	            	
	            	 @if($sk_akademik->verif_dekan != 1)
		              <br>
		              <div class="form-group" style="float: right;">
		            	<a href="{{ ($sk_akademik->tipe_sk->tipe == "SK Skripsi"? route('akademik.skripsi.edit', $sk_akademik->id) : route('akademik.sempro.edit', $sk_akademik->id)) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
		              </div>
	              	@endif
	            </div>
      		</div>
      	</div>
	</div>

@endsection

@section('script')
<script src="/js/btn_backTop.js"></script>
<script type="text/javascript">
	var status = @json($sk_akademik->id_status_sk_akademik);
	for (var i = status; i > 0; i--) {
		// $("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
		$("#progres_"+i).addClass('verified');
      $("#progres_"+i).find('i').addClass('fa fa-check');
	}
</script>
@endsection
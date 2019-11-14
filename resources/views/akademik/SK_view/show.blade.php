@extends('akademik.akademik_view')

@section('page_title')
	@if($tipe == "SK Skripsi")
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
        padding: 5px;
      }
	</style>
@endsection

@section('judul_header')
	@if($tipe == "SK Skripsi")
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
	              <h3 class="box-title">Progress SK {{ ($tipe == "SK Skripsi"? "Skripsi" : "Sempro") }} Ini</h3>
              	  <span style="margin-left: 5px;">
	            	@if($sk->verif_ktu == 2) 
							<label class="label bg-red">Butuh Revisi (KTU)</label>
						@elseif($sk->verif_dekan == 2) 
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
						@if ($sk->verif_dekan == 1)
							<div class="form-group" style="float: right;">
		                    	<a href="{{ route('akademik.skripsi.cetak', $sk->id) }}" class="btn btn-info"><i class="fa fa-print"></i> Cetak</a>
							</div>
						@endif
						<h5><b>Nomor Surat</b> : {{$sk->no_surat}}/UN 25.1.15/SP/{{Carbon\Carbon::parse($sk->created_at)->year}}</h5>
            		<h5><b>Tanggal Dibuat</b> : {{Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>
            		<h5><b>Tanggal Sempro 1</b> : {{Carbon\Carbon::parse($sk->tgl_sempro1)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>
            		<h5><b>Tanggal Sempro 2</b> : {{Carbon\Carbon::parse($sk->tgl_sempro2)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>
            		
            		<br>
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

	            	  {{-- <div class="item_tl" id="progres_4">
	            	    <div><i></i></div>
	            	    <h4>Disetujui Dekan</h4>
	            	  </div> --}}
	            	</div>

         			@if(!is_null($sk->pesan_revisi))
         			<div class="revisi_wrap">
            			<h4><b>Pesan Revisi</b> : </h4>
         				<blockquote>
         					<p>{{ $sk->pesan_revisi }}</p>
         				</blockquote>
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
	              <h3 class="box-title">Data SK {{ ($tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}</h3>

	              @if($sk->verif_ktu != 1)
		              <div class="form-group" style="float: right;">
		              	<a href="{{ ($tipe == "SK Skripsi"? route('akademik.skripsi.edit', $sk->no_surat) : route('akademik.sempro.edit', $sk->no_surat)) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
		              </div>
	              @endif
	            </div>

	            <div class="box-body">
	            	<div class="table-responsive">
	            		<table id="dataTable" class="table table-bordered table-hover">
		            		<thead>
			            		<tr>
			            			<th>No</th>
			            			<th>NIM</th>
			            			<th>Nama Mahasiswa</th>
			            			<th>Jurusan</th>
			            			<th>Judul</th>
			            			@if ($tipe == "sk skripsi")
			            			<th>Pembimbing</th>
			            			@endif
			            			<th>
			            				@if($tipe == "SK Skripsi")
			            					Penguji
			            				@else
			            					Pembahas
			            				@endif
			            			</th>
			            		</tr>
			            	</thead>
			            	<tbody>
			            		@php $no = 0; @endphp
			            		@foreach($detail_skripsi as $item)
		            			<tr>
		            				<th>{{ $no+=1 }}</th>
		            				<td>{{$item->skripsi->nim}}</td>
		            				<td>{{$item->skripsi->mahasiswa->nama}}</td>
		            				<td>{{$item->skripsi->mahasiswa->bagian->bagian}}</td>
		            				<td>{{$item->judul}}</td>
		            				@if ($tipe == "SK Skripsi")
		            				<td >
		            					<div class="tbl_row">
	            							1. {{$item->surat_tugas[0]->dosen1->nama}}
	            						</div>
	            						<div class="tbl_row">
	            							2. {{$item->surat_tugas[0]->dosen2->nama}}
	            						</div>	
		            				</td>
		            				@endif
		            				
		            				<td>
		            					<div class="tbl_row">
		            						1. {{$item->surat_tugas[0]->dosen1->nama}}
		            					</div>
		            					<div class="tbl_row">
		            						2. {{$item->surat_tugas[0]->dosen2->nama}}
		            					</div>
		            				</td>
		            			</tr>
			            		@endforeach
			            	</tbody>
			            </table> 
	            	</div>
	            	
	            	 @if($sk->verif_ktu != 1)
		              <br>
		              <div class="form-group" style="float: right;">
		            	<a href="{{ ($tipe == "SK Skripsi"? route('akademik.skripsi.edit', $sk->no_surat) : route('akademik.sempro.edit', $sk->no_surat)) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</a>
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
	var status = @json($sk->id_status_sk);
	for (var i = status; i > 0; i--) {
		// $("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
		$("#progres_"+i).addClass('verified');
      $("#progres_"+i).find('i').addClass('fa fa-check');
	}
</script>
@endsection
@extends('ktu.ktu_view')

@section('page_title')
	Detail SK Sempro
@endsection

@section('css_link')
	<style type="text/css">
		.tbl_row{
			display: table;
			width: 100%;
			border-bottom: 0.1px solid black;
			margin-top: 5px;			
		}

		#tgl_sk{
			margin-top: 15px;
		}

		.box-body{
         width: 70%;
         margin: auto;
         margin-bottom: 20px;
         margin-top: 20px;
         font-family: 'Times New Roman';
         font-size: 16px;
         padding: 20px 50px;
         border: 1px solid black;
      }

		#kop_surat{
		   padding: 5px;
		   overflow: hidden;
		   border-bottom: 3px solid black;
		}

		#logo{
		   float: left;
		   width: 15%;
		}

		#logo img{
		   width: 100%;
		   height: auto;
		   margin-top: 10pt;

		}

		#keterangan_kop{
		   width: 85%;
		   float: left;
		   text-align: center;
		}

		#body_surat{
		   text-align: justify-all;
		}

		.top-title{
		   margin-top: 10px;
		   text-align: center;
		}

		.judul_surat{
		   font-size: 18px;
		   /*text-decoration: underline;*/
		   letter-spacing: 2pt;
		   font-weight: bold;
		}

		#detail_table{
			margin-top: 15px;
			width: 100%;
			border-collapse: collapse;
		}

		#detail_table th{
			text-align: center;
		}

		#detail_table td, th{
			border: 1px solid black;
			padding: 5px;
		}

		#detail_table td:last-child{
			padding: 0;
		}

		.ttd-right{
         float: right;
      }
	</style>
@endsection

@section('judul_header')
	SK Sempro
@endsection

@section('content')

	<div class="row">
		<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
              <h3 class="box-title">Data SK Sempro </h3>

              <div id="tgl_sk">
              		<h5><b>Tanggal Dibuat</b> : {{Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</h5>

	              	@if($sk->verif_ktu == 0)
						<b>Belum Diverifikasi</b>
						@elseif($sk->verif_ktu == 2) 
						<label class="label bg-red">Butuh Revisi</label>
						@else
						<label class="label bg-green">Sudah Diverifikasi</label>
						@endif
              </div>

              	@if(session()->has('verif_ktu'))
              	   <br><br>
              	   <div class="alert alert-success alert-dismissible" style="margin: auto;">
              	      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              	      <h4><i class="icon fa fa-check"></i> Berhasil</h4>
              	      {{session('verif_ktu')}}
              	   </div>
              	@endif
            </div>

            <div class="box-body">
            	<div id="kop_surat">
            	   <div id="logo">
            	      <img src="{{ asset('/image/logo-unej.png') }}">
            	   </div>

            	   <div id="keterangan_kop">
            	      <span class="header_18">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</span><br>
            	      <span class="header_18">UNIVERSITAS JEMBER</span><br>
            	      <span class="header_18">FAKULTAS ILMU KOMPUTER</span>

            	      <br>

            	      <span>Jalan Kalimantan No. 37 Kampus Tegal Boto Jember 68121</span><br>
            	      <span>Telepon 0331 326935, Faximile 0331 326911</span><br>
            	      <span>Website : <i class="underline">www.ilkom.unej.ac.id</i></span>
            	   </div>
            	</div>

            	<div id="body_surat">
            	   <p class="top-title">
            	      <span class="judul_surat">KEPUTUSAN</span><br>
            	      <span>DEKAN FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</span><br>
            	      <span>Nomor: {{ $sk->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($sk->created_at)->year }}</span><br>
            	      <small><b>tentang</b></small><br>
            	      <span>PENETAPAN DOSEN PEMBAHAS SEMINAR PROPOSAL SKRIPSI MAHASISWA</span><br> 
            	      <span>FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</span><br>
            	      <span>TAHUN AKADEMIK 2019/2020</span><br>
            	   </p>

            	   <p>
            	   	
            	   </p>

            	   <div class="ttd-right">
            	   	<br>
            	      Jember, {{ Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }} <br>
            	      Dekan,
            	      <br><br><br><br>
            	      <span style="text-transform: uppercase;"><b>{{ $dekan->nama }}</b></span><br>
            	      <span>NIP. {{ $dekan->no_pegawai }}</span>
            	   </div>

            	   <p style="clear: both;">Tembusan: </p>
            	   <ol>
            	      <li>Penjabat Wakil Dekan I, II;</li>
            	      <li>Kasubag. Tata Usaha;</li>
            	   </ol>
            	   <span>Fakultas Ilmu Komputer Universitas Jember.</span>

            		<table id="detail_table">
	            		<thead>
		            		<tr>
		            			<th>NIM</th>
		            			<th>Nama Mahasiswa</th>
		            			<th>Program Studi</th>
		            			<th>Judul</th>
		            			<th>Pembahas</th>
		            		</tr>
		            	</thead>
		            	<tbody>
		            		@foreach($detail_skripsi as $item)
	            			<tr>
	            				<td>{{$item->skripsi->nim}}</td>
	            				<td>{{$item->skripsi->mahasiswa->nama}}</td>
	            				<td>{{$item->skripsi->mahasiswa->bagian->bagian}}</td>
	            				<td>{{$item->judul}}</td>
	            				<td>
	            					<div class="tbl_row">
	            						{{ $item->surat_tugas[0]->dosen1->nama }}
	            					</div>
	            					<div>
	            						{{ $item->surat_tugas[0]->dosen2->nama }}	
	            					</div>
	            				</td>
	            			</tr>
		            		@endforeach
		            	</tbody>
		            </table>
            	</div>
            </div>

            <div class="box-footer">
	            @if($sk->verif_dekan != 1)
              	<form method="post" action="{{ route('ktu.sk-sempro.verif', $sk->no_surat)  }}">
              		@csrf
              		@method('put')
              		<input type="hidden" name="verif_ktu" value="{{$sk->verif_ktu}}">

              		@if ($sk->verif_ktu != 1)
              			<button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>
              			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik SK</button>
              		@endif
              	</form>
              	@endif
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
          <form method="post" action="{{ route('ktu.sk-sempro.verif', $sk->no_surat) }}">
          	@csrf
          	@method('PUT')
	          <div class="modal-body">
	            <label for="pesan_revisi">Masukkan Pesan Revisi</label>
	            <textarea name="pesan_revisi" id="pesan_revisi" class="form-control">{{old('pesan_revisi')}}</textarea>
	            <input type="hidden" name="verif_ktu" value="{{$sk->verif_ktu}}">
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

	var status = @json($sk->id_status_sk);
	for (var i = status; i > 0; i--) {
		$("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
	}

	$("button[name='setuju_btn']").click(function(event) {
		event.preventDefault();
		$("input[name='verif_ktu']").val(1);
		$(this).parents("form").trigger('submit');
	});

	$("button[name='tarik_btn']").click(function(event) {
		event.preventDefault();
		$("input[name='verif_ktu']").val(2);
		$(this).parents("form").trigger('submit');
	});

</script>
@endsection
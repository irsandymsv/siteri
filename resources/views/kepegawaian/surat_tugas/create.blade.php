@extends('kepegawaian.kepegawaian_view')

@section('page_title', 'Buat Surat Tugas')
@section('judul_header','Buat Surat Tugas')

@section('css_link')
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
<style type="text/css">
	th {
		text-align: center;
	}

	.select2-container--default .select2-selection--multiple .select2-selection__choice {
		color: #000000;
		width: 100%;
	}

	.js-example-basic-multiple {
		width: 50%;
	}
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
		<form action="{{route('kepegawaian.surat.save', $surat->id)}}" method="POST">
				<div class="box-body">
                    @csrf
                    @method('PUT')
					<div class="table-responsive">
						{{-- @if(session()->has('error'))
		            			<p style="color: red;">{{session('error')}}</p>
						@endif --}}
						<table id="tbl-data" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Surat Keluar / Masuk</th>
									<th>Perjalanan</th>
								</tr>
							</thead>
							<tbody>
								<td>
									<select name="surat_in_out" class="form-control">
                                    <option value="{{$surat->surat_in_outs['id']}}"> {{$surat->surat_in_outs['nama']}} </option>
								
									</select>
								</td>
								<td>
									<select name="perjalanan" class="form-control">
                                    <option value="{{$surat->perjalanans['id']}}"> {{$surat->perjalanans['nama']}} </option>
								
									</select>
								</td>
							</tbody>
							<thead>
								<tr>
									<th>Nomor Surat</th>
									<th>Jenis Surat Tugas</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<input class="form-control" type="text" name="nomor_surat" placeholder="Masukan nomor surat" required>
								</td>
								<td>
									<select id="jenisSurat" name="jenisSurat" class="form-control">
                                    <option value="{{$surat->jenis_surat}}"> {{$surat->jenis_sk['jenis']}} </option>
										@foreach ($jenis as $jenis)
										<option value="{{$jenis->id}}">{{$jenis->jenis}}</option>
										@endforeach
									</select>
								</td>

							</tbody>
								<th>Keterangan</th>
								<th>
									@if (count($dosen_sk) > 1)
									Dosen yang Bertugas
									@else
									Pemateri
									@endif
								</th>
							<thead>
							<tbody>
								<td>
									<textarea class="form-control" rows="3" name="keterangan"
                                placeholder="Keterangan Surat">{{$surat->keterangan}}</textarea>
								</td>
								<td>
                                    @foreach ($dosen_sk as $dosen)
								<label style="margin-top: 2px; margin-left: 5px;">{{$dosen->user['nama']}}</label><br/>
								<input name="jabatan_panitia[]" class="form-control panitia" type="text" placeholder="Jabatan Panitia" required><br/>
								<input name="dosen[]" class="form-control dosen" type="hidden" value="{{$dosen->id_dosen}}">
									@endforeach
									<ol type="1">
									@foreach ($pemateri as $pematerii)
									<li><span style="margin-top: 2px; margin-left: 5px;">{{$pematerii['nama']}}</span></li>
									@endforeach
									</ol>
									@if (count($pemateri) != null)
									<hr style="border-color: #DDDDDD;">
									<div class="form-group">
									<label style="margin-top: 2px; margin-left: 30px;">Biaya</label>
									<input style="width: 60%;" type="text" name="biaya_pemateri" class="form-control pull-right" placeholder="Masukan Biaya Pemateri"><br/>
									@endif
									
								</div>
								
								</td>
							</tbody>
							 
							</tbody>
								<th>Lokasi</th>
								<th>
								</th>
							<thead>
							<tbody>
								<td>
								<input type="text" class="form-control" value="{{$surat->lokasi}}" disabled>
								</td>
								<td>
								</td>
							</tbody>

							</thead>

							<thead>
								<tr>
								<th>Tanggal Mulai</th>
								<th>Tanggal Selesai</th>
                                </tr>     
							</thead>

							<tbody>
                                
								<td>
									<!-- Date -->
									<div class="form-group">
										<label>Date:</label>

										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
                                        <input type="text" value="{{$surat->started_at}}" class="form-control pull-right" name="started_at" id="datepicker">
										</div>
										<!-- /.input group -->
									</div>
								</td>
								<td>
									<!-- Date -->
									<div class="form-group">
										<label>Date:</label>

										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" value="{{$surat->end_at}}" class="form-control pull-right" name="end_at" id="datepicker2">
										</div>
										<!-- /.input group -->
									</div>
								</td>
							</tbody>
						</table>
					</div>

					<input type="hidden" name="status" value="">
					<div class="form-group" style="float: left;">
						<button type="submit" name="simpan_kirim" class="btn btn-success">Buat Surat</button>
						<a class="btn btn-default" href="{{route('kepegawaian.surat.index')}}">Batal</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endsection

	@section('script')
	<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
	});
	</script>
	<script type="text/javascript">
	$('#datepicker').datepicker({
	autoclose: true
	})
	$('#datepicker2').datepicker({
	autoclose: true
	})
	</script>
	
	<script>
		let i = @php
		print count($dosen_sk);
	@endphp;
	$(document).ready(function(){
		if ($("#jenisSurat").val() != 2) {
			for (let index = 0; index < i; index++) {
			$(".panitia").hide();	
		}	
		}
		
	});
	
	$(function(){
    $("#jenisSurat").change(function(){
        if ($("#jenisSurat").val() == 2 ) {
			for (let index = 0; index < i; index++) {
				$(".panitia").show();
		}
        }
    });
});
	$(function(){
    $("#jenisSurat").change(function(){
        if ($("#jenisSurat").val() == 1 ) {
			for (let index = 0; index < i; index++) {
				$(".panitia").hide();
		}
        }
    });
});
	$(function(){
    $("#jenisSurat").change(function(){
        if ($("#jenisSurat").val() == 3 ) {
			for (let index = 0; index < i; index++) {
				$(".panitia").hide();
		}
        }
    });
});
	</script>

	@endsection
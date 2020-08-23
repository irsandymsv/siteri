@extends('kepegawaian.kepegawaian_view')

@section('page_title', 'Ubah Surat Tugas')
@section('judul_header','Ubah Surat Tugas')

@section('css_link')
<link rel="stylesheet" href="{{asset('/adminlte/bower_components/select2/dist/css/select2.min.css')}}">
<link href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet" />
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

	.delicon {
    float: right;
    margin-right: 6px;
    margin-top: -33px;
    position: relative;
    z-index: 2;
  }

	#people-container {
		width: 70%;
	}

	.hapusDosen:hover{
		cursor: pointer;
	}
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<form action="{{route('kepegawaian.surat.revisian', $surat->id)}}" method="POST">
        @csrf
        @method('PUT')
				<div class="box-body">
					<div class="table-responsive">
						{{-- @if(session()->has('error'))
		            			<p style="color: red;">{{session('error')}}</p>
						@endif --}}
						<table id="tbl-data" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Surat Keluar / Masuk</th>
									<th>Perjalanan Dinas</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<select id="surat_in_out" name="surat_in_out" class="form-control" disabled>
									<option value="{{$surat->surat_in_out}}" required>{{$surat->surat_in_outs['nama']}}</option>
										@foreach ($inout as $inout)
										<option value="{{$inout->id}}">{{$inout->nama}}</option>
										@endforeach
									</select>
									<input type="hidden" name="surat_in_out" value="{{$surat->surat_in_out}}">
								</td>

								<td>
									<select id="perjalanan" name="perjalanan" class="form-control" disabled>
									<option value="{{$surat->perjalanan}}" required>{{$surat->perjalanans['nama']}}</option>
										@foreach ($perjalanan as $perjalanan)
										<option value="{{$perjalanan->id}}">{{$perjalanan->nama}}</option>
										@endforeach
									</select>
								</td>
							</tbody>

							<thead>
								<tr>
									<th>Jenis Surat Tugas</th>
									<th>Keterangan</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<select name="jenisSurat" class="form-control" id="jenisSurat">
                    {{-- <option value="{{$surat->jenis_surat}}"> {{$surat->jenis_sk['jenis']}} </option> --}}
										@foreach ($jenis as $jenis)
										<option value="{{$jenis->id}}" {{ ($jenis->id == $surat->jenis_surat)? 'selected':'' }}>{{$jenis->jenis}}</option>
										@endforeach
									</select>

									@error('jenisSurat')
										<p role="alert" style="color: red;">
											<strong>{{ $message }}</strong>
										</p>
									@enderror
								</td>

								<td>
									<textarea class="form-control" rows="3" name="keterangan" placeholder="Keterangan Surat">{{$surat->keterangan}}</textarea>
									@error('keterangan')
										<p role="alert" style="color: red;">
											<strong>{{ $message }}</strong>
										</p>
									@enderror
								</td>
							</tbody>

							<thead>
								<tr>
                  <th>
										@if (count($dosen_sk) > 0)
										Nama Dosen
										@else
										Pemateri
										@endif
									</th>

                  <th>
										@if (count($dosen_sk) > 0)
										{{-- Dosen yang bertugas --}}
										@else
										Biaya Pemateri
										@endif
									</th>
                </tr>
							</thead>

							<tbody>
								<td>
									@if (count($dosen_sk) > 0)
										{{-- <select class="js-example-basic-multiple" name="dosen[]" multiple="multiple">
											@foreach ($dosen as $dosen)
											<option value="{{$dosen->no_pegawai}}">{{$dosen->nama}}</option>
											@endforeach
										</select> --}}
										{{-- <span>Pilih Dosen : </span> &ensp; --}}
										<select class="form-control select2" style="width: 70%;" id="pilih_dosen" name="pilih_dosen">
											<option value="" disabled>-Pilih Dosen-</option>
											@foreach ($dosen as $ds)
												@if (!in_array($ds->no_pegawai, $id_dosen_tugas))
												<option value="{{$ds->no_pegawai}}">{{$ds->nama}}</option>
												@endif
											@endforeach
										</select>

										<br><br>
										<div id="dosen-container">
											@foreach ($dosen_sk as $item)
											<div id="dosen{{$item->id_dosen}}" class="daftar_dosen" id_dosen_tugas="{{$item->id_dosen}}">
												<br>
												<input type="hidden" id="input{{$item->id_dosen}}" class="form-control" name="dosen[]" value="{{$item->id_dosen}}">

												<span id="nama_dosen{{$item->id_dosen}}">
													{{ $item->user->nama }}
												</span> &ensp;
												<span class="label bg-red hapusDosen"><i class="fa fa-close"></i> Hapus</span>

												@if ($surat->jenis_surat == 2)
													<input name="jabatan_panitia[]" class="form-control panitia" type="text" placeholder="Jabatan Panitia" value="{{ $item->jabatan }}" style="margin-top: 5px; width: 30%">
												@endif
											</div>
											@endforeach	
										</div>
										
										@error('dosen')
											<p role="alert" style="color: red;">
												<strong>{{ $message }}</strong>
											</p>
										@enderror
										@error('dosen.*')
											<p role="alert" style="color: red;">
												<strong>{{ $message }}</strong>
											</p>
										@enderror

										@error('jabatan_panitia')
											<p role="alert" style="color: red;">
												<strong>{{ $message }}</strong>
											</p>
										@enderror
										@error('jabatan_panitia.*')
											<p role="alert" style="color: red;">
												<strong>{{ $message }}</strong>
											</p>
										@enderror

									@else
										<p>
											<div id="people-container">
												@foreach ($pemateri as $undangan)
												<p id="{{$undangan->id}}">
													<input style="margin-bottom: 10px;" id="pemateri" class="form-control" name="pemateri[]" value="{{$undangan->nama}}">
													<a href="#" onclick="hapusPemateri({{$undangan->id}})"><i class="fa fa-close delicon"></i></a>
													{{-- <span id="id_pemateri" type="hidden">{{$undangan->id}}</span> --}}
												</p>
												@endforeach	
											</div>								
											
											<a href="javascript:;" id="tambahPemateri" class="tambahPemateri"><i class="fa fa-plus"></i> Tambah</a>	
										</p>

										@error('pemateri')
											<p role="alert" style="color: red;">
												<strong>{{ $message }}</strong>
											</p>
										@enderror
										@error('pemateri.*')
											<p role="alert" style="color: red;">
												<strong>{{ $message }}</strong>
											</p>
										@enderror
									@endif
                </td>

                <td>
                  {{-- @foreach ($dosen_sk as $dosen)
										<p style="margin-top: 2px; margin-left: 5px;">{{$dosen->user['nama']}}</p>
										<input type="hidden" name="id_dosen_lama[]" value="{{$dosen->no_pegawai}}">
										
									@endforeach --}}

									@if (count($pemateri) != null)
									<div class="form-group">
										<label style="margin-top: 2px; margin-left: 30px;">Biaya</label>
										<input style="width: 60%;" type="number" name="biaya_pemateri" class="form-control pull-right" placeholder="Masukan Biaya Pemateri" value="{{ $pemateri[0]->biaya }}" required><br/>
									</div>
									@error('biaya_pemateri')
									  <p class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </p>
									@enderror
									@endif
                </td>
							</tbody>

							<thead>
								<tr>
									<th>Lokasi</th>
									<th>{{ ($surat->surat_in_out == 2)? 'Instansi':'' }}</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<div class="form-group">
										<input class="form-control" style="width: 80%" type="text" name="lokasi" placeholder="Lokasi tujuan" value="{{$surat->lokasi}}" {{ ($surat->perjalanan == 2)? 'disabled':'' }}>	
										<!-- /.input group -->	
									</div>

									@error('lokasi')
									  <p class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </p>
									@enderror
								</td>

								<td>
									@if ($surat->surat_in_out == 2)
									<div>
										<p>
											<input id="instansi" class="form-control" name="instansi" placeholder="Nama Instansi" value="{{ $pemateri[0]->instansi }}" {{ ($surat->surat_in_out == 1)? 'disabled':'' }}>
										</p>

										@error('instansi')
										  <p class="invalid-feedback" role="alert" style="color: red;">
										    <strong>{{ $message }}</strong>
										  </p>
										@enderror
									</div>
									@endif
								</td>
							</tbody>

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
                      <input type="text" value="{{\Carbon\Carbon::parse($surat->started_at)->format('m/d/Y')}}" class="form-control pull-right datepicker" name="started_at" id="datepicker">
										</div>
										<!-- /.input group -->	

										@error('started_at')
											<p role="alert" style="color: red;">
												<strong>{{ $message }}</strong>
											</p>
										@enderror
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
											<input type="text" value="{{\Carbon\Carbon::parse($surat->end_at)->format('m/d/Y')}}" class="form-control pull-right datepicker" name="end_at" id="datepicker2">
										</div>
										<!-- /.input group -->

										@error('end_at')
											<p role="alert" style="color: red;">
												<strong>{{ $message }}</strong>
											</p>
										@enderror
									</div>
								</td>
							</tbody>
						</table>
					</div>

					<input type="hidden" name="status" value="">
					<div class="form-group" style="float: left;">
						<button type="submit" name="simpan_kirim" class="btn btn-success">Ubah Surat</button>
						<a href="{{route('kepegawaian.surat.preview', $surat->id)}}" class="btn btn-default">Kembali</a>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('script')
	<script src="{{asset('/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script> 

	<script type="text/javascript">
		$('.select2').select2();

		$(document).ready(function() {
	    $('.js-example-basic-multiple').select2();

			$('.datepicker').datepicker({
				autoclose: true,
				// format: 'yyyy-m-d',
			});

			// $("#datepicker").datepicker({
			// }).on('changeDate', function (selected) {
			// 	var minDate = new Date(selected.date.valueOf());
			// 	$('#datepicker2').datepicker('setStartDate', minDate);
			// });

			// $("#datepicker2").datepicker()
			// 	.on('changeDate', function (selected) {
			// 		var maxDate = new Date(selected.date.valueOf());
			// 		$('#datepicker').datepicker('setEndDate', maxDate);
			// 	});

			$('#datepicker').datepicker({
				minDate: 0,
				autoclose: true,
				onClose: function( selectedDate ) {
					$( "#datepicker2" ).datepicker( "option", "minDate", selectedDate );
			  }
			});

			$('#datepicker2').datepicker({
				minDate: 0,
				autoclose: true,
				onClose: function( selectedDate ) {
					$( "#datepicker" ).datepicker( "option", "maxDate", selectedDate );
				}
			});

		});

		$('#jenisSurat').change(function(event) {
			jenis = $(this).val();
			if (jenis == 2) {
				$('input.panitia').show();
			} else {
				$('input.panitia').hide();
			}
		});

		@if(count($dosen_sk) > 0)
			let i = {{ count($dosen_sk)+1 }};
		@elseif(count($pemateri) != null)
			let i = {{ count($pemateri)+1 }};
		@endif
		i_dosen = i;
		
		$(function(){
			@if(count($pemateri) > 0)
				// Tambah Pemateri
				document.getElementById('tambahPemateri').onclick = function () {
					let template = `
						<p id="${i}">
							<input id="pemateri" class="form-control" name="pemateri[]" placeholder="Nama Pemateri ${i}" >
							<a href="#" onclick="hapusPemateri(${i})"><i class="fa fa-close delicon"></i></a>
						</p>`;
				
					let container = document.getElementById('people-container');
					let div = document.createElement('div');
					div.innerHTML = template;
					container.appendChild(div);
				
					i++;
				}

				function hapusPemateri(id)
				{
					$('#'+id).remove();
				}

			@else( count($dosen_sk) > 0)
				// nomor = $(".daftar_dosen").last().attr('id_dosen_tugas');
				// nomor++;
				$("#pilih_dosen").change(function(event) {
					id_pilihan = $(this).val();
					teks_pilihan = $(this).find('option').filter(':selected').text();
					$(this).find('option').filter(':selected').remove();
					// console.log('teks: '+teks_pilihan);

					template = 
					`
						<div id="dosen${id_pilihan}" class="daftar_dosen" id_dosen_tugas="${id_pilihan}">
							<br>
							<input type="hidden" id="input${id_pilihan}" class="form-control" name="dosen[]" value="${id_pilihan}">
							
							<span id="nama_dosen${id_pilihan}">
								${teks_pilihan}
							</span> &ensp;
							<span class="label bg-red hapusDosen"><i class="fa fa-close"></i> Hapus</span>
							
							@if ($surat->jenis_surat == 2)
								<input name="jabatan_panitia[]" class="form-control panitia" type="text" placeholder="Jabatan Panitia" style="margin-top:5px; width: 30%;">
							@endif
						</div>
					`;

					$("#dosen-container").append(template);

					hapusDosen();
				});

				hapusDosen();
				function hapusDosen(argument) {
					$(".hapusDosen").click(function(event) {
						id_dosen_tugas = $(this).parents("div.daftar_dosen").attr('id_dosen_tugas');
						nama_dosennya = $("#nama_dosen"+id_dosen_tugas).text();

						// console.log('id_dosen_tugas= '+id_dosen_tugas);
						$("#pilih_dosen").append(`
							<option value="${id_dosen_tugas}">${nama_dosennya}</option>
							`);
						$('#dosen'+id_dosen_tugas).remove();
					});
				}
			@endif
			
		});
		
		
	</script>
@endsection
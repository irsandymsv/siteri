@extends('akademik.akademik_view')

@section('page_title')
	@if($tipe == "sk skripsi")
		Buat SK skripsi Baru
	@else
		Buat SK Sempro baru
	@endif
@endsection

@section('judul_header')
	@if($tipe == "sk skripsi")
		SK Skripsi
	@else
		SK Sempro
	@endif
@endsection

@section('css_link')
	<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
	<style type="text/css">
		th{
			text-align: center;
		}

		#input_no_surat{
			width: 50%;
			font-size: 15px;
		}

		#input_no_surat input{
			width: 15%;
		}
	</style>
@endsection

@section('content')
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
	            <form action="{{ ( $tipe == "sk skripsi"? route('akademik.skripsi.store') : route('akademik.sempro.store') ) }}" method="POST">
	            	<div class="box-header">
		              <h3 class="box-title">{{ ( $tipe == "sk skripsi"? "Buat SK Skripsi" : "Buat SK Sempro" ) }}</h3>

		              <div class="form-group" style="float: right;">
		            	<button type="submit" name="simpan_draf" class="btn bg-purple">Simpan Sebagai Draft</button> 
		            		&ensp;
		            	<button type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>	
		              </div>
		            </div>
	            	
	            	<div class="box-body">
	            		@csrf
	            		<div class="form" id="input_no_surat">
	            			<label for="no_surat"><b>No Surat : </b></label>
	            			<input type="text" name="no_surat" id="no_surat">
	            			<span>/UN 25.1.15/SP/{{Carbon\Carbon::today()->year}}</span>
	            		</div>
		            	<div class="table-responsive">
		            		<h5>Total Data = <span class="data_count"></span></h5>
		            		@if(session()->has('error'))
		            			<p style="color: red;">{{session('error')}}</p>
		            		@endif
		            		<table id="tbl-data" class="table table-bordered table-hover">
			            		<thead>
				            		<tr>
				            			<th>Nama Mahasiswa</th>
				            			<th>NIM</th>
				            			<th>Jurusan</th>
				            			<th>Judul</th>
				            			<th>Pembimbing</th>
				            			<th>
				            				@if($tipe == "sk skripsi")
				            					Penguji
				            				@else
				            					Pembahas
				            				@endif
				            			</th>
				            			<th>X</th>
				            		</tr>
				            	</thead>

				            	<tbody>
				            		@if($errors->any())

				            			@foreach($old_data['nama'] as $i => $val)
				            				@php $id = $i+1 @endphp
				            				<tr id="{{$id}}">
						            			<td>
						            				<input type="text" name="nama[]" class="form-control" value="{{old('nama')[$i]}}">
						            				@error('nama.'.$i)
											          	<span class="invalid-feedback" role="alert" style="color: red;">
											                <strong>{{ $message }}</strong>
											            </span>
											    	@enderror
						            			</td>

						            			<td>
						            				<input type="text" name="nim[]" class="form-control" value="{{old('nim')[$i]}}">
						            				@error('nim.'.$i)
											          	<span class="invalid-feedback" role="alert" style="color: red;">
											                <strong>{{ $message }}</strong>
											            </span>
											    	@enderror
						            			</td>

						            			<td>
						            				<select name="jurusan[]" class="form-control">
						            					<option value="">-Pilih Jurusan-</option>
						            					@foreach($jurusan as $val)
						            						<option value="{{$val->id}}" {{ (old('jurusan')[$i] == $val->id ? 'selected': '') }}>{{$val->bagian}}</option>
						            					@endforeach
						            				</select>
						            				@error('jurusan.'.$i)
											          	<span class="invalid-feedback" role="alert" style="color: red;">
											                <strong>{{ $message }}</strong>
											            </span>
											    	@enderror
						            			</td>

						            			<td>
						            				<textarea class="form-control" rows="3" name="judul[]">{{old('judul')[$i]}}</textarea>
						            				@error('judul.'.$i)
											          	<span class="invalid-feedback" role="alert" style="color: red;">
											                <strong>{{ $message }}</strong>
											            </span>
											    		@enderror
						            			</td>

						            			<td>
						            				<h5><b>Utama</b></h5>
						            				<select name="pembimbing_utama[]" class="form-control select2" style="width: 100%;">
						            					<option value="">-Pilih-</option>
						            					@foreach($dosen as $val)
						            						<option value="{{$val->no_pegawai}}" {{ (old('pembimbing_utama')[$i] == $val->no_pegawai ? 'selected': '') }}>{{$val->nama}}</option>
						            					@endforeach
						            				</select>
						            				@error('pembimbing_utama.'.$i)
											          	<span class="invalid-feedback" role="alert" style="color: red;">
											                <strong>{{ $message }}</strong>
											            </span>
											    	@enderror

						            				<h5><b>Pendamping</b></h5>
						            				<select name="pembimbing_pendamping[]" class="form-control select2" style="width: 100%;">
						            					<option value="">-Pilih-</option>
						            					@foreach($dosen as $val)
						            						<option value="{{$val->no_pegawai}}" {{ (old('pembimbing_pendamping')[$i] == $val->no_pegawai ? 'selected': '') }}>{{$val->nama}}</option>
						            					@endforeach
						            				</select>
						            				@error('pembimbing_pendamping.'.$i)
											          	<span class="invalid-feedback" role="alert" style="color: red;">
											                <strong>{{ $message }}</strong>
											            </span>
											    	@enderror
						            			</td>

						            			<td>
						            				<h5><b>Utama</b></h5>
						            				<select name="penguji_utama[]" class="form-control select2" style="width: 100%;">
						            					<option value="">-Pilih-</option>
						            					@foreach($dosen as $val)
						            						<option value="{{$val->no_pegawai}}" {{ (old('penguji_utama')[$i] == $val->no_pegawai ? 'selected': '') }}>{{$val->nama}}</option>
						            					@endforeach
						            				</select>
						            				@error('penguji_utama.'.$i)
											          	<span class="invalid-feedback" role="alert" style="color: red;">
											                <strong>{{ $message }}</strong>
											            </span>
											    	@enderror

						            				<h5><b>pendamping</b></h5>
						            				<select name="penguji_pendamping[]" class="form-control select2" style="width: 100%;">
						            					<option value="">-Pilih-</option>
						            					@foreach($dosen as $val)
						            						<option value="{{$val->no_pegawai}}" {{ (old('penguji_pendamping')[$i] == $val->no_pegawai ? 'selected': '') }}>{{$val->nama}}</option>
						            					@endforeach
						            				</select>
						            				@error('penguji_pendamping.'.$i)
											          	<span class="invalid-feedback" role="alert" style="color: red;">
											                <strong>{{ $message }}</strong>
											            </span>
											    	@enderror
						            			</td>

						            			<td>
						            				<button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
						            			</td>
						            		</tr>
				            			@endforeach
				            			
				            		@else
				            			
				            			<tr id="1">
					            			<td>
					            				<input type="text" name="nama[]" class="form-control">
					            			</td>

					            			<td>
					            				<input type="text" name="nim[]" class="form-control">
					            			</td>

					            			<td>
					            				<select name="jurusan[]" class="form-control">
					            					<option value="">-Pilih Jurusan-</option>
					            					@foreach($jurusan as $val)
					            						<option value="{{$val->id}}">{{$val->bagian}}</option>
					            					@endforeach
					            				</select>
					            			</td>

					            			<td>
					            				<textarea class="form-control" rows="3" name="judul[]"></textarea>
					            			</td>

					            			<td>
					            				<h5><b>Utama</b></h5>
					            				<select name="pembimbing_utama[]" class="form-control select2" style="width: 100%;">
					            					<option value="">-Pilih-</option>
					            					@foreach($dosen as $val)
					            						<option value="{{$val->no_pegawai}}">{{$val->nama}}</option>
					            					@endforeach
					            				</select>

					            				<h5><b>Pendamping</b></h5>
					            				<select name="pembimbing_pendamping[]" class="form-control select2" style="width: 100%;">
					            					<option value="">-Pilih-</option>
					            					@foreach($dosen as $val)
					            						<option value="{{$val->no_pegawai}}">{{$val->nama}}</option>
					            					@endforeach
					            				</select>
					            			</td>

					            			<td>
					            				<h5><b>Utama</b></h5>
					            				<select name="penguji_utama[]" class="form-control select2" style="width: 100%;">
					            					<option value="">-Pilih-</option>
					            					@foreach($dosen as $val)
					            						<option value="{{$val->no_pegawai}}">{{$val->nama}}</option>
					            					@endforeach
					            				</select>

					            				<h5><b>pendamping</b></h5>
					            				<select name="penguji_pendamping[]" class="form-control select2" style="width: 100%;">
					            					<option value="">-Pilih-</option>
					            					@foreach($dosen as $val)
					            						<option value="{{$val->no_pegawai}}">{{$val->nama}}</option>
					            					@endforeach
					            				</select>
					            			</td>

					            			<td>
					            				<button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
					            			</td>
					            		</tr>

				            		@endif
				            	</tbody>

				            	<tfoot>
				            		<tr>
				            			<th>Nama Mahasiswa</th>
				            			<th>NIM</th>
				            			<th>Jurusan</th>
				            			<th>Judul</th>
				            			<th>Pembimbing</th>
				            			<th>Penguji</th>
				            			<th>X</th>
				            		</tr>
				            	</tfoot>
				            </table>
		            		
		            		<h5>Total Data = <span class="data_count"></span></h5>	
		            	</div>

		            	<button id="addRow" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
		            	<br><br>

		            	<input type="hidden" name="status" value="">
		            	<div class="form-group" style="float: right;">
		            		<button type="submit" name="simpan_draf" class="btn bg-purple">Simpan Sebagai Draft</button> &ensp;
		            		<button type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>	
		            	</div>
		            	
	            	</div>
      			</div>
	        </form>
      	</div>
	</div>
@endsection

@section('script')
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('.select2').select2()

		var jurusan = @json($jurusan);
		var dosen = @json($dosen);

		$("button[name='simpan_draf']").click(function(event) {
			event.preventDefault();
			$("input[name='status']").val(1);
			$('form').trigger('submit');
		});

		$("button[name='simpan_kirim']").click(function(event) {
			event.preventDefault();
			$("input[name='status']").val(2);
			$('form').trigger('submit');
		});

		$('button#addRow').click(function(event) {
			if ($("#tbl-data tbody tr").length) {
				var last_id = $("#tbl-data tbody tr:last-child").attr('id');
			}else{
				var last_id = 0;
			}
			// console.log(last_id);
			var new_id = parseInt(last_id) + 1;
			$("#tbl-data").find('tbody').append(`
				<tr id="`+new_id+`">
        			<td>
        				<input type="text" name="nama[]" class="form-control">
        			</td>

        			<td>
        				<input type="text" name="nim[]" class="form-control">
        			</td>

        			<td>
        				<select name="jurusan[]" class="form-control">
        					<option value="">-Pilih Jurusan-</option>
        					
        				</select>
        			</td>

        			<td>
        				<textarea class="form-control" rows="3" name="judul[]"></textarea>
        			</td>

        			<td>
        				<h5><b>Utama</b></h5>
        				<select name="pembimbing_utama[]" class="form-control select2" style="width: 100%;">
        					<option value="">-Pilih-</option>
        				</select>

        				<h5><b>Pendamping</b></h5>
        				<select name="pembimbing_pendamping[]" class="form-control select2" style="width: 100%;">
        					<option value="">-Pilih-</option>
        				</select>
        			</td>

        			<td>
        				<h5><b>Utama</b></h5>
        				<select name="penguji_utama[]" class="form-control select2" style="width: 100%;">
        					<option value="">-Pilih-</option>
        				</select>

        				<h5><b>Pendamping</b></h5>
        				<select name="penguji_pendamping[]" class="form-control select2" style="width: 100%;">
        					<option value="">-Pilih-</option>
        				</select>
        			</td>

        			<td>
        				<button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
        			</td>
				</tr>
			`);

			$.each(jurusan, function(index, val) {
				$("tr#"+new_id).find('select[name="jurusan[]"]').append(`<option value="`+val.id+`">`+val.bagian+`</option>`);
			})

			$.each(dosen, function(index, val) {
				$("tr#"+new_id).find('select[name="pembimbing_utama[]"]').append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
				$("tr#"+new_id).find('select[name="pembimbing_pendamping[]"]').append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
				$("tr#"+new_id).find('select[name="penguji_utama[]"]').append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
				$("tr#"+new_id).find('select[name="penguji_pendamping[]"]').append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
			})

			del_row();
			data_count();
			$('.select2').select2()
		});

		del_row();

		function del_row() {
			$('button[name="delete_data"]').click(function(event) {
				var jml_tr = $("tbody tr").length;
				if (jml_tr > 1) {
					// var tr_id = $(this).parents("tr").attr('id');
					$(this).parents("tr").remove();
				}
				data_count();
			});
		}

		data_count();

		function data_count() {
			var count = $("tbody tr").length;
			$(".data_count").text(count);
		}
		
	})
</script>
@endsection
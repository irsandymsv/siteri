@extends('akademik.akademik_view')

@section('page_title')
	Ubah SK Skripsi
@endsection

@section('css_link')
	<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
	<style type="text/css">
		th{
			text-align: center;
		}
	</style>
@endsection

@section('judul_header')
	Ubah SK Skripsi 
@endsection

@section('content')
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
	            <form action="{{ route('akademik.skripsi.store') }}" method="POST">
	            	<div class="box-header">
		              <h3 class="box-title">Buat SK Skripsi</h3>

		              <div class="form-group" style="float: right;">
		            	<button type="submit" class="btn bg-purple">Simpan Sebagai Draft</button> 
		            		&ensp;
		            	<button type="submit" class="btn btn-success">Simpan dan Kirim</button>	
		              </div>
		            </div>
	            	
	            	<div class="box-body">
	            		@csrf
		            	<div class="table-responsive">
		            		<h5>Total Data = <span class="data_count"></span></h5>
		            		<table id="tbl-data" class="table table-bordered table-hover">
			            		<thead>
				            		<tr>
				            			<th>Nama Mahasiswa</th>
				            			<th>NIM</th>
				            			<th>Jurusan</th>
				            			<th>Judul</th>
				            			<th>Pembimbing</th>
				            			<th>Penguji</th>
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
				            			@foreach($detail_sk as $item)
			            				<tr id="1">
					            			<td>
					            				<input type="text" name="nama[]" class="form-control" value="{{$item->nama_mhs}}">
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
				            			@endforeach
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
		            		<button type="submit" id="simpan_draf" class="btn bg-purple">Simpan Sebagai Draft</button> &ensp;
		            		<button type="submit" id="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>	
		            	</div>
		            	
	            	</div>
      			</div>
	        </form>
      	</div>
	</div>
@endsection

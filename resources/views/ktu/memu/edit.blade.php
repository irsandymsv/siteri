@extends('ktu.ktu_view')

@section('page_title', 'Buat Surat Tugas')
@section('judul_header','Buat Surat Tugas')

@section('css_link')
<link rel="stylesheet" href="{{asset('/adminlte/bower_components/select2/dist/css/select2.min.css')}}">
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
		<form action="{{route('kepegawaian.memu.update', $surat->id)}}" method="POST">
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
									<th>Jenis Surat Tugas</th>
									<th>Keterangan</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<select name="jenisSurat" class="form-control">
                                    <option value="{{$surat->jenis_surat}}"> {{$surat->jenis_sk['jenis']}} </option>
										@foreach ($jenis as $jenis)
										<option value="{{$jenis->id}}">{{$jenis->jenis}}</option>
										@endforeach
									</select>
								</td>

								<td>
									<textarea class="form-control" rows="3" name="keterangan"
                                placeholder="Keterangan Surat">{{$surat->keterangan}}</textarea>
								</td>
							</tbody>

							<thead>
								<tr>
                                        <th>Nama Dosen</th>
                                <th>Dosen Terpilih Saat Ini</th>
                              
                                </tr>
                                      
							</thead>

							<tbody>
								<td>
                                        <select class="js-example-basic-multiple" name="dosen[]" multiple="multiple">
                                                @foreach ($dosen as $dosen)
                                                <option value="{{$dosen->no_pegawai}}">{{$dosen->nama}}</option>
                                                @endforeach
                                            </select>
                                </td>
                                <td>
                                    @foreach ($dosen_sk as $dosen)
                                <p style="margin-top: 2px; margin-left: 5px;">{{$dosen->user['nama']}}</p>
                                    @endforeach
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
						<button type="submit" name="simpan_kirim" class="btn btn-success">Ubah Memu</button>
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

	@endsection
@extends('staff_pimpinan.sp_view')

@section('page_title', 'Tolak Surat Tugas')
@section('judul_header','Tolak Surat Tugas')

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
		<form action="{{route('staffpim.surat.reject', $surat->id)}}" method="POST">
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
								<th>Nomor Surat</th>
								<th>Jenis Surat Tugas</th>
								<th>Keterangan</th>
							</tr>
						</thead>

						<tbody>
							<td>
								<input class="form-control" type="text" value="{{$surat->nomor_surat}}/UN25.1.15/KP/{{ \Carbon\Carbon::parse($surat->created_at)->year }}" name="nomor_surat" readonly>
							</td>
							<td>
								<select name="jenisSurat" class="form-control" disabled>
                  <option value="{{$surat->jenis_surat}}"> {{$surat->jenis_sk['jenis']}} </option>
									@foreach ($jenis as $jenis)
									<option value="{{$jenis->id}}">{{$jenis->jenis}}</option>
									@endforeach
								</select>
							</td>

							<td>
								<textarea class="form-control" rows="3" name="keterangan" placeholder="Keterangan Surat" readonly>{{$surat->keterangan}}</textarea>
							</td>
						</tbody>

						<thead>
							<tr>
                <th>
                	@if ($surat->surat_in_out == 1)
                  	Dosen yang Bertugas
									@else
										Pemateri
									@endif
                </th>
								<th>Tanggal Mulai</th>
								<th>Tanggal Selesai</th>
              </tr>
						</thead>

						<tbody>
              <td>
                @if ($surat->surat_in_out == 1)
	                @foreach ($dosen_sk as $dosen)
	              	<p style="margin-top: 2px; margin-left: 5px;">{{$dosen->user['nama']}}</p>
	                @endforeach
	              @else
	              	@foreach ($pemateri as $item)
	              	<p style="margin-top: 2px; margin-left: 5px;">{{$item->nama}}</p>
	                @endforeach
	              @endif
							</td>

							<td>
								<!-- Date -->
								<div class="form-group">
									<label>Date:</label>

									<div class="input-group date">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
                  	<input type="text" value="{{$surat->started_at}}" class="form-control pull-right" name="started_at" id="datepicker" readonly>
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
										<input type="text" value="{{$surat->end_at}}" class="form-control pull-right" name="end_at" id="datepicker2" readonly>
									</div>
									<!-- /.input group -->
								</div>
							</td>
            </tbody>

            <thead>
							<tr>
								<th>Pesan Revisi</th>
							</tr>
						</thead>

						<tbody>
							<td>
								<textarea class="form-control" type="text" placeholder="Masukan pesan revisi" name="pesan_revisi" required></textarea>

								@error('pesan_revisi')
									<p class="invalid-feedback" role="alert" style="color: red;">
										<strong>{{ $message }}</strong>
									</p>
								@enderror
							</td>
						</tbody>
					</table>
				</div>

				<input type="hidden" name="status" value="">
				<div class="form-group" style="float: left;">
					<button type="submit" name="simpan_kirim" class="btn btn-danger">Tolak</button>
					<a class="btn btn-default" href="{{route('staffpim.sp.preview', $surat->id)}}">Batal</a>
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
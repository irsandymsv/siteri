@extends('wadek2.wadek2_view')

@section('page_title', 'Buat Memu')
@section('judul_header','Buat Memu')

@section('css_link')
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
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
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
		<form action="{{route('wadek2.memu.update', $surat->id)}}" method="POST">
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
									<th>Perjalanan Dinas</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<select id="perjalanan" name="perjalanan" class="form-control" disabled>
									<option value="{{$surat->surat_in_out}}" required>{{$surat->surat_in_outs['nama']}}</option>
										@foreach ($inout as $inout)
										<option value="{{$inout->id}}">{{$inout->nama}}</option>
										@endforeach
									</select>
								</td>
								<td>
									<select id="surat_in_out" name="surat_in_out" class="form-control" disabled>
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
                                <th>
									@if (count($pemateri) == null)
									Nama Dosen
									@else
									Pemateri
									@endif
									</th>
                                <th>
									@if (count($dosen_sk) > 1)
									Dosen yang bertugas
									@else
									
									@endif	
								</th>
                              
                                </tr>
                                      
							</thead>

							<tbody>
								<td>
									@if (count($pemateri) == null)
									<select class="js-example-basic-multiple" name="dosen[]" multiple="multiple">
										@foreach ($dosen as $dosen)
										<option value="{{$dosen->no_pegawai}}">{{$dosen->nama}}</option>
										@endforeach
									</select>
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
									@endif
                                        
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
                                        <input type="text" value="{{\Carbon\Carbon::parse($surat->started_at)->format('Y/m/d')}}" class="form-control pull-right datepicker" name="started_at" id="datepicker">
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
											<input type="text" value="{{\Carbon\Carbon::parse($surat->end_at)->format('Y/m/d')}}" class="form-control pull-right datepicker" name="end_at" id="datepicker2">
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
					<a href="{{route('wadek2.memu.index')}}" class="btn btn-default">Kembali</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endsection

	@section('script')
	<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

<script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script> 
	<script type="text/javascript">
		$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
	</script>

<script type="text/javascript">
	$('#datepicker').datepicker({
	minDate: 0,
	autoclose: true,
	onClose: function( selectedDate ) {
	$( "#datepicker2" ).datepicker( "option", "minDate", selectedDate );
  }
	})
	$('#datepicker2').datepicker({
	minDate: 0,
	autoclose: true,
	onClose: function( selectedDate ) {
	$( "#datepicker" ).datepicker( "option", "maxDate", selectedDate );
  }
	})
	</script>
	
<script>
	// Tambah Pemateri
	let i = @php if (count($dosen_sk) > 1) {
		count($dosen_sk)+1;
	} else if (count($pemateri) != null) {
		echo count($pemateri)+1;
		
	} @endphp;
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
</script>

<script>
function hapusPemateri(id)
{
	$('#'+id).remove();
}
</script>
@endsection
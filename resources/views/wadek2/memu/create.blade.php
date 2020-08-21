@extends('wadek2.wadek2_view')

@section('page_title', 'Buat Memo')
@section('judul_header','Buat Memo')

@section('css_link')
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
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
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
		<form id="formInput" action="{{route('wadek2.memu.save')}}" method="POST">
			@csrf	
			<div class="box-body">
					<div class="table-responsive">
						<table id="tbl-data" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Yang Bertugas</th>
									<th>Melakukan Dinas Perjalanan</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<select id="surat_in_out" name="surat_in_out" class="form-control">
										<option required>- Pilih Jenis -</option>
										@foreach ($surat as $inout)
										<option value="{{$inout->id}}" {{ (old('surat_in_out') == $inout->id)? 'selected':'' }}>
											{{$inout->nama}}
										</option>
										@endforeach
									</select>

									@error('surat_in_out')
									  <span class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </span>
									@enderror
								</td>
								<td>
									<select id="perjalanan" name="perjalanan" class="form-control">
										<option required>- Pilih Jenis -</option>
										@foreach ($perjalanan as $perjalanan)
										<option value="{{$perjalanan->id}}" {{ (old('perjalanan') == $perjalanan->id)? 'selected':'' }}>
											{{$perjalanan->nama}}
										</option>
										@endforeach
									</select>

									@error('perjalanan')
									  <span class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </span>
									@enderror
								</td>
							</tbody>
							<thead>
								<tr>
									<th>Jenis Surat Tugas</th>
									<th>Acara</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<select id="jenisSurat" name="jenisSurat" class="form-control">
										<option>- Pilih Jenis -</option>
										@foreach ($jenis as $jenis)
										<option value="{{$jenis->id}}" {{ (old('jenisSurat') == $jenis->id)? 'selected':'' }}>
											{{$jenis->jenis}}
										</option>
										@endforeach
									</select>

									@error('jenisSurat')
									  <span class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </span>
									@enderror
								</td>

								<td>
									<textarea id="keterangan" class="form-control" rows="3" name="keterangan" placeholder="Nama Acara">{{ old('keterangan') }}</textarea>
									@error('keterangan')
									  <span class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </span>
									@enderror
								</td>
							</tbody>

							<thead>
								<tr>
									<th>Nama Dosen</th>
									<th>Nama Pemateri</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<select id="dosen" class="js-example-basic-multiple" name="dosen[]" multiple="multiple">
										@foreach ($user as $dosen)
										<option value="{{$dosen->no_pegawai}}">{{$dosen->nama}}</option>
										@endforeach
									</select>

									@error('dosen')
										<br>
									  <span class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </span>
									@enderror
								</td>
								<td>
									<div id="people-container">
										<p>
											<input id="pemateri" class="form-control" name="pemateri[]" placeholder="Nama Pemateri 1">
										</p>	
									</div>
									<a href="javascript:;" id="tambahPemateri" class="tambahPemateri"><i class="fa fa-plus"></i> Tambah</a>

									@error('pemateri.*')
									  <p class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </p>
									@enderror
								</td>
							</tbody>

							<thead>
								<tr>
									<th>Lokasi</th>
									<th>Instansi</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<div id="people-container">
										<p>
											<input id="lokasi" class="form-control" name="lokasi" placeholder="Lokasi" value="{{ (old('lokasi')) }}">
										</p>	
									</div>
									@error('lokasi')
									  <span class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </span>
									@enderror
								</td>
								<td>
									<div id="people-container">
										<p>
											<input id="instansi" class="form-control" name="instansi" placeholder="Nama Instansi" value="{{ (old('instansi')) }}">
										</p>

										@error('instansi')
										  <p class="invalid-feedback" role="alert" style="color: red;">
										    <strong>{{ $message }}</strong>
										  </p>
										@enderror
									</div>
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
											<input type="text" class="form-control pull-right" name="started_at" id="datepicker" autocomplete="off" value="{{ old('started_at') }}">
										</div>
										<!-- /.input group -->

										@error('started_at')
										  <span class="invalid-feedback" role="alert" style="color: red;">
										    <strong>{{ $message }}</strong>
										  </span>
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
											<input type="text" class="form-control pull-right" name="end_at" id="datepicker2" autocomplete="off" value="{{ old('end_at') }}">
										</div>
										<!-- /.input group -->

										@error('end_at')
										  <span class="invalid-feedback" role="alert" style="color: red;">
										    <strong>{{ $message }}</strong>
										  </span>
										@enderror
									</div>
								</td>
							</tbody>

						</table>
					</div>

					<input type="hidden" name="status" value="">
					<div class="form-group" style="float: left;">
						<button id="submit" type="submit" name="simpan_kirim" class="btn btn-success">Buat Memo</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endsection

	@section('script')
	<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

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
		});

		$('#datepicker2').datepicker({
			minDate: 0,
			autoclose: true,
			onClose: function( selectedDate ) {
        $( "#datepicker" ).datepicker( "option", "maxDate", selectedDate );
      }
		});
		</script>

<script>
	$(document).ready(function(){
		$("#formInput :input").prop("disabled", true);
		$("#surat_in_out").removeAttr("disabled");
	});

	$(function(){
    $("#surat_in_out").change(function(){
			$("#formInput :input").prop("disabled", false);
      if ( $("#surat_in_out").val() == 1 ) {
        $('#perjalanan').removeAttr("disabled");
        $('#perjalanan').on("change",function() {
            $('#perjalanan').val($(this).val());
				});
				$("#pemateri").prop("disabled", true);
				$("#dosen").prop("disabled", false);
				$("#instansi").prop("disabled", true);

				if ($("#perjalanan").val() == 1) {
					$('#lokasi').prop("disabled", false);
				} else {
					$('#lokasi').prop("disabled", true);
				}
      }

			if ($("#surat_in_out").val() == 2 ) {
				$('#perjalanan').val("2").change();
				$("#perjalanan").prop("disabled", true);
				$('#jenisSurat').val("3").change();
				$("#jenisSurat").prop("disabled", true);
				$("#dosen").prop("disabled", true);
				$('#keterangan, #datepicker, #pemateri, #datepicker2, #submit, #instansi').removeAttr("disabled");
				// $('#jenisSurat').val("3").change();
	    }
    });
	
	  $("#perjalanan").change(function(){
	    if ($("#perjalanan").val() == 1 ) {
				$('#jenisSurat, #keterangan, #dosen, #datepicker, #datepicker2, #submit').removeAttr("disabled");
				$('#lokasi').prop("disabled", false);
	      $('#jenisSurat').on("change",function() {
	        $('#jenisSurat').val($(this).val());
	      });
	    }
	    else if ($("#perjalanan").val() == 2 ) {
				$('#jenisSurat, #keterangan, #dosen, #datepicker, #datepicker2, #submit').removeAttr("disabled");
				$('#lokasi').prop("disabled", true);
	      $('#jenisSurat').on("change",function() {
	          $('#jenisSurat').val($(this).val());
	      });
	    }
	  });

	  //Ketika tidak lolos validasi di server
	  inout_old = @json(old('surat_in_out'));
	  perjalanan_old = @json(old('perjalanan'));
    if ( inout_old == 1 ) {
      $('#perjalanan').removeAttr("disabled");
      $('#perjalanan').on("change",function() {
          $('#perjalanan').val($(this).val());
			});
			$("#pemateri").prop("disabled", true);
			$("#dosen").prop("disabled", false);
			$("#instansi").prop("disabled", true);

			if ($("#perjalanan").val() == 1) {
				$('#lokasi').prop("disabled", false);
			} else {
				$('#lokasi').prop("disabled", true);
			}
    }
		else if (inout_old == 2 ) {
			$('#perjalanan').val("2").change();
			$("#perjalanan").prop("disabled", true);
			$('#jenisSurat').val("3").change();
			$("#jenisSurat").prop("disabled", true);
			$("#dosen").prop("disabled", true);
			$('#keterangan, #datepicker, #pemateri, #datepicker2, #submit, #instansi').removeAttr("disabled");
			// $('#jenisSurat').val("3").change();
    }

    if (perjalanan_old == 1 ) {
			$('#jenisSurat, #keterangan, #dosen, #datepicker, #datepicker2, #submit').removeAttr("disabled");
			$('#lokasi').prop("disabled", false);
      $('#jenisSurat').on("change",function() {
        $('#jenisSurat').val($(this).val());
      });
    }
    else if (perjalanan_old == 2 ) {
			$('#jenisSurat, #keterangan, #dosen, #datepicker, #datepicker2, #submit').removeAttr("disabled");
			$('#lokasi').prop("disabled", true);
      $('#jenisSurat').on("change",function() {
          $('#jenisSurat').val($(this).val());
      });
    }
	});
</script>

<script>
// Tambah Pemateri
let i = 2;
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
	i--;
}
</script>

	@endsection
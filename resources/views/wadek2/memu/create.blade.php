@extends('wadek2.wadek2_view')

@section('page_title', 'Buat Surat Tugas')
@section('judul_header','Buat Surat Tugas')

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
									<th>Surat Keluar / Masuk</th>
									<th>Perjalanan Dinas</th>
								</tr>
							</thead>

							<tbody>
								<td>
									<select id="surat_in_out" name="surat_in_out" class="form-control">
										<option required>- Pilih Jenis -</option>
										@foreach ($surat as $inout)
										<option value="{{$inout->id}}">{{$inout->nama}}</option>
										@endforeach
									</select>
								</td>
								<td>
									<select id="perjalanan" name="perjalanan" class="form-control">
										<option required>- Pilih Jenis -</option>
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
									<select id="jenisSurat" name="jenisSurat" class="form-control">
										<option>- Pilih Jenis -</option>
										@foreach ($jenis as $jenis)
										<option value="{{$jenis->id}}">{{$jenis->jenis}}</option>
										@endforeach
									</select>
								</td>

								<td>
									<textarea id="keterangan" class="form-control" rows="3" name="keterangan"
										placeholder="Keterangan Surat"></textarea>
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
								</td>
								<td>
									<div id="people-container">
										<p>
											<input id="pemateri" class="form-control" name="pemateri[]" placeholder="Nama Pemateri 1">
										</p>	
									</div>
									<a href="javascript:;" id="tambahPemateri" class="tambahPemateri"><i class="fa fa-plus"></i> Tambah</a>
								</td>
							</tbody>

							<thead>
								<tr>
									<th></th>
									<th>Instansi</th>
								
								</tr>
							</thead>

							<tbody>
								<td></td>
								<td>
									<div id="people-container">
										<p>
											<input id="instansi" class="form-control" name="instansi" placeholder="Nama Instansi">
										</p>	
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
											<input type="text" class="form-control pull-right" name="started_at" id="datepicker">
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
											<input type="text" class="form-control pull-right" name="end_at" id="datepicker2">
										</div>
										<!-- /.input group -->
									</div>
								</td>
							</tbody>

						</table>
					</div>

					<input type="hidden" name="status" value="">
					<div class="form-group" style="float: left;">
						<button id="submit" type="submit" name="simpan_kirim" class="btn btn-success">Buat Memu</button>
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
	$(document).ready(function(){
		$("#formInput :input").prop("disabled", true);
		$("#surat_in_out").removeAttr("disabled");
	});

	$(function(){
    $("#surat_in_out").change(function(){
		$("#formInput :input").prop("disabled", false);
        if ( $("#surat_in_out").val() == 1 ) {
			console.log(true)
            $('#perjalanan').removeAttr("disabled");
            $('#perjalanan').on("change",function() {
                $('#perjalanan').val($(this).val());
			});
			$("#pemateri").prop("disabled", true);
			$("#dosen").prop("disabled", false);
			$("#instansi").prop("disabled", true);
        }

		if ($("#surat_in_out").val() == 2 ) {
			$('#perjalanan').val("2").change();
			$("#perjalanan").prop("disabled", true);
			$("#dosen").prop("disabled", true);
			$('#keterangan, #datepicker, #pemateri, #datepicker2, #submit, #instansi').removeAttr("disabled");
			$('#jenisSurat').val("3").change();
        }
    });
});

$(function(){
    $("#perjalanan").change(function(){
        if ($("#perjalanan").val() != null ) {
			$('#jenisSurat, #keterangan, #dosen, #datepicker, #datepicker2, #submit').removeAttr("disabled");
            $('#jenisSurat').on("change",function() {
                $('#jenisSurat').val($(this).val());
            });
        }
    });
});
</script>

<script>
// Tambah Pemateri
let i = 2;
document.getElementById('tambahPemateri').onclick = function () {
    let template = `
        <p>
            <input id="pemateri" class="form-control" name="pemateri[]" placeholder="Nama Pemateri ${i}" >
        </p>`;

    let container = document.getElementById('people-container');
    let div = document.createElement('div');
    div.innerHTML = template;
    container.appendChild(div);

    i++;
}
</script>

	@endsection
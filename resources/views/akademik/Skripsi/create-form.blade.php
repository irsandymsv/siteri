@extends('akademik.akademik_view')

@section('judul_header')
	SK Skripsi
@endsection

@section('content')
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-warning">
      			<div class="box-header">
	              <h3 class="box-title">Buat SK Skripsi</h3>

	              <div class="form-group" style="float: right;">
            		<button type="submit" class="btn btn-warning">Simpan Sebagai Draft</button> 
            		&ensp;
            		<button type="submit" class="btn btn-success">Simpan dan Kirim</button>	
            	  </div>
	            </div>
	            <div class="box-body">
	            	<form action="{{ route('akademik.skripsi.store') }}" method="POST">
	            		@csrf
		            	<div class="table-responsive">
		            		<table id="tbl-data" class="table table-bordered table-hover">
			            		<thead>
				            		<tr>
				            			<th>No</th>
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

				            		<tr id="1" >
				            			<td>
				            				1
				            			</td>

				            			<td>
				            				<input type="text" name="nama[]" class="form-control">
				            			</td>

				            			<td lass="has-error">
											<input type="text" name="nim[]" class="form-control ">
				            			</td>

				            			<td>
				            				<select name="jurusan[]" class="form-control">
				            					<option>-Pilih Jurusan-</option>
				            					@foreach($jurusan as $index => $value)
				            						<option value="{{$index}}">{{$value}}</option>
				            					@endforeach
				            				</select>
				            			</td>

				            			<td>
				            				<textarea class="form-control" rows="3" name="judul[]"></textarea>
				            			</td>

				            			<td>
				            				<label for="pembimbing_utama">Utama</label>
				            				<select name="pembimbing_utama[]" class="form-control">
				            					@foreach($dosen as $index => $value)
				            						<option value="{{$index}}">{{$value}}</option>
				            					@endforeach
				            				</select>

				            				<label for="pembimbing_pendamping">Pendamping</label>
				            				<select name="pembimbing_pendamping[]" class="form-control">
				            					@foreach($dosen as $index => $value)
				            						<option value="{{$index}}">{{$value}}</option>
				            					@endforeach
				            				</select>
				            			</td>

				            			<td>
				            				<label for="penguji_utama">Utama</label>
				            				<select name="penguji_utama[]" class="form-control">
				            					@foreach($dosen as $index => $value)
				            						<option value="{{$index}}">{{$value}}</option>
				            					@endforeach
				            				</select>

				            				<label for="penguji_pendamping">pendamping</label>
				            				<select name="penguji_pendamping[]" class="form-control">
				            					@foreach($dosen as $index => $value)
				            						<option value="{{$index}}">{{$value}}</option>
				            					@endforeach
				            				</select>
				            			</td>

				            			<td>
				            				<button class="btn btn-danger" name="delete_data"><i class="fa fa-trash"></i></button>
				            			</td>
				            		</tr>

				            	</tbody>
				            </table>
		            	</div>

		            	<button id="addRow" type="button" class="btn btn-primary">Tambah</button>
		            	<br><br>

		            	<input type="hidden" name="status" value="">
		            	<div class="form-group" style="float: right;">
		            		<button type="submit" id="simpan_draf" class="btn btn-warning">Simpan Sebagai Draft</button> &ensp;
		            		<button type="submit" id="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>	
		            	</div>
		            	
	            	</form>
	            </div>
      		</div>
      	</div>
	</div>
@endsection

@section('script')
<script type="text/javascript">
	$(function() {
		var jurusan = @json($jurusan);
		var dosen = @json($dosen);

		$("#simpan_draf").click(function(event) {
			event.preventDefault();
			$("input[name='status']").val("1");
			$('form').trigger('submit');
		});

		$("#simpan_kirim").click(function(event) {
			event.preventDefault();
			$("input[name='status']").val("2");
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
					<td>`+new_id+`</td>

        			<td>
        				<input type="text" name="nama[]" class="form-control">
        			</td>

        			<td>
        				<input type="text" name="nim[]" class="form-control">
        			</td>

        			<td>
        				<select name="jurusan[]" class="form-control">
        					<option>-Pilih Jurusan-</option>
        					
        				</select>
        			</td>

        			<td>
        				<textarea class="form-control" rows="3" name="judul[]"></textarea>
        			</td>

        			<td>
        				<label for="pembimbing_utama">Utama</label>
        				<select name="pembimbing_utama[]" class="form-control">
        					
        				</select>

        				<label for="pembimbing_pendamping">Pendamping</label>
        				<select name="pembimbing_pendamping[]" class="form-control">
        					
        				</select>
        			</td>

        			<td>
        				<label for="penguji_utama">Utama</label>
        				<select name="penguji_utama[]" class="form-control">
        					
        				</select>

        				<label for="penguji_pendamping">pendamping</label>
        				<select name="penguji_pendamping[]" class="form-control">
        					
        				</select>
        			</td>

        			<td>
        				<button class="btn btn-danger" name="delete_data"><i class="fa fa-trash"></i></button>
        			</td>
				</tr>
			`);

			$.each(jurusan, function(index, val) {
				$("tr#"+new_id).find('select[name="jurusan[]"]').append(`<option value="`+index+`">`+val+`</option>`);
			})

			$.each(dosen, function(index, val) {
				$("tr#"+new_id).find('select[name="pembimbing_utama[]"]').append(`<option value="`+index+`">`+val+`</option>`);
				$("tr#"+new_id).find('select[name="pembimbing_pendamping[]"]').append(`<option value="`+index+`">`+val+`</option>`);
				$("tr#"+new_id).find('select[name="penguji_utama[]"]').append(`<option value="`+index+`">`+val+`</option>`);
				$("tr#"+new_id).find('select[name="penguji_pendamping[]"]').append(`<option value="`+index+`">`+val+`</option>`);
			})

			del_row();
		});

		del_row();

		function del_row() {
			$('button[name="delete_data"]').click(function(event) {
				var tr_id = $(this).parents("tr").attr('id');

				$(this).parents("tr").remove();
			});	
		}
		
	})
</script>
@endsection
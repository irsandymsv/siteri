@extends('kepegawaian.kepegawaian_view')

@section('page_title', 'Buat Surat SPD')
@section('judul_header','Buat Surat SPD')

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
			<form action="{{route('kepegawaian.spd.save', $surat->id)}}" method="POST">
				<div class="box-body">
					@csrf
					<div class="table-responsive">
						{{-- @if(session()->has('error'))
		            			<p style="color: red;">{{session('error')}}</p>
						@endif --}}
						<table id="tbl-data" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Nomor Surat</th>
									<th>Dosen yang Bertugas</th>
								</tr>
							</thead>

							<tbody>
								<td>
                  <input name="no_surat" type="text" class="form-control" value="{{$surat->nomor_surat}}" readonly>
								</td>

								<td>
									@foreach ($dosen_tugas as $dosen)
                    <p>{{$dosen->user->nama}} <br/> NIP: {{$dosen->user->no_pegawai}}</p>
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
                        <input disabled type="text" value="{{\Carbon\Carbon::parse($surat->started_at)->format('d/m/Y')}}" class="form-control pull-right" name="started_at" id="datepicker" readonly>
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
											<input disabled type="text" value="{{\Carbon\Carbon::parse($surat->end_at)->format('d/m/Y')}}" class="form-control pull-right" name="end_at" id="datepicker2" readonly>
										</div>
										<!-- /.input group -->
									</div>
								</td>
							</tbody>

							<thead>
								<tr>
									<th>Maksud Perjalanan Tugas</th>
									<th>Jenis Kendaraan</th>
								</tr>
							</thead>

							<tbody>
								<td>
	                  <p>{{$surat->keterangan}}</p>
	              </td>
	              <td>
                  <select name="jenis_kendaraan" class="form-control" required>
                    <option disabled selected value>Pilih Jenis Kendaraan</option>
                    @foreach ($jenis_kendaraan as $kendaraan)
                    <option value="{{$kendaraan->id}}" required>{{$kendaraan->nama}}</option>
                    @endforeach
                  </select>

                  @error('jenis_kendaraan')
                    <p class="invalid-feedback" role="alert" style="color: red;">
                      <strong>{{ $message }}</strong>
                    </p>
                  @enderror
                </td>
							</tbody>

               <thead>
								<tr>
									<th>Tempat</th>
                  <th>Biaya Harian</th>
								</tr>
							</thead>

							<tbody>
								<td>
                 	<label>Kota Asal</label>
                 	<input type="text" class="form-control" name="asal" value="Jember" placeholder="Masukan Kota Asal" required><br/>

                 	@error('asal')
									  <p class="invalid-feedback" role="alert" style="color: red;">
									    <strong>{{ $message }}</strong>
									  </p>
									@enderror

                 	<label>Kota Tujuan</label>
								  <input type="text" class="form-control" name="tujuan" value="{{$surat->lokasi}}" placeholder="Masukan Kota Tujuan" required>
                
								  @error('tujuan')
								    <p class="invalid-feedback" role="alert" style="color: red;">
								      <strong>{{ $message }}</strong>
								    </p>
								  @enderror
                </td>
                <td>
                  <label>Lama Perjalanan</label>
                  @php
                      $to = \Carbon\Carbon::createFromFormat('Y-m-d', $surat->started_at);
                      $from = \Carbon\Carbon::createFromFormat('Y-m-d', $surat->end_at);
                      $lama = $to->diffInDays($from);
                  @endphp
                  <input type="text" class="form-control" name="lama" value="{{$lama+1}}" disabled><br/>
                  <label>Uang Harian</label>
                  <input type="number" min="1000" step="1000" max="1000000000" class="form-control" name="uang_harian" placeholder="Jumlah" required>

                  @error('uang_harian')
                    <p class="invalid-feedback" role="alert" style="color: red;">
                      <strong>{{ $message }}</strong>
                    </p>
                  @enderror
                </td>
            	</tbody>
            
            	<thead>
								<tr>
									<th>Perlu Penginapan</th>
									<th>Biaya Penginapan</th>
								</tr>
							</thead>

							<tbody>
								<td>
                  <select id="penginapan" name="penginapan" class="form-control" required>
                    <option disabled selected value>Pilih opsi</option>
                    @foreach ($penginapan as $menginap)
                    <option value="{{$menginap->id}}">{{$menginap->penginapan}}</option>
                    @endforeach
                  </select>
	              </td>
	              <td>
	                  <input type="number" class="form-control" id="biaya_penginapan" name="biaya_penginapan" placeholder="Jumlah" required>

	                  @error('biaya_penginapan')
	                    <p class="invalid-feedback" role="alert" style="color: red;">
	                      <strong>{{ $message }}</strong>
	                    </p>
	                  @enderror
	              </td>
	          	</tbody>
          
	          	<thead>
								<tr>
									<th>Perlu Pendaftaran Acara</th>
									<th>Biaya Pendaftaran Acara</th>
								</tr>
							</thead>

							<tbody>
	              <td>
                  <select id="pendaftaran_acara" name="pendaftaran_acara" class="form-control" required>
                    <option disabled selected value>Pilih opsi</option>
                    @foreach ($pendaftaran_acara as $pendaftaran)
                    <option value="{{$pendaftaran->id}}" required>{{$pendaftaran->acara}}</option>
                    @endforeach
                  </select>

                  @error('pendaftaran_acara')
                    <p class="invalid-feedback" role="alert" style="color: red;">
                      <strong>{{ $message }}</strong>
                    </p>
                  @enderror
	              </td>
	              <td>
	                <input type="number" min="1000" step="1000" max="9000000000" class="form-control" id="biaya_pendaftaran" name="biaya_pendaftaran" placeholder="Jumlah" required>

	                @error('biaya_pendaftaran')
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
						<button type="submit" name="simpan_kirim" class="btn btn-success">Buat SPD</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	@endsection

	@section('script')
	<script src="{{asset('/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	

<script>
	$(document).ready(function(){
		$("#biaya_penginapan").prop("disabled", true);
		$("#biaya_pendaftaran").prop("disabled", true);
	});

  $(function(){
    $("#penginapan").change(function(){
      if ( $("#penginapan").val() == 1 ) {
        console.log(true)
        $('#biaya_penginapan').removeAttr("disabled");
      }

      if ( $("#penginapan").val() == 2 ) {
        console.log(true)
        $("#biaya_penginapan").prop("disabled", true);
      }        
    });	
  });

  $(function(){
    $("#pendaftaran_acara").change(function(){
       
      if ( $("#pendaftaran_acara").val() == 1 ) {
        console.log(true)
        $('#biaya_pendaftaran').removeAttr("disabled");
      }

      if ( $("#pendaftaran_acara").val() == 2 ) {
        console.log(true)
        $("#biaya_pendaftaran").prop("disabled", true);
      }
    });
  });


</script>

	@endsection
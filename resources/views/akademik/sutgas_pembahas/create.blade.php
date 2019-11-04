@extends('akademik.akademik_view')

@section('page_title')
	Buat Surat Tugas Pembahas Sempro
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		form{
			width: 90%;
			margin: auto;
		}

		#nim, #nama_mhs{
			/*width: 80%;*/
		}

		#no_surat{
			width: 25%;
		}

		#format_nomor{
			font-size: 16px;
		}

		#btn_group{
			float: right;
			margin-right: 20px;
		}
	</style>
@endsection

@section('judul_header')
	Surat Tugas pembahas Sempro
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Buat Surat Tugas Pembahas Sempro</h3>

               <br><br>
               @if (session('success'))
               <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-check"></i> Sukses</h4>
                   {{session('success')}}
               </div>
               @php
               Session::forget('success');
               @endphp

               @endif
               @if (session('error'))
               <div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-ban"></i>Error</h4>
                   {{session('error')}}
               </div>

               @php
               Session::forget('error');
               @endphp
               @endif
            </div>

            <form action="{{ route('akademik.sutgas-pembahas.store') }}" method="post">
               <div class="box-body">
            		@csrf
            		<div class="form-group">
            			<label for="no_surat">No Surat</label><br>
            			<input type="text" name="no_surat" id="no_surat" value="{{ old('no_surat') }}">
            			<span id="format_nomor">/UN25.1.15/SP/{{ Carbon\Carbon::today()->year }}</span>

                     @error('no_surat')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
            		</div>

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="nim">NIM Mahasiswa</label><br>
                           <select id="nim" name="nim" class="form-control select2">
                              <option value="">-- Pilih NIM --</option>
                              @foreach ($mahasiswa as $item)
                                 <option value="{{ $item->nim }}" {{ ($item->nim == old('nim')? 'selected' : '') }}>
                                    {{ $item->nim }}
                                 </option>
                              @endforeach
                           </select>

                           @error('nim')
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="nama_mhs">Nama Mahasiswa</label>
                           <input type="text" name="nama_mhs" id="nama_mhs" class="form-control" readonly="">
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="judul_inggris">Judul Bahasa Inggris Skripsi</label>
                     <textarea name="judul_inggris" id="judul_inggris" class="form-control" rows="3">{{ old('judul_inggris') }}</textarea>

                     @error('judul_inggris')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group" style="width: 40%;">
                     <label for="tanggal">Tanggal-Jam Pelaksanaan</label><br>
                     <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}">

                     @error('tanggal')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <label for="tempat">Tempat Pelaksanaan</label><br>

                     <div class="input-group">
                        <div class="input-group-addon">
                           Ruang Kuliah :
                        </div>
                        <input type="text" name="tempat" id="tempat" class="form-control" value="{{ old('tempat') }}">
                     </div>
                     <span><i>Note: Pisahkan nama ruang dengan tanda koma (,) jika ingin memasukkan banyak ruang</i></span>

                     @error('tempat')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

            		<div class="form-group">
            			<label for="id_pembahas1">Pembahas 1</label><br>
            			<select name="id_pembahas1" id="id_pembahas1" class="form-control select2">
            				<option value="">Pilih Pembahas 1</option>
            				@foreach ($dosen as $item)
            					<option value="{{ $item->no_pegawai }}" {{ ($item->no_pegawai == old('id_pembahas1')? 'selected' : '') }}>
                              {{ $item->nama }}
                           </option>
            				@endforeach
            			</select>

                     @error('id_pembahas1')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
            		</div>

            		<div class="form-group">
            			<label for="id_pembahas2">Pembahas 2</label><br>
            			<select name="id_pembahas2" id="id_pembahas2" class="form-control select2">
            				<option value="">Pilih Pembahas 2</option>
            				@foreach ($dosen as $item)
            					<option value="{{ $item->no_pegawai }}" {{ ($item->no_pegawai == old('id_pembahas2')? 'selected' : '') }}>
                              {{ $item->nama }}
                           </option>
            				@endforeach
            			</select>

                     @error('id_pembahas2')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
            		</div>
               </div>

               <div class="box-footer">
                  <input type="hidden" name="status" value="">
                  <a href="{{ route('akademik.sutgas-pembahas.index') }}" class="btn btn-default">Batal</a> &ensp;

                  <div id="btn_group">
                     {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                     <button type="submit" name="simpan_draf" class="btn bg-purple">Simpan Sebagai Draft</button> &ensp;
                     <button type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>
                  </div>
               </div>
            </form>

   		</div>
   	</div>
	</div>
@endsection

@section('script')
	<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script type="text/javascript">
		$('.select2').select2();

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

      var mahasiswa = @json($mahasiswa);
      var nim_old = @json(old('nim'));

      if(nim_old != null){
         var nama = "";
         console.log('ada gan');
         $.each(mahasiswa, function(index, val) {
             if(nim_old == val.nim){
               nama = val.nama;
               return false;
             }
         });

         $("input[name='nama_mhs']").val(nama);
      }

		$("select[name='nim']").change(function(event) {
			var nim = $(this).val();
			var nama = "";
			$.each(mahasiswa, function(index, val) {
				 if(nim == val.nim){
				 	nama = val.nama;
				 	return false;
				 }
			});
			$("input[name='nama_mhs']").val(nama);
		});
	</script>
@endsection

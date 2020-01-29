@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Ubah Surat Tugas Penguji Skripsi
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
	Surat Tugas Penguji Skripsi
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Ubah Surat Tugas Penguji Skripsi</h3>

               <br><br>
               <h4>Status surat tugas : {{ $surat_tugas->status_surat_tugas->status }}</h4>
            </div>
            <div class="col-xs-12">
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
                @php
                Session::forget('error');
                @endphp
                @endif
            </div>
            <form action="{{route('akademik.sutgas-penguji.update',$surat_tugas->id)}}" method="post">
               <div class="box-body">
                  @csrf
                  @method('PUT')
                  <input type="hidden" name="id_detail_skripsi" value="{{$surat_tugas->detail_skripsi->id}}">
                  <input type="hidden" name="id_skripsi" value="{{$surat_tugas->detail_skripsi->id_skripsi}}">
                  <input type="hidden" name="original_nim" value="{{$surat_tugas->detail_skripsi->skripsi->nim}}">
                  <div class="form-group">
                     <label for="no_surat">No Surat</label><br>
                     <input type="text" name="no_surat" id="no_surat" value="{{ $surat_tugas->no_surat }}">
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
                                 <option value="{{ $item->nim }}" {{ ($item->nim == $surat_tugas->detail_skripsi->skripsi->nim? 'selected':'' ) }}>{{ $item->nim }}</option>
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
                           <input type="text" name="nama_mhs" id="nama_mhs" class="form-control" readonly="" value="{{ $surat_tugas->detail_skripsi->skripsi->mahasiswa->nama }}">
                        </div>
                     </div>
                  </div>

                  <div class="form-group" style="width: 40%;">
                     <label for="tanggal">Tanggal-Jam Pelaksanaan</label><br>
                     <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" value="{{ $tanggal }}">

                     @error('tanggal')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <label for="tempat">Tempat Pelaksanaan</label><br>
                     <input type="text" name="tempat" id="tempat" class="form-control" value="{{ $surat_tugas->tempat }}">

                     @error('tempat')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <label for="id_penguji1">Penguji 1</label><br>
                     <select name="id_penguji1" id="id_penguji1" class="form-control select2">
                        <option value="">--Pilih Penguji 1--</option>
                        @foreach ($dosen1 as $item)
                           @if ($pembimbing['dosen1']->no_pegawai != $item->no_pegawai && $pembimbing['dosen2']->no_pegawai != $item->no_pegawai)

                              <option value="{{ $item->no_pegawai }}" {{ ($item->no_pegawai == $surat_tugas->id_dosen1? 'selected':'') }}>
                              {{ $item->nama }}
                              </option>

                           @endif
                        @endforeach
                     </select>

                     @error('id_penguji1')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <label for="id_penguji2">Penguji 2</label><br>
                     <select name="id_penguji2" id="id_penguji2" class="form-control select2">
                        <option value="">--Pilih Penguji 2--</option>
                        @foreach ($dosen2 as $item)
                           @if ($pembimbing['dosen1']->no_pegawai != $item->no_pegawai && $pembimbing['dosen2']->no_pegawai != $item->no_pegawai)

                              <option value="{{ $item->no_pegawai }}" {{ ($item->no_pegawai == $surat_tugas->id_dosen2? 'selected':'') }}>
                              {{ $item->nama }}
                              </option>
                           @endif
                        @endforeach
                     </select>

                     @error('id_penguji2')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>

               <div class="box-footer">
                  <input type="hidden" name="status" value="">
                  <a href="{{ route('akademik.sutgas-penguji.show', $surat_tugas->id) }}" class="btn btn-default">Kembali</a> &ensp;

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
      var dosen1 = @json($dosen1);
      var dosen2 = @json($dosen2);
      var id_dosen1 = @json($surat_tugas->id_dosen1);
      var id_dosen2 = @json($surat_tugas->id_dosen2);

      //Set disable pilihan dosen di select dosen 2 yg sdh dipilih di select dosen 1
      $("select#id_penguji2 option[value='"+id_dosen1+"']").attr('disabled', 'disabled');
      //Set disable pilihan dosen di select dosen 1 yg sdh dipilih di select dosen 2
      $("select#id_penguji1 option[value='"+id_dosen2+"']").attr('disabled', 'disabled');

      // Set dosen yg sama di select dosen 2 jadi disabled ketika select dosen 1 berubah
      $("select#id_penguji1").change(function(event) {
         $("select#id_penguji2 option[disabled='disabled']").removeAttr('disabled');
         var no_pegawai = $(this).val();
         $("select#id_penguji2 option[value='"+no_pegawai+"']").attr('disabled', 'disabled');
      });

      //Set dosen yg sama di select dosen 1 jadi disabled ketika select dosen 2 berubah   
      $("select#id_penguji2").change(function(event) {
         $("select#id_penguji1 option[disabled='disabled']").removeAttr('disabled');
         var no_pegawai = $(this).val();
         $("select#id_penguji1 option[value='"+no_pegawai+"']").attr('disabled', 'disabled');
      });

		$("select[name='nim']").change(function(event) {
			var nim = $(this).val();
			var nama = "";
			$.each(mahasiswa, function(index, val) {
				 if(nim == val.nim){
				 	nama = val.nama;
               // id_pembimbing1 = val.detail_skripsi.id_pembimbing_utama;
               // id_pembimbing2 = val.detail_skripsi.id_pembimbing_pendamping;
				 	return false;
				 }
			});
			$("input[name='nama_mhs']").val(nama);

         // var id_pembimbing1 = 0;
         // var id_pembimbing2 = 0;
         var route = "{{ route('akademik.getPembimbing') }}" + "/" + nim;
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });

         $.ajax({
            url: route,
            type: 'GET',
            // dataType: 'json',
            // data: {'nim': nim},
         })
         .done(function(pembimbing) {
            console.log("success");
            // console.log(pembimbing);
            setDosen(pembimbing['dosen1'].no_pegawai, pembimbing['dosen2'].no_pegawai);
         })
         .fail(function() {
            console.log("error");
         });
		});

      function setDosen(id_pembimbing1, id_pembimbing2) {
         $("select[name='id_penguji1']").find("option:not(:first-child)").remove();
         $("select[name='id_penguji2']").find("option:not(:first-child)").remove();

         $.each(dosen1, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               $("select[name='id_penguji1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               // $("select[name='id_Penguji2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
            }
         });

         $.each(dosen2, function(index, val) {
            if(val.no_pegawai != id_pembimbing1 && val.no_pegawai != id_pembimbing2){
               // $("select[name='id_Penguji1']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
               $("select[name='id_penguji2']").append(`<option value="`+val.no_pegawai+`">`+val.nama+`</option>`);
            }
         });
      }
	</script>
@endsection

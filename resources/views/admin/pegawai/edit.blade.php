@extends('layouts.template')

@section('side_menu')
    @include('include.'.$jabatan_user.'_menu')
@endsection

@section('css_link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>

<style type="text/css">
	.red_star{
      color: red;
   }
</style>
@endsection

@section('page_title', 'Ubah Data Pegawai')

@section('judul_header')
	Data Pegawai
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 ">
            <div class="panel panel-default">
               <div class="panel-heading">Update Pegawai</div>

               <div class="panel-body">
                	@if (session()->has('success'))
                	   <div class="alert alert-success alert-block">
                	      <button type="button" class="close" data-dismiss="alert">x</button>
                	         {{ session()->get('success')}}
                	   </div>
                	@endif

                 	<form class="form-horizontal" role="form" method="POST"
                     action="{{route($jabatan_user.'.pegawai.update', $user->username)}}" enctype="multipart/form-data">
                     <input type="hidden" name="_method" value="PUT">
                     <input type="hidden" name="_token" value="{{ csrf_token() }}">

                     <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                        <label for="nama" class="col-md-4 control-label">Nama <span class="red_star">*</span></label>
                        <div class="col-md-6">
                           <input id="nama" type="text" class="form-control" name="nama" value="{{$user->nama}}" required autofocus>
                        </div>
                        @error('nama')
                           <div style="color:red;"><span>{{ $message }}</span></div>
                        @enderror
                     </div>

                     <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
                         <label for="no_pegawai" class="col-md-4 control-label">NIP <span class="red_star">*</span></label>
                         <div class="col-md-6">
                             <input type="text" name="no_pegawai" id="no_pegawai" class="form-control"  value="{{ $user->no_pegawai}}" required>

                             @error('no_pegawai')
                                <div style="color:red;"><span>{{ $message }}</span></div>
                             @enderror
                         </div>
                     </div>

                     <div class="form-group{{ $errors->has('npwp') ? ' has-error' : '' }}">
                         <label for="npwp" class="col-md-4 control-label">NPWP</label>
                         <div class="col-md-6">
                             <input type="text" name="npwp" id="npwp" class="form-control" value="{{ $user->npwp}}" required>

                             @if ($errors->has('npwp'))
                             <span class="help-block">
                                 <strong>{{ $errors->first('nip') }}</strong>
                             </span>
                             @endif
                         </div>
                     </div>

                     <div class="form-group @error('dosen') is-invalid @enderror">
                        <label for="middlename" class="col-md-4 control-label">Dosen <span class="red_star">*</span></label>
                        <div class="col-md-6">
                           <select name="dosen" id="dosen" class="form-control" required>
                              <option value="">Masukkan Pilihan</option>
                              <option value="1" {{ ($user->is_dosen == "1")? 'selected':'' }}>Iya</option>
                              <option value="0" {{ ($user->is_dosen == "0")? 'selected':'' }}>Tidak</option>
                           </select>
                           @error('dosen')
                           <div style="color:red;"><span>{{ $message }}</span></div>
                           @enderror
                        </div>
                     </div>

                     <div class="form-group" id="div_fungsional" hidden>
                        <label for="address" class="col-md-4 control-label">Jabatan Fungsional <span class="red_star">*</span></label>
                        <div class="col-md-6">
                           <select id="fungsional" name="fungsional" class="form-control" {{ ($user->is_dosen == 1)? 'required':'' }}>
                           	<option value="">Pilih Fungsional</option>
                              @foreach($fungsional as $fungsional)
                           	<option value="{{$fungsional->id}}" {{ ($fungsional->id == $user->id_fungsional)? 'selected':'' }}>{{ $fungsional->jab_fungsional }}</option>
                              @endforeach
                           </select>
                           @error('fungsional')
                           <div style="color:red;"><span>{{ $message }}</span></div>
                           @enderror
                        </div>
                     </div>

                     <div class="form-group" id="div_prodi" hidden>
                        <label for="address" class="col-md-4 control-label">Program Studi</label>
                        <div class="col-md-6">
                           <select id="prodi" name="prodi" class="form-control">
                           	{{-- <option value="{{$user->id_fungsional}}">{{$user->fungsionalnya['jab_fungsional']}}</option> --}}
                           	<option value="">Pilih Program Studi</option>
                              @foreach($prodi as $pro)
                           	<option value="{{$pro->id}}" {{ ($pro->id == $user->jurusan)? 'selected':'' }}>
                           		{{ $pro->nama }}
                           	</option>
                              @endforeach
                           </select>
                           @error('prodi')
                           <div style="color:red;"><span>{{ $message }}</span></div>
                           @enderror
                        </div>
                     </div>

                     <div class="form-group" id="div_bagian" hidden>
                        <label for="address" class="col-md-4 control-label">Bagian</label>
                        <div class="col-md-6">
                           <select id="bagian" name="bagian" class="form-control">
                           	{{-- <option value="{{$user->id_fungsional}}">{{$user->fungsionalnya['jab_fungsional']}}</option> --}}
                           	<option value="">Pilih Bagian</option>
                              @foreach($bagian as $item)
                           	<option value="{{$item->id}}" {{ ($item->id == $user->id_bagian)? 'selected':'' }}>
                           		{{ $item->bagian }}
                           	</option>
                              @endforeach
                           </select>
                           @error('bagian')
                           <div style="color:red;"><span>{{ $message }}</span></div>
                           @enderror
                        </div>
                     </div>

                    	<div class="form-group">
                        <label for="address" class="col-md-4 control-label">Jabatan <span class="red_star">*</span></label>
                        <div class="col-md-6">
                           <select name="jabatan" class="form-control" required>
                       	   	{{-- <option value="{{$user->id_jabatan}}">{{$user->jabatannya['jabatan']}}</option> --}}
                       	   	<option value="">Pilih Jabatan</option>
                              @foreach($jabatan as $jabatan)
                             	<option value="{{$jabatan->id}}" {{ ($jabatan->id == $user->id_jabatan)? 'selected':'' }}>
                             		{{ $jabatan->jabatan }}
                             	</option>
                              @endforeach
                           </select>
                           @error('jabatan')
                           <div style="color:red;"><span>{{ $message }}</span></div>
                           @enderror
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('pangkat') ? ' has-error' : '' }}">
                        <label for="middlename" class="col-md-4 control-label">Pangkat</label>
                        <div class="col-md-6">
                           <select id="pangkat" name="pangkat" class="form-control" required>
                             	{{-- <option value="{{$user->id_pangkat}}">{{$user->pangkatnya['pangkat']}}</option> --}}

                              @foreach($pangkat as $p)
                             	<option value="{{$p->id}}" {{ ($p->id == $user->id_pangkat)? 'selected':'' }}>
                             		{{$p->pangkat}}
                             	</option>
                              @endforeach
                           </select>
                           @error('pangkat')
                           <div style="color:red;"><span>{{ $message }}</span></div>
                           @enderror
                        </div>
                     </div>

                     <div class="form-group{{ $errors->has('pangkat') ? ' has-error' : '' }}">
                       	<label for="golongan" class="col-md-4 control-label">Golongan</label>
                       	<div class="col-md-6">
                           <select id="golongan" name="golongan" class="form-control" required>
                           	{{-- <option value="{{$user->id_golongan}}">{{$user->golongannya['golongan']}}</option> --}}

                              @foreach($golongan as $gol)
                           	<option value="{{$gol->id}}" {{ ($gol->id == $user->id_golongan)? 'selected':'' }}>
                           		{{$gol->golongan}}
                           	</option>
                              @endforeach
                           </select>
                           @error('golongan')
                           <div style="color:red;"><span>{{ $message }}</span></div>
                           @enderror
                       	</div>
                   	</div>

                     <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                        	<span class="red_star">* Wajib Diisi</span><br><br>
                           <button type="submit" class="btn btn-primary">
                              Update
                           </button>
                          	<a href="{{route($jabatan_user.'.pegawai.index')}}" class="btn btn-default">Kembali</a>
                        </div>
                     </div>
                 	</form>

                 	<script type="text/javascript">
                     $(".livesearch").chosen();
                 	</script>
               </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
@endsection
@section('script')
<script src="{{asset('/adminlte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script>
// $(document).ready(function(){
// 	$("#formInput :input").prop("disabled", true);
// 	$("#fungsional").removeAttr("disabled");
// 	if ( $("#fungsional").val() == 6 ) {
// 		$("#pangkat").prop("disabled", true);
// 		$("#golongan").prop("disabled", true);
// 	}
// });

dosen = "{{ $user->is_dosen }}";
if (dosen == "1") {
   $("#div_fungsional").show();
   $("#div_prodi").show();
}
else if (dosen == "0") {
   $("#div_bagian").show();  
}

$(function(){

   $("#dosen").change(function(){
      if ( $("#dosen").val() == 1 ) {
         $("#fungsional").prop("required", true);
         $("#div_fungsional").show();
         $("#div_prodi").show();
         $("#div_bagian").hide();
         // $("#pangkat").prop("disabled", true);
         // $("#golongan").prop("disabled", true);
      }
      else if ($("#dosen").val() == 0) {
         $("#fungsional").prop("required", false);
         $("#div_fungsional").hide();
         $("#div_prodi").hide();
         $("#div_bagian").show();
      }
   });
});
</script>
@endsection

@extends('admin.admin_view')
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
@section('page_title','Tambah Data Pegawai')
@section('content')
{{-- <section class="content-header">
    <h1>
        <b>DATA PEGAWAI</b>
    </h1>
</section> --}}

<div class="container">
   <div class="row">
      <div class="col-md-10 col-md-offset-1 ">
         <div class="panel panel-default">
            <div class="panel-heading">Tambah Data Pegawai</div>
            <div class="panel-body">
               <form class="form-horizontal" role="form" method="POST" action="{{route('admin.pegawai.store')}}"
                  enctype="multipart/form-data">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group @error('nama') is-invalid @enderror">
                     <label for="nama" class="col-md-4 control-label">Nama <span class="red_star">*</span></label>
                     <div class="col-md-6">
                        <input type="text" class="form-control" name="nama" placeholder="Masukan nama" value="{{ old('nama') }}" required autofocus>
                        @error('nama')
                        <div style="color:red;"><span>{{ $message }}</span></div>
                        @enderror
                     </div>
                  </div>


                  <div class="form-group @error('username') is-invalid @enderror">
                     <label for="username" class="col-md-4 control-label">Username <span class="red_star">*</span></label>
                     <div class="col-md-6">
                        <input type="text" class="form-control" name="username" placeholder="Masukan username" value="{{ old('username') }}"
                              required>
                        @error('username')
                        <div style="color:red;"><span>{{ $message }}</span></div>
                        @enderror
                     </div>
                  </div>


                  {{-- <div class="form-group @error('password') is-invalid @enderror">
                      <label for="password" class="col-md-4 control-label">Password</label>
                      <div class="col-md-6">
                          <input type="password" class="form-control" name="password"
                              placeholder="Masukan password" required>
                          @error('password')
                          <div style="color:red;"><span>{{ $message }}</span></div>
                          @enderror
                      </div>
                  </div> --}}

                  <div class="form-group @error('no_pegawai') is-invalid @enderror">
                      <label for="nip" class="col-md-4 control-label">NIP <span class="red_star">*</span></label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="no_pegawai" placeholder="Masukan NIP" value="{{ old('no_pegawai') }}" required>
                          @error('no_pegawai')
                          <div style="color:red;"><span>{{ $message }}</span></div>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group @error('npwp') is-invalid @enderror">
                      <label for="nip" class="col-md-4 control-label">NPWP </label>
                      <div class="col-md-6">
                          <input type="text" class="form-control" name="npwp" placeholder="Masukan NPWP" value="{{ old('npwp') }}" required>
                          @error('NPWP')
                          <div style="color:red;"><span>{{ $message }}</span></div>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group @error('dosen') is-invalid @enderror">
                     <label for="middlename" class="col-md-4 control-label">Dosen <span class="red_star">*</span></label>
                     <div class="col-md-6">
                        <select name="dosen" id="dosen" class="form-control" required>
                            <option value="">Masukkan pilihan</option>
                            <option value="1" {{ (old('dosen') == "1")? 'selected':'' }}>Iya</option>
                            <option value="0" {{ (old('dosen') == "0")? 'selected':'' }}>Tidak</option>
                        </select>
                        @error('dosen')
                        <div style="color:red;"><span>{{ $message }}</span></div>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group  @error('fungsional') is-invalid @enderror" id="div_fungsional" hidden>
                     <label for="fungsional" class="col-md-4 control-label">Jabatan Fungsional <span class="red_star">*</span></label>
                     <div class="col-md-6">
                        <select id="fungsional" name="fungsional" class="form-control">
                           <option value="">Pilih fungsional</option>
                           @foreach($fungsional as $fungsional)
                           <option value="{{$fungsional->id}}" {{ (old('fungsional') == $fungsional->id)? 'selected':'' }}>
                              {{ $fungsional->jab_fungsional }}
                           </option>
                           @endforeach
                        </select>
                        @error('fungsional')
                        <div style="color:red;"><span>{{ $message }}</span></div>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group  @error('prodi') is-invalid @enderror" id="div_prodi" hidden>
                     <label for="prodi" class="col-md-4 control-label">Program Studi</label>
                     <div class="col-md-6">
                        <select id="prodi" name="prodi" class="form-control">
                           <option value="">Pilih Program Studi</option>
                           @foreach($prodi as $pro)
                           <option value="{{$pro->id}}" {{ (old('prodi') == $pro->id)? 'selected':'' }}>
                              {{ $pro->nama }}
                           </option>
                           @endforeach
                        </select>
                        @error('prodi')
                        <div style="color:red;"><span>{{ $message }}</span></div>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group  @error('prodi') is-invalid @enderror" id="div_bagian" hidden>
                     <label for="bagian" class="col-md-4 control-label">Bagian</label>
                     <div class="col-md-6">
                        <select id="bagian" name="bagian" class="form-control">
                           <option value="">Pilih bagian</option>
                           @foreach($bagian as $item)
                           <option value="{{$item->id}}" {{ (old('bagian') == $item->id)? 'selected':'' }}>
                              {{ $item->bagian }}
                           </option>
                           @endforeach
                        </select>
                        @error('bagian')
                        <div style="color:red;"><span>{{ $message }}</span></div>
                        @enderror
                     </div>
                  </div>

                  <div class="form-group @error('jabatan') is-invalid @enderror">
                      <label for="middlename" class="col-md-4 control-label">Jabatan <span class="red_star">*</span></label>
                      <div class="col-md-6">
                          <select name="jabatan" class="form-control" required>
                              <option value="">Pilih Jabatan</option>
                              @foreach($jabatan as $jab)
                              <option value="{{$jab->id}}" {{ (old('jabatan') == $jab->id) ? 'selected':'' }}>
                                 {{$jab->jabatan}}
                              </option>
                              @endforeach
                          </select>
                          @error('jabatan')
                          <div style="color:red;"><span>{{ $message }}</span></div>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group @error('pangkat') is-invalid @enderror">
                      <label for="middlename" class="col-md-4 control-label">Pangkat</label>
                      <div class="col-md-6">
                          <select id="pangkat" name="pangkat" class="form-control">
                              <option value="">Pilih pangkat</option>
                              @foreach($pangkat as $p)
                              <option value="{{$p->id}}" {{ (old('pangkat') == $p->id) ? 'selected':'' }}>
                                 {{$p->pangkat}}
                              </option>
                              @endforeach
                          </select>
                          @error('pangkat')
                          <div style="color:red;"><span>{{ $message }}</span></div>
                          @enderror
                      </div>
                  </div>

                  <div class="form-group @error('golongan') is-invalid @enderror">
                      <label for="golongan" class="col-md-4 control-label">Golongan</label>
                      <div class="col-md-6">
                        <select id="golongan" name="golongan" class="form-control">
                           <option value="">Pilih golongan</option>
                           @foreach($golongan as $gol)
                           <option value="{{$gol->id}}" {{ (old('golongan') == $gol->id) ? 'selected':'' }}>
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
                        <span class="red_star"><b>* Wajib Diisi</b></span><br><br>
                        <button type="submit" class="btn btn-primary">
                               Buat
                        </button>
                        <a href="{{route('admin.pegawai.index')}}" class="btn btn-default">Batal</a>
                     </div>
                  </div>

               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /.content -->
@endsection
@section('script')
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script>
// $(document).ready(function(){
//    $("#formInput :input").prop("disabled", true);
//    $("#fungsional").removeAttr("disabled");
// });

dosen_old = @json(old('dosen')) ;
if (dosen_old == "1") {
   $("#div_fungsional").show();
   $("#div_prodi").show();
}
else if (dosen_old == "0") {
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

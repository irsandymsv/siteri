@extends('admin.admin_view')
@section('css_link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
@endsection
@section('page_title','Admin Dashboard')
@section('content')
<section class="content-header">
    <h1>
        <b>DATA PEGAWAI</b>
    </h1>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 ">
            <div class="panel panel-default">
                <div class="panel-heading">Update Pegawai</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                        action="{{route('admin.pegawai.update', $users->username)}}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('nama') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">Nama</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="nama"
                                    value="{{$users->nama}}" required autofocus>

                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('nip') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">NIP</label>

                            <div class="col-md-6">
                                <input readonly id="lastname" type="text" class="form-control" name="nip"
                                    value="{{ $users->no_pegawai}}" required>

                                @if ($errors->has('nip'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nip') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group @error('dosen') is-invalid @enderror">
                                <label for="middlename" class="col-md-4 control-label">Dosen</label>
                                <div class="col-md-6">
                                    <select name="dosen" class="form-control" required>
                                        @if ($users->is_dosen == 0)
                                        <option value="0">Tidak</option>
                                        @else
                                        <option value="1">Iya</option>
                                        @endif
                                        <option value="1">Iya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    @error('jabatan')
                                    <div style="color:red;"><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                    <label for="address" class="col-md-4 control-label">Jabatan Fungsional</label>

                                    <div class="col-md-6">
                                        <select id="fungsional" name="fungsional" class="form-control" required>
                                        <option value="{{$users->id_fungsional}}">{{$users->fungsionalnya['jab_fungsional']}}</option>
                                            @foreach($fungsional as $fungsional)
                                        <option value="{{$fungsional->id}}">{{ $fungsional->jab_fungsional }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                        <label for="address" class="col-md-4 control-label">Jabatan</label>

                                        <div class="col-md-6">
                                            <select name="jabatan" class="form-control" required>
                                            <option value="{{$users->id_jabatan}}">{{$users->jabatannya['jabatan']}}</option>
                                                @foreach($jabatan as $jabatan)
                                            <option value="{{$jabatan->id}}">{{ $jabatan->jabatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                        <div class="form-group{{ $errors->has('pangkat') ? ' has-error' : '' }}">
                            <label for="middlename" class="col-md-4 control-label">Pangkat</label>

                            <div class="col-md-6">
                                <select id="pangkat" name="pangkat" class="form-control" required>
                                <option value="{{$users->id_pangkat}}">{{$users->pangkatnya['pangkat']}}</option>
                                    @foreach($pangkat as $p)
                                <option value="{{$p->id}}">{{$p->pangkat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pangkat') ? ' has-error' : '' }}">
                                <label for="golongan" class="col-md-4 control-label">Golongan</label>

                                <div class="col-md-6">
                                    <select id="golongan" name="golongan" class="form-control" required>
                                    <option value="{{$users->id_golongan}}">{{$users->golongannya['golongan']}}</option>
                                        @foreach($golongan as $gol)
                                    <option value="{{$gol->id}}">{{$gol->golongan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>





                        <div class="form-group">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                <a href="{{route('admin.pegawai.index')}}" class="btn btn-default">Kembali</a>
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
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

<script>
$(document).ready(function(){
// $("#formInput :input").prop("disabled", true);
// $("#fungsional").removeAttr("disabled");
if ( $("#fungsional").val() == 6 ) {
$("#pangkat").prop("disabled", true);
$("#golongan").prop("disabled", true);
}
});

$(function(){
$("#fungsional").change(function(){
if ( $("#fungsional").val() == 6 ) {
$("#pangkat").prop("disabled", true);
$("#golongan").prop("disabled", true);

}
else{
    $("#pangkat").prop("disabled", false);
$("#golongan").prop("disabled", false);

}


});
});
</script>
@endsection

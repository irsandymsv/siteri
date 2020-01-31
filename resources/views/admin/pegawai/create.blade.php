@extends('admin.admin_view')
@section('css_link')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
@endsection
@section('page_title','Admin Dashboard')
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
                            <label for="nama" class="col-md-4 control-label">Nama</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="nama" placeholder="Masukan nama" required
                                    autofocus>
                                    @error('nama')
                                    <div style="color:red;"><span>{{ $message }}</span></div>
                                    @enderror
                            </div>
                        </div>


                        <div class="form-group @error('username') is-invalid @enderror">
                            <label for="username" class="col-md-4 control-label">Username</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" placeholder="Masukan username"
                                    required>
                                @error('username')
                                <div style="color:red;"><span>{{ $message }}</span></div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group @error('password') is-invalid @enderror">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password"
                                    placeholder="Masukan password" required>
                                @error('password')
                                <div style="color:red;"><span>{{ $message }}</span></div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group @error('no_pegawai') is-invalid @enderror">
                            <label for="nip" class="col-md-4 control-label">NIP</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="no_pegawai" placeholder="Masukan NIP" required>
                                @error('no_pegawai')
                                <div style="color:red;"><span>{{ $message }}</span></div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group @error('jabatan') is-invalid @enderror">
                            <label for="middlename" class="col-md-4 control-label">Jabatan</label>
                            <div class="col-md-6">
                                <select name="jabatan" class="livesearch" required>
                                    <option value="">Pilih Jabatan</option>
                                    @foreach($jabatan as $jab)
                                    <option value="{{$jab->id}}">{{$jab->jabatan}}</option>
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
                                <select name="pangkat" class="livesearch" required>
                                    <option>Pilih pangkat</option>
                                    @foreach($pangkat as $p)
                                    <option value="{{$p->id}}">{{$p->pangkat}}</option>
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
                                <select name="golongan" class="livesearch" required>
                                    <option>Pilih golongan</option>
                                    @foreach($golongan as $gol)
                                    <option value="{{$gol->id}}">{{$gol->golongan}}</option>
                                    @endforeach
                                </select>
                                @error('golongan')
                                <div style="color:red;"><span>{{ $message }}</span></div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group @error('fungsional') is-invalid @enderror">
                            <label for="fungsional" class="col-md-4 control-label">Jabatan Fungsional</label>
                            <div class="col-md-6">
                                <select name="fungsional" class="livesearch" required>
                                    <option>Pilih fungsional</option>
                                    @foreach($fungsional as $fungsional)
                                    <option value="{{$fungsional->id}}">{{ $fungsional->jab_fungsional }}</option>
                                    @endforeach
                                </select>
                                @error('fungsional')
                                <div style="color:red;"><span>{{ $message }}</span></div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Buat
                                    </button>
                                    <a href="{{route('admin.pegawai.index')}}" class="btn btn-default">Batal</a>
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
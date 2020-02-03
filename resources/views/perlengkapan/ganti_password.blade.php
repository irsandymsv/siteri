@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title','Ganti Password')

@section('judul_header', 'Ganti Password')

@section('css_link')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
<style type="text/css">
    .table-responsive{
        width: 90%;
        margin: auto;
        font-size: 15px;
    }

    table tr td:first-child{
        width: 25%;
        font-weight: bold;:
    }
    .siteri {
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="box-body">
                <div class="card">
                    <div class="col-md-4">
                    <form action="{{route('simpan.password', Auth::user()->no_pegawai)}}" method="POST">
                        @method('put')
                        @csrf
                        <div class="form-group">
                            <br>
                            <label for="password"> Password Baru </label>
                            <input style="margin-bottom:8px;" type="password" name="password" class="form-control" placeholder="Masukan Password Baru">
                            <label for="password"> Konfirmasi Password Baru </label>
                            <input type="password" name="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password Baru">
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <br><br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<!-- /.content -->
@endsection

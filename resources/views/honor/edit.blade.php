@extends('layouts.template')

@section('side_menu')
  <li class="treeview">
     <a href="#"><i class="fa fa-link"></i> <span>Nama Honor</span>
        <span class="pull-right-container">
           <i class="fa fa-angle-left pull-right"></i>
        </span>
     </a>
     <ul class="treeview-menu">
        <li><a href="{{ route('honor.create') }}">Buat Baru</a></li>
        <li><a href="{{ route('honor.index') }}">Lihat Semua</a></li>
     </ul>
  </li>
@endsection

@section('page_title')
	Ubah Besaran Honor
@endsection

@section('css_link')
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">

	</style>
@endsection

@section('judul_header')
	Ubah Besaran Honor
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
   	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
                  <h3 class="box-title">Ubah Besaran Honor</h3>

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
                  <form action="{{ route('honor.update', $honor->id) }}" method="post">
                     @csrf
                     @method('PUT')
                     <div class="box-body">
                        <div class="form-group">
                           <label for="nama_honor">Nama Honor</label>
                           <input type="text" class="form-control" id="nama_honor" name="nama_honor" value="{{ $honor->nama_honor }}">

                           @error('nama_honor')
                              <br>
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>

                        <div class="form-group">
                           <label for="jumlah_honor">Besaran Honor</label>
                           <div class="input-group">
                              <div class="input-group-addon">
                                 Rp
                              </div>
                              <input type="number" class="form-control" id="jumlah_honor" name="jumlah_honor" value="{{ $honor->histori_besaran_honor[0]->jumlah_honor }}">
                            </div>

                           @error('jumlah_honor')
                              <br>
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>

                     <div class="box-footer">
                        <a href="{{ route('honor.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                     </div>
                  </form>
      		</div>
      	</div>
   	</div>

@endsection

@section('script')
   <script src="/ckeditor/ckeditor.js"></script>
   <script src="/js/btn_backTop.js"></script>
@endsection

@extends('layouts.template')

@section('side_menu')

@endsection

@section('page_title')
	Buat Nama Template Surat
@endsection

@section('css_link')
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">

	</style>
@endsection

@section('judul_header')
	Buat Nama Template Surat
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
   	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
                  <h3 class="box-title">Buat Nama Template Surat</h3>

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
                  <form action="{{ route('template.store') }}" method="post">
                     @csrf
                     <div class="box-body">
                        <div class="form-group">
                           <label for="nama">Nama Template</label>
                          <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama_surat') }}">

                          @error('nama')
                             <br>
                             <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $message }}</strong>
                             </span>
                          @enderror
                        </div>
                     </div>

                     <div class="box-footer">
                        <a href="{{ route('template.index') }}" class="btn btn-default">Kembali</a>
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
   <script type="text/javascript">
      CKEDITOR.replace('editor1', {
         height: '400px',
         tabSpaces: 4
       })
   </script>
@endsection

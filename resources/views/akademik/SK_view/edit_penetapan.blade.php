@extends('akademik.akademik_view')

@section('page_title')
	@if($tipe == "sk skripsi")
      Ubah Halaman Penetapan SK Skripsi
   @else
      Ubah Halaman Penetapan SK Sempro
   @endif
@endsection

@section('css_link')
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">

	</style>
@endsection

@section('judul_header')
	@if($tipe == "sk skripsi")
      Ubah Halaman Penetapan SK Skripsi
   @else
      Ubah Halaman Penetapan SK Sempro
   @endif
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
   	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
                  <h3 class="box-title">Ubah Halaman Penetapan SK {{ ($tipe == "sk skripsi"? "Skripsi" : "Sempro") }}</h3>

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
                  <form action="{{ ( $tipe == "sk skripsi"? route('akademik.skripsi.update-penetapan-sk') : route('akademik.sempro.update-penetapan-sk') ) }}" method="post">
                     @csrf @method('PUT')
                     <div class="box-body">
                        <textarea id="editor1" name="isi" rows="20" cols="80"></textarea>
                     </div>

                     <div class="box-footer">
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

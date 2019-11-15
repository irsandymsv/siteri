@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
    Ubah Template SK
@endsection

@section('css_link')
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">

	</style>
@endsection

@section('judul_header')
    Ubah Template SK
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
   	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
                  <h3 class="box-title">Ubah Template SK</h3>

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
                  <form action="{{ route('akademik.template-sk.update', $template->id) }}" method="post">
                     @csrf @method('PUT')
                     <div class="box-body">
                        <div class="form-group">
                           <label for="id_nama_template">Pilih Tipe SK</label>
                           <select name="id_nama_template" class="form-control">
                             <option value="">--Pilih--</option>
                              @foreach ($nama_template as $item)
                                <option value="{{ $item->id }}" {{ ($item->id == $template->id_nama_template? 'selected':'') }}>{{ $item->nama }}</option>
                              @endforeach
                           </select>

                           @error('id_nama_template')
                              <br>
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>

                        <br>
                        <textarea id="editor1" name="isi" rows="20" cols="80">{{ $template->isi }}</textarea>

                        @error('isi')
                           <br>
                           <span class="invalid-feedback" role="alert" style="color: red;">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
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
         height: '500px',
         tabSpaces: 4
       })
   </script>
@endsection

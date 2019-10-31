@extends('akademik.akademik_view')

@section('page_title')
	Detail Surat Tugas Pembimbing
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">

	</style>	
@endsection

@section('judul_header')
	Surat Tugas Pembimbing
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
              <h3 class="box-title">Detail Surat Tugas Pembimbing</h3>
            </div>

            <div class="box-body">
         		<div id="kop_surat">
                  <div id="logo">
                     
                  </div>

                  <div id="keterangan_kop">
                     
                  </div>
               </div>

               <div id="body_surat">
                  
               </div>
            </div>

            <div class="box-footer">
               @if ($surat_tugas->verif_ktu != 1)
                  <form action="#" method="post">
                     @csrf
                     @method('put')
                     <input type="hidden" name="verif_ktu" value="{{$surat_tugas->verif_ktu}}">
                     <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button> &ensp;
                     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik SK</button>
                  </form>
               @endif
            </div>
            
   		</div>
   	</div>
	</div>

   <div class="modal fade" id="modal-tarik-sk">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-red">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pesan Penarikan Surat Tugas</h4>
          </div>
          <form method="post" action="#">
            @csrf
            @method('PUT')
             <div class="modal-body">
               <label for="pesan_revisi">Masukkan Pesan Revisi</label>
               <textarea name="pesan_revisi" id="pesan_revisi" class="form-control">{{old('pesan_revisi')}}</textarea>
               <input type="hidden" name="verif_ktu" value="{{$surat_tugas->verif_ktu}}">
               @error('pesan_revisi')
                  <p style="color: red;">{{ $message }}</p>
               @enderror
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>           
            <button type="submit" name="tarik_btn" class="btn btn-danger">Tarik</button>
             </div>
           </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
@endsection

@section('script')

@endsection
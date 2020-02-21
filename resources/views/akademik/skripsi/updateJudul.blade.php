@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Update Judul Skripsi
@endsection

@section('css_link')
	<link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
	<style type="text/css">
		form{
			width: 90%;
			margin: auto;
		}

		#nim, #nama_mhs{
			/*width: 80%;*/
		}

		#no_surat{
			width: 25%;
		}

		#format_nomor{
			font-size: 16px;
		}

		#btn_group{
			float: right;
			margin-right: 20px;
		}
	</style>
@endsection

@section('judul_header')
	Update Judul Skripsi
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Update Judul Skripsi</h3>
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

            <form action="{{ route('akademik.data-skripsi.update-judul.update', $detail_skripsi->id) }}" method="post">
               <div class="box-body">
            		@csrf
                  @method('PUT')

                  <div class="row">
                     <div class="col-lg-6">
                        <div class="form-group">
                        <input type="hidden" name="id_skripsi" value="{{$skripsi->id}}">
                           <label for="nim">NIM Mahasiswa</label><br>
                           <p id="nim" name="nim">{{ $skripsi->nim }}</p>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="form-group">
                           <label for="nama_mhs">Nama Mahasiswa</label>
                           <p id="nama_mhs">{{ $skripsi->mahasiswa->nama }}</p>
                        </div>
                     </div>
                  </div>

                  <div class="form-group">
                     <label for="judul">Judul Skripsi</label>
                     <textarea name="judul" id="judul" class="form-control" rows="3">{{ $detail_skripsi->judul }}</textarea>

                     @error('judul')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <label for="judul_inggris">Judul Bahasa Inggris Skripsi</label>
                     <textarea name="judul_inggris" id="judul_inggris" class="form-control" rows="3">{{ $detail_skripsi->judul_inggris }}</textarea>

                     @error('judul_inggris')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>

               <div class="box-footer">
                  <a href="{{ route('akademik.data-skripsi.index') }}" class="btn btn-default">Batal</a> &ensp;

                  <div id="btn_group">
                     {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                     <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                  </div>
               </div>
            </form>

   		</div>
   	</div>
	</div>
@endsection

@section('script')

@endsection

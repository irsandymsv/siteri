@extends('layouts.template')

@section('side_menu')
   @include('include.kemahasiswaan_menu')
@endsection

@section('page_title')
   Ubah Data Mahasiswa
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
@endsection

@section('judul_header')
   Ubah Data Mahasiswa
@endsection

@section('content')
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Ubah Data Mahasiswa</h3>
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
            <form action="{{ route('kemahasiswaan.mahasiswa.update', $mahasiswa->nim) }}" method="post">
            <div class="box-body">

                  @csrf
                  @method('PUT')
                  <div class="form-group">
                     <label for="nim">NIM</label>
                     <input type="text" name="nim" id="nim" class="form-control" value="{{ $mahasiswa->nim }}">

                     @error('nim')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <label for="nama">Nama</label>
                     <input type="text" name="nama" id="nama" class="form-control" value="{{ $mahasiswa->nama }}">

                     @error('nama')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="form-group">
                     <label for="id_prodi">Program Studi</label>
                     <select name="id_prodi" id="id_prodi" class="form-control">
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($prodi as $item)
                           <option value="{{ $item->id }}" {{ ($item->id == $mahasiswa->id_prodi? 'selected':'') }}>{{ $item->nama }}</option>
                        @endforeach
                     </select>

                     @error('id_prodi')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>

            </div>

            <div class="box-footer">
               <a href="{{ route('kemahasiswaan.mahasiswa.show', $mahasiswa->nim) }}" class="btn btn-default">Kembali</a>
               <button class="btn btn-success" type="submit">Simpan</button>
            </div>
            </form>
         </div>
      </div>
   </div>
@endsection

@section('script')
@endsection

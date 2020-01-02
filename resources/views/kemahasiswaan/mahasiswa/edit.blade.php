@extends('layouts.template')

@section('side_menu')
   @include('include.kemahasiswaan_menu')
@endsection

@section('page_title')
   Ubah Data Mahasiswa
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="/css/custom_style.css">
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
            </div>

            <div class="box-body">
               <form action="{{ route('kemahasiswaan.mahasiswa.update', $mahasiswa->nim) }}" method="post">
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
                     <label for="id_bagian">Program Studi</label>
                     <select name="id_bagian" id="id_bagian" class="form-control">
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($bagian as $item)
                           <option value="{{ $item->id }}" {{ ($item->id == $mahasiswa->id_bagian? 'selected':'') }}>{{ $item->bagian }}</option>
                        @endforeach
                     </select>

                     @error('id_bagian')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </form>
            </div>

            <div class="box-footer">
               <a href="{{ route('kemahasiswaan.mahasiswa.show', $mahasiswa->nim) }}" class="btn btn-default">Kembali</a>
               <button class="btn btn-success" type="submit">Simpan</button>
            </div>
         </div>
      </div>
   </div>
@endsection

@section('script')
@endsection
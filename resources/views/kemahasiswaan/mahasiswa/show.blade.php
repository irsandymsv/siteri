@extends('layouts.template')

@section('side_menu')
   @include('include.kemahasiswaan_menu')
@endsection

@section('page_title')
   Data Mahasiswa
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
@endsection

@section('judul_header')
   Data Mahasiswa
@endsection

@section('content')     
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-success">
            <div class="box-header">
               <h3 class="box-title">Detail Data Mahasiswa</h3>
            </div>

            <div class="box-body">
               <table class="table table-stripe table-bordered">
                  <tr>
                     <td>NIM</td>
                     <td>{{ $mahasiswa->nim }}</td>
                  </tr>
                  <tr>
                     <td>Nama</td>
                     <td>{{ $mahasiswa->nama }}</td>
                  </tr>
                  <tr>
                     <td>Program Studi</td>
                     <td>{{ $mahasiswa->prodi->nama }}</td>
                  </tr>
               </table>
            </div>

            <div class="box-footer">
               <a href="{{ route('kemahasiswaan.mahasiswa.index') }}" class="btn btn-default">Kembali</a>
               <a href="{{ route('kemahasiswaan.mahasiswa.edit', $mahasiswa->nim) }}" class="btn btn-warning">Ubah</a>
            </div>
         </div>
      </div>
   </div>
@endsection

@section('script')
@endsection
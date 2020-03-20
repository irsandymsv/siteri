@extends('layouts.template')

@section('side_menu')
   @include('include.kemahasiswaan_menu')
@endsection

@section('page_title')
   Dashboard      
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
@endsection

@section('judul_header')
      Dashboard
@endsection

@section('content')
	<div class="row">
		<div class="col-md-4 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
		    <div class="inner">
		      <h3>{{ $jml_mhs }}</h3>

		    <p>Jumlah Mahasiswa</p>
		    </div>
		    <div class="icon">
		      <i class="ion ion-person-add"></i>
		    </div>
		    <a href="{{ route('kemahasiswaan.mahasiswa.create') }}" class="small-box-footer">Tambah Data Baru <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
	</div>
@endsection
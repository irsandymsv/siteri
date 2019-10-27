@extends('layouts.template')

@section('side_menu')
	<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard Perlengkapan</span></a></li>
	<li><a href="{{ route('perlengkapan.pengadaan.index') }}"><i class="fa fa-book"></i> <span>Laporan Pengadaan</span></a></li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Pengadaan</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{ route('perlengkapan.pengadaan.index') }}">Lihat Laporan</a></li>
	      <li><a href="{{ route('perlengkapan.pengadaan.create') }}">Tambah Baru</a></li>
	    </ul>
	</li>
@endsection

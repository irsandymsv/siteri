@extends('layouts.template')

@section('side_menu')
	<li class="active"><a href="{{route('akademik.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

	
	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>SK Skripsi</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{route('akademik.skripsi.create')}}">Buat Baru</a></li>
	      <li><a href="{{ route('akademik.skripsi.index') }}">Lihat Semua</a></li>
	    </ul>
	</li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>SK Pembahas Sempro</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{route('akademik.sempro.create')}}">Buat Baru</a></li>
	      <li><a href="{{ route('akademik.sempro.index') }}">Lihat Semua</a></li>
	    </ul>
    </li>
    
    <li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Manajemen Pengguna</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{route('admin.pegawai.create')}}">Buat Baru</a></li>
	      <li><a href="{{ route('admin.pegawai.index') }}">Lihat Semua</a></li>
	    </ul>
	</li>
@endsection
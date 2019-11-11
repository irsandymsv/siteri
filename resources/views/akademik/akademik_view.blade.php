@extends('layouts.template')

@section('side_menu')
	<li class="active"><a href="{{route('akademik.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

	<li><a href="{{route('akademik.data-skripsi.index')}}"><i class="fa fa-link"></i> <span>Data Skripsi</span></a></li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas Pembimbing</span>
	    	<br><span> Skripsi</span>
	      <span class="pull-right-container">
	         <i class="fa fa-angle-left pull-right"></i>
	      </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{route('akademik.sutgas-pembimbing.create')}}">Buat Baru</a></li>
	      <li><a href="{{ route('akademik.sutgas-pembimbing.index') }}">Lihat Semua</a></li>
	    </ul>
	</li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas Pembahas</span>
	    	<br><span> Sempro</span>
	      <span class="pull-right-container">
	         <i class="fa fa-angle-left pull-right"></i>
	      </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{route('akademik.sutgas-pembahas.create')}}">Buat Baru</a></li>
	      <li><a href="{{ route('akademik.sutgas-pembahas.index') }}">Lihat Semua</a></li>
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
	      <li><a href="{{ route('akademik.sempro.edit-penetapan-sk') }}">Ubah Halaman Penetapan</a></li>
	    </ul>
	</li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>SK Skripsi</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{route('akademik.skripsi.create')}}">Buat Baru</a></li>
	      <li><a href="{{ route('akademik.skripsi.index') }}">Lihat Semua</a></li>
	      <li><a href="{{ route('akademik.skripsi.edit-penetapan-sk') }}">Ubah Halaman Penetapan</a></li>
	    </ul>
	</li>
@endsection

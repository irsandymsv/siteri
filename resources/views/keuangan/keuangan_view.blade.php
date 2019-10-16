@extends('layout.template')

@section('side_menu')
	<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard Keuangan</span></a></li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Honor SK Dekan Skripsi</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{route('keuangan.honor-skripsi.pilih-sk')}}">SK Skripsi</a></li>
	      <li><a href="{{route('keuangan.honor-skripsi.index')}}">Lihat Semua</a></li>
	    </ul>
	</li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Honor SK Dekan Sempro</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="#">Buat Baru</a></li>
	      <li><a href="#">Lihat Semua</a></li>
	    </ul>
	</li>
@endsection
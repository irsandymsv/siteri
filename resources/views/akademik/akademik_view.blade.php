@extends('layout.template')

@section('side_menu')
	<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>SK Skripsi</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="#">Buat Baru</a></li>
	      <li><a href="#">Lihat Semua</a></li>
	    </ul>
	</li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>SK Sempro</span>
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
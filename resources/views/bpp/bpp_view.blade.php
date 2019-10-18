@extends('layout.template')

@section('side_menu')
	<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard BPP</span></a></li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Honor SK</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="#">Honor SK Dekan Skripsi</a></li>
	      <li><a href="#">Honor SK Dekan Sempro</a></li>
	    </ul>
	</li>
@endsection
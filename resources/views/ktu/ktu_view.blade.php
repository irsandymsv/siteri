@extends('layout.template')

@section('side_menu')
	<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>SK Akademik</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{ route('ktu.sk-skripsi.index') }}">SK Skripsi</a></li>
	      <li><a href="{{ route('ktu.sk-sempro.index') }}">SK Sempro</a></li>
	    </ul>
	</li>
@endsection
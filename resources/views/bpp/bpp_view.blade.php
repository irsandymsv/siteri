@extends('layouts.template')

@section('side_menu')
	<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard BPP</span></a></li>

	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	      <li><a href="{{ route('bpp.surat.index') }}">Lihat Surat Tugas</a></li>
	      <li><a href="{{ route('bpp.spd.index') }}">Lihat Bukti SPD</a></li>
	    </ul>
	</li>
@endsection
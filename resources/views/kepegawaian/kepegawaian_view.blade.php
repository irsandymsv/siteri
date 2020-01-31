@extends('layouts.template')

@section('side_menu')
	<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard Kepegawaian</span></a></li>

	@if(Auth::user()->id_jabatan == 12 )
	<li class="treeview">
	    <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas</span>
	      <span class="pull-right-container">
	          <i class="fa fa-angle-left pull-right"></i>
	        </span>
	    </a>
	    <ul class="treeview-menu">
	 
	      <li><a href="{{route('kepegawaian.surat.index')}}">Surat Tugas Belum Dibuat</a></li>
		  <li><a href="{{route('kepegawaian.surat.read')}}">Menunggu Verifikasi</a></li>
		  <li><a href="{{route('kepegawaian.surat.revisi')}}">Surat Tugas Perlu Revisi</a></li>
		  <li><a href="{{route('kepegawaian.surat.cetak')}}">Print Surat Tugas</a></li>
	    </ul>
	</li>
	@endif

@endsection
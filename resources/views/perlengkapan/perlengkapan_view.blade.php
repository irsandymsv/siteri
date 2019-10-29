@extends('layouts.template')

@section('side_menu')
<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard Perlengkapan</span></a></li>
<li><a href="{{ route('perlengkapan.inventaris.index') }}"><i class="fa fa-book"></i> <span>Laporan
            inventaris</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Inventaris</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('perlengkapan.inventaris.index') }}">Lihat Laporan</a></li>
        <li><a href="{{ route('perlengkapan.inventaris.create') }}">Tambah Baru</a></li>
    </ul>
</li>
@endsection

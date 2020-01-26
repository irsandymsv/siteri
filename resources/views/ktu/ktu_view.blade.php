@extends('layouts.template')

@section('side_menu')
<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>Dashboard KTU</span></a></li>

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

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Honor SK</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('ktu.honor-skripsi.index') }}">Honor SK Dekan Skripsi</a></li>
        <li><a href="{{ route('ktu.honor-sempro.index') }}">Honor SK Dekan Sempro</a></li>
    </ul>
</li>

<li>
    <a href="{{ route('ktu.peminjaman_barang.index') }}"><i class="fa fa-link"></i> <span>Peminjaman Barang</span></a>
</li>

<li>
    <a href="{{ route('ktu.peminjaman_ruang.index') }}"><i class="fa fa-link"></i> <span>Peminjaman Ruang</span></a>
</li>
@endsection

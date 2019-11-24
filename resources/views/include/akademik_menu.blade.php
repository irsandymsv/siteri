<li class="active"><a href="{{route('akademik.dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard Akademik</span></a></li>

<li><a href="{{route('akademik.data-skripsi.index')}}"><i class="fa fa-link"></i> <span>Data Skripsi</span></a></li>

<li class="header">Surat Tugas</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Pembimbing Skripsi</span>
      {{-- <br><span> Skripsi</span> --}}
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
    <a href="#"><i class="fa fa-link"></i> <span>Pembahas Sempro</span>
      {{-- <br><span> Sempro</span> --}}
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
    <a href="#"><i class="fa fa-link"></i> <span>Penguji Skripsi</span>
      {{-- <br><span> Skripsi</span> --}}
      <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('akademik.sutgas-penguji.create')}}">Buat Baru</a></li>
      <li><a href="{{ route('akademik.sutgas-penguji.index') }}">Lihat Semua</a></li>
    </ul>
</li>

<li class="header">SK</li>

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

<li class="header">Template Surat</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Template SK</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('akademik.template-sk.create')}}">Buat Baru</a></li>
      <li><a href="{{ route('akademik.template-sk.index') }}">Lihat Semua</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Data Nama Template</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('template.create')}}">Buat Baru</a></li>
      <li><a href="{{ route('template.index') }}">Lihat Semua</a></li>
    </ul>
</li>
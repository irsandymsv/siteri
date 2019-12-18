<li class="active"><a href="{{ route('keuangan.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard Keuangan</span></a></li>

<li><a href="{{ route('keuangan.honor-sempro.index') }}"><i class="fa fa-link"></i> <span>Honor SK Sempro</span></a></li>

{{-- <li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Honor SK Sempro</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('keuangan.honor-sempro.pilih-sk') }}">SK Sempro</a></li>
      <li><a href="{{ route('keuangan.honor-sempro.index') }}">Lihat Semua</a></li>
    </ul>
</li> --}}

<li><a href="{{ route('keuangan.honor-skripsi.index') }}"><i class="fa fa-link"></i> <span>Honor SK Skripsi</span></a></li>

{{-- <li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Honor SK Skripsi</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{route('keuangan.honor-skripsi.pilih-sk')}}">SK Skripsi</a></li>
      <li><a href="{{route('keuangan.honor-skripsi.index')}}">Lihat Semua</a></li>
    </ul>
</li> --}}

<li class="treeview">
   <a href="#"><i class="fa fa-link"></i> <span>Nama Honor</span>
      <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
      </span>
   </a>
   <ul class="treeview-menu">
      <li><a href="{{ route('honor.create') }}">Buat Baru</a></li>
      <li><a href="{{ route('honor.index') }}">Lihat Semua</a></li>
   </ul>
</li>
<li class="active"><a href="{{ route('ktu.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard KTU</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas Akademik</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('ktu.sutgas-pembimbing.index') }}">Pembimbing Skripsi</a></li>
      <li><a href="{{ route('ktu.sutgas-pembahas.index') }}">Pembahas Sempro</a></li>
      <li><a href="{{ route('ktu.sutgas-penguji.index') }}">penguji Skripsi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>SK Akademik</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('ktu.sk-sempro.index') }}">SK Sempro</a></li>
      <li><a href="{{ route('ktu.sk-skripsi.index') }}">SK Skripsi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Honor SK</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('ktu.honor-sempro.index') }}">Honor SK Sempro</a></li>
      <li><a href="{{ route('ktu.honor-skripsi.index') }}">Honor SK Skripsi</a></li>
    </ul>
</li>
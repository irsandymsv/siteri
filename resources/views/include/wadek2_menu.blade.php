<li class="active"><a href="{{ route('wadek2.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard Wadek 2</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>SK Akademik</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('wadek2.sk-sempro.index') }}">SK Sempro</a></li>
        <li><a href="{{ route('wadek2.sk-skripsi.index') }}">SK Skripsi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Honor SK</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('wadek2.honor-sempro.index') }}">Honor SK Sempro</a></li>
        <li><a href="{{ route('wadek2.honor-skripsi.index') }}">Honor SK Skripsi</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Skripsi Mahasiswa</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('wadek2.pembimbing-skripsi') }}">Pembimbing Skripsi</a></li>
        <li><a href="{{ route('wadek2.pembahas-sempro') }}">Pembahas Sempro</a></li>
        <li><a href="{{ route('wadek2.penguji-skripsi') }}">Penguji Skripsi</a></li>
    </ul>
</li>

<li>
    <a href="{{ route('wadek2.pengadaan.index') }}"><i class="fa fa-link"></i> <span>Pengadaan</span></a>
</li>

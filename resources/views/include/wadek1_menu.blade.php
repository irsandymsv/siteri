<li><a href="{{ route('wadek1.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard Wadek 1</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Skripsi Mahasiswa</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('wadek1.pembimbing-skripsi') }}">Pembimbing Skripsi</a></li>
        <li><a href="{{ route('wadek1.pembahas-sempro') }}">Pembahas Sempro</a></li>
        <li><a href="{{ route('wadek1.penguji-skripsi') }}">Penguji Skripsi</a></li>
    </ul>
</li>

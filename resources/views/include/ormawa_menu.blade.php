<li><a href="{{ route('ormawa.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard
            Ormawa</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Peminjaman Barang</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('ormawa.peminjaman_barang.create') }}">Buat Baru</a></li>
        <li><a href="{{ route('ormawa.peminjaman_barang.index') }}">Lihat Laporan</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Peminjaman Ruang</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('ormawa.peminjaman_ruang.create') }}">Buat Baru</a></li>
        <li><a href="{{ route('ormawa.peminjaman_ruang.index') }}">Lihat Laporan</a></li>
    </ul>
</li>

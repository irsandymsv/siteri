<li><a href="{{ route('perlengkapan.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard
            Perlengkapan</span></a></li>

{{-- <li>
<a href="{{ route('perlengkapan.inventaris.index') }}">
<i class="fa fa-book"></i> <span>Laporan Inventaris</span>
</a>
</li> --}}

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Inventaris</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('perlengkapan.inventaris.create', [ 'laporan' => true]) }}">Buat Baru</a></li>
        <li><a href="{{ route('perlengkapan.inventaris.index') }}">Lihat Laporan</a></li>
    </ul>
</li>

{{-- <li>
<a href="{{ route('perlengkapan.pengadaan.index') }}">
<i class="fa fa-book"></i><span>Laporan Pengadaan</span>
</a>
</li> --}}

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Pengadaan</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('perlengkapan.pengadaan.create') }}">Buat Baru</a></li>
        <li><a href="{{ route('perlengkapan.pengadaan.index') }}">Lihat Laporan</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Peminjaman Barang</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('perlengkapan.peminjaman_barang.create') }}">Buat Baru</a></li>
        <li><a href="{{ route('perlengkapan.peminjaman_barang.index') }}">Lihat Laporan</a></li>
    </ul>
</li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Peminjaman Ruang</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{ route('perlengkapan.peminjaman_ruang.create') }}">Buat Baru</a></li>
        <li><a href="{{ route('perlengkapan.peminjaman_ruang.index') }}">Lihat Laporan</a></li>
    </ul>
</li>

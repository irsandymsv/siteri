<li><a href="{{ route('ktu.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard KTU</span></a>
</li>

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

<li>
    <a href="{{ route('ktu.memu.index') }}"><i class="fa fa-link"></i> <span>Lihat Memo</span></a>
</li>

{{-- <li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Memo</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('ktu.memu.index') }}">Lihat Memo</a></li>
    </ul>
</li> --}}

<li>
    <a href="{{ route('ktu.surat.index') }}"><i class="fa fa-link"></i> <span>Surat Tugas Kepegawaian</span></a>
</li>

{{-- <li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('ktu.surat.index') }}">Menunggu Verifikasi</a></li>
      <li><a href="{{ route('ktu.surat.read') }}">Lihat Semua</a></li>
    </ul>
</li> --}}

<li>
    <a href="{{ route('ktu.peminjaman_barang.index') }}"><i class="fa fa-link"></i> <span>Peminjaman Barang</span></a>
</li>

<li>
    <a href="{{ route('ktu.peminjaman_ruang.index') }}"><i class="fa fa-link"></i> <span>Peminjaman Ruang</span></a>
</li>

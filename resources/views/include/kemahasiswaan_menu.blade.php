<li class="active"><a href="{{ route('kemahasiswaan.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard Kemahasiswaan</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Data Mahasiswa</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('kemahasiswaan.mahasiswa.create') }}">Buat Baru</a></li>
      <li><a href="{{ route('kemahasiswaan.mahasiswa.index') }}">Lihat Semua</a></li>
    </ul>
</li>
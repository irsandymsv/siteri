<li><a href="{{ route('dosen.dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard Dosen</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Skripsi Mahasiswa</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('dosen.pembimbing-skripsi') }}">Pembimbing Skripsi</a></li>
      <li><a href="{{ route('dosen.pembahas-sempro') }}">Pembahas Sempro</a></li>
      <li><a href="{{ route('dosen.penguji-skripsi') }}">Penguji Skripsi</a></li>
    </ul>
</li>


<li class="treeview">
  <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas</span>
    <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="{{ route('dosen.surat.index') }}">Lihat Surat Tugas</a></li>
    <li><a href="{{ route('dosen.dosen_upload_index') }}">Upload bukti</a></li>
  </ul>
</li>

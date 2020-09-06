<li><a href="<?php echo e(route('kepegawaian.dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard Kepegawaian</span></a></li>

<li><a href="<?php echo e(route('kepegawaian.surat.index')); ?>"><i class="fa fa-link"></i> <span>Daftar Surat tugas</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-link"></i> <span>Manajemen Pengguna</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="<?php echo e(route('kepegawaian.pegawai.create')); ?>">Buat Baru</a></li>
      <li><a href="<?php echo e(route('kepegawaian.pegawai.index')); ?>">Lihat Semua</a></li>
    </ul>
</li>
	

<?php /**PATH C:\xampp\htdocs\siteri\resources\views/include/kepegawaian_menu.blade.php ENDPATH**/ ?>
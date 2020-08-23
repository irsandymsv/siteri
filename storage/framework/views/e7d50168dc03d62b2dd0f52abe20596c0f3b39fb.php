<li><a href="<?php echo e(route('bpp.dashboard')); ?>"><i class="fa fa-dashboard"></i> <span>Dashboard BPP</span></a></li>

<li><a href="<?php echo e(route('bpp.honor-sempro.index')); ?>"><i class="fa fa-link"></i> <span>Honor SK Sempro</span></a></li>

<li><a href="<?php echo e(route('bpp.honor-skripsi.index')); ?>"><i class="fa fa-link"></i> <span>Honor SK Skripsi</span></a></li>

<li class="treeview">
   <a href="#"><i class="fa fa-link"></i> <span>Nama Honor</span>
      <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
      </span>
   </a>
   <ul class="treeview-menu">
      <li><a href="<?php echo e(route('honor.create')); ?>">Buat Baru</a></li>
      <li><a href="<?php echo e(route('honor.index')); ?>">Lihat Semua</a></li>
   </ul>
</li>

<li class="treeview">
   <a href="#"><i class="fa fa-link"></i> <span>Surat Tugas</span>
     <span class="pull-right-container">
         <i class="fa fa-angle-left pull-right"></i>
       </span>
   </a>
   <ul class="treeview-menu">
     <li><a href="<?php echo e(route('bpp.surat.index')); ?>">Lihat Surat Tugas</a></li>
     <li><a href="<?php echo e(route('bpp.spd.index')); ?>">Lihat Bukti SPD</a></li>
   </ul>
</li>
<?php /**PATH C:\xampp\htdocs\siteri\resources\views/include/bpp_menu.blade.php ENDPATH**/ ?>
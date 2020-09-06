<?php $__env->startSection('side_menu'); ?>
<?php echo $__env->make('include.ktu_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
   <div class="col col-xs-12">
      <div class="box box-primary">
         <div class="box-header with-border">
             <h3 class="box-title">Surat Tugas yang Butuh Verifikasi</h3>

         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <table id="table_data1" class="table table-bordered">
               <thead>
                  <tr>
                     <th style="width: 10px">#</th>
                     <th>No Surat</th>
                     <th>Tipe Surat</th>
                     <th>Tanggal Dibuat</th>
                     <th>Opsi</th>
                  </tr>
               </thead>

               <tbody>
                  <?php $__currentLoopData = $sutgas_dikirim; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                     <td><?php echo e($loop->index+1); ?></td>
                     <td><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                     </td>
                     <td><?php echo e($item->tipe_surat_tugas->tipe_surat); ?></td>
                     <td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                     </td>
                     <?php if($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing"): ?>
                      	<td>
                          	<a href="<?php echo e(route('ktu.sutgas-pembimbing.show', $item->id)); ?>" title="Lihat Detail"
                              class="btn btn-primary"><i class="fa fa-eye"></i></a>
                      	</td>
                     <?php elseif($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembahas"): ?>
                      	<td>
                          	<a href="<?php echo e(route('ktu.sutgas-pembahas.show', $item->id)); ?>" title="Lihat Detail"
                              class="btn btn-primary"><i class="fa fa-eye"></i></a>
                      	</td>
                     <?php else: ?>
                      	<td>
                          	<a href="<?php echo e(route('ktu.sutgas-penguji.show', $item->id)); ?>" title="Lihat Detail"
                              class="btn btn-primary"><i class="fa fa-eye"></i></a>
                      	</td>
                     <?php endif; ?>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </tbody>
            </table>
         </div>
         <!-- /.box-body -->
      </div>
   </div>
</div>

<div class="row">
   <div class="col col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">SK Sempro yang Butuh Verifikasi</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No Surat</th>
                        <th>Tanggal Dibuat</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        <?php if($sk_sempro_dikirim->isEmpty()): ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        <?php else: ?>
                        <?php $__currentLoopData = $sk_sempro_dikirim; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index+1); ?></td>
                            <td><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('ktu.sk-sempro.show', $item->no_surat)); ?>" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
   </div>

   <div class="col col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">SK Skripsi yang Butuh Verifikasi</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No SK Pembimbing</th>
                        <th>No SK Penguji</th>
                        <th>Tanggal Dibuat</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        <?php if($sk_skripsi_dikirim->isEmpty()): ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        <?php else: ?>
                        <?php $__currentLoopData = $sk_skripsi_dikirim; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index+1); ?></td>
                            <td><?php echo e($item->no_surat_pembimbing); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e($item->no_surat_penguji); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('ktu.sk-skripsi.show', $item->id)); ?>" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
   </div>
</div>

<div class="row">
   <div class="col col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Honor SK Sempro Terbaru</h3>

                <div class="box-tools">
                    <a href="<?php echo e(route('ktu.honor-sempro.index')); ?>" class="btn btn-default"
                        title="Lihat Semua SK Sempro">Lihat Semua</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No SK Sempro</th>
                        <th>Tanggal Dibuat</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        <?php if($sk_honor_sempro->isEmpty()): ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        <?php else: ?>
                        <?php $__currentLoopData = $sk_honor_sempro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index+1); ?></td>
                            <td><?php echo e($item->sk_sempro->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e(Carbon\Carbon::parse($item->sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('ktu.honor-sempro.show', $item->id)); ?>" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
   </div>

   <div class="col col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Honor SK Skripsi Terbaru</h3>

                <div class="box-tools">
                    <a href="<?php echo e(route('ktu.honor-skripsi.index')); ?>" class="btn btn-default"
                        title="Lihat Semua SK Skripsi">Lihat Semua</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No SK Pembimbing</th>
                        <th>No SK Penguji</th>
                        <th>Tanggal Dibuat</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        <?php if($sk_honor_skripsi->isEmpty()): ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        <?php else: ?>
                        <?php $__currentLoopData = $sk_honor_skripsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index+1); ?></td>
                            <td><?php echo e($item->sk_skripsi->no_surat_pembimbing); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e($item->sk_skripsi->no_surat_penguji); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e(Carbon\Carbon::parse($item->sk_skripsi->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('ktu.honor-skripsi.show', $item->id)); ?>" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
   </div>
</div>

<div class="row">
    <div class="col col-md-6">
         <div class="box box-warning">
             <div class="box-header with-border">
                 <h3 class="box-title">Peminjaman Barang Butuh Verifikasi</h3>

                 <div class="box-tools">
                     <a href="<?php echo e(route('ktu.peminjaman_barang.index')); ?>" class="btn btn-default"
                         title="Lihat Semua Peminjaman Barang">Lihat Semua</a>
                 </div>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
                 <table class="table table-bordered">
                     <tr>
                         <th style="width: 10px">#</th>
                         <th>Tanggal Mulai</th>
                         <th>Tanggal Berakhir</th>
                         <th>Kegiatan</th>
                         <th>Opsi</th>
                     </tr>

                     <tbody>
                         <?php if($pinjam_barang->isEmpty()): ?>
                         <tr>
                             <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                         </tr>
                         <?php else: ?>
                         <?php $__currentLoopData = $pinjam_barang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <tr>
                             <td><?php echo e($loop->index+1); ?></td>
                             <td><?php echo e(Carbon\Carbon::parse($item->tanggal_mulai)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                             </td>
                             <td><?php echo e(Carbon\Carbon::parse($item->tanggal_berakhir)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                             </td>
                             <td><?php echo e($item->kegiatan); ?></td>
                             <td>
                                 <a href="<?php echo e(route('ktu.peminjaman_barang.show', $item->id)); ?>" title="Lihat Detail"
                                     class="btn btn-primary"><i class="fa fa-eye"></i></a>
                             </td>
                         </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                     </tbody>
                 </table>
             </div>
             <!-- /.box-body -->
         </div>
    </div>

    <div class="col col-md-6">
         <div class="box box-success">
             <div class="box-header with-border">
                 <h3 class="box-title">Peminjaman Ruang Butuh Verifikasi</h3>

                 <div class="box-tools">
                     <a href="<?php echo e(route('ktu.peminjaman_ruang.index')); ?>" class="btn btn-default"
                         title="Lihat Semua Peminjaman ruang">Lihat Semua</a>
                 </div>
             </div>
             <!-- /.box-header -->
             <div class="box-body">
                 <table class="table table-bordered">
                     <tr>
                         <th style="width: 10px">#</th>
                         <th>Tanggal Mulai</th>
                         <th>Tanggal Berakhir</th>
                         <th>Kegiatan</th>
                         <th>Opsi</th>
                     </tr>

                     <tbody>
                         <?php if($pinjam_ruang->isEmpty()): ?>
                         <tr>
                             <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                         </tr>
                         <?php else: ?>
                         <?php $__currentLoopData = $pinjam_ruang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <tr>
                             <td><?php echo e($loop->index+1); ?></td>
                             <td><?php echo e(Carbon\Carbon::parse($item->tanggal_mulai)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                             </td>
                             <td><?php echo e(Carbon\Carbon::parse($item->tanggal_berakhir)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                             </td>
                             <td><?php echo e($item->kegiatan); ?></td>
                             <td>
                                 <a href="<?php echo e(route('ktu.peminjaman_ruang.show', $item->id)); ?>" title="Lihat Detail"
                                     class="btn btn-primary"><i class="fa fa-eye"></i></a>
                             </td>
                         </tr>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                     </tbody>
                 </table>
             </div>
             <!-- /.box-body -->
         </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/ktu/dashboard.blade.php ENDPATH**/ ?>
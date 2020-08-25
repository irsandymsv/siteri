<?php $__env->startSection('side_menu'); ?>
<?php echo $__env->make('include.wadek2_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

    <div class="col col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Pengadaan Butuh Verifikasi</h3>

                <div class="box-tools">
                    <a href="<?php echo e(route('wadek2.pengadaan.index')); ?>" class="btn btn-default"
                        title="Lihat Laporan Pengadaan">Lihat Semua</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Keterangan</th>
                        <th>Total Biaya</th>
                        <th>Dibuat</th>
                        <th>Diubah</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        <?php if($pengadaan->isEmpty()): ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        <?php else: ?>
                        <?php $__currentLoopData = $pengadaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index+1); ?></td>
                            <td><?php echo e($item->keterangan); ?></td>
                            <td><?php echo e($total[$loop->index]); ?></td>
                            <td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y - HH:mm')); ?>

                            </td>
                            <td><?php echo e(Carbon\Carbon::parse($item->updated_at)->locale('id_ID')->isoFormat('D MMMM Y - HH:mm')); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('wadek2.pengadaan.show', $item->id)); ?>" title="Lihat Detail"
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
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">SK Sempro Terbaru</h3>

                <div class="box-tools">
                    <a href="<?php echo e(route('wadek2.sk-sempro.index')); ?>" class="btn btn-default">Lihat Semua</a>
                </div>
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
                        <?php if($sk_sempro->isEmpty()): ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        <?php else: ?>
                        <?php $__currentLoopData = $sk_sempro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index+1); ?></td>
                            <td><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('wadek2.sk-sempro.show', $item->no_surat)); ?>" title="Lihat Detail"
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
                <h3 class="box-title">SK Skripsi Terbaru</h3>

                <div class="box-tools">
                    <a href="<?php echo e(route('wadek2.sk-skripsi.index')); ?>" class="btn btn-default">Lihat Semua</a>
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
                        <?php if($sk_skripsi->isEmpty()): ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        <?php else: ?>
                        <?php $__currentLoopData = $sk_skripsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->index+1); ?></td>
                            <td><?php echo e($item->no_surat_pembimbing); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e($item->no_surat_penguji); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

                            </td>
                            <td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                            </td>
                            <td>
                                <a href="<?php echo e(route('wadek2.sk-skripsi.show', $item->id)); ?>" title="Lihat Detail"
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
                    <a href="<?php echo e(route('wadek2.honor-sempro.index')); ?>" class="btn btn-default"
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
                                <a href="<?php echo e(route('wadek2.honor-sempro.show', $item->id)); ?>" title="Lihat Detail"
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
                    <a href="<?php echo e(route('wadek2.honor-skripsi.index')); ?>" class="btn btn-default"
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
                            <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
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
                                <a href="<?php echo e(route('wadek2.honor-skripsi.show', $item->id)); ?>" title="Lihat Detail"
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/wadek2/dashboard.blade.php ENDPATH**/ ?>
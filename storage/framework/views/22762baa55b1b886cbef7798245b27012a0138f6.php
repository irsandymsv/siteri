<?php $__env->startSection('side_menu'); ?>
<?php echo $__env->make('include.wadek2_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title', 'Pengadaan'); ?>

<?php $__env->startSection('judul_header', 'Permohonan Pengadaan'); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Permohonan Pengadaan</h3>

            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table id="pengadaan" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Dibuat</th>
                                <th>Terakhir Diubah</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th style="width:99.8px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0 ?>
                            <?php $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="lap_<?php echo e($item->id); ?>">
                                <td><?php echo e($no+=1); ?></td>
                                <td>
                                    <?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                                </td>
                                <td>
                                    <?php echo e(Carbon\Carbon::parse($item->updated_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                                </td>
                                <td><?php echo e($item->keterangan); ?></td>
                                <td>
                                    <?php switch($item->verif_wadek2):
                                    case (1): ?>
                                    <label class="label bg-red">Ditolak</label>
                                    <?php break; ?>
                                    <?php case (2): ?>
                                    <label class="label bg-green">Disetujui</label>
                                    <?php break; ?>
                                    <?php default: ?>
                                    Belum Diverifikasi
                                    <?php endswitch; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('wadek2.pengadaan.show', $item->id)); ?>" class="btn btn-primary"
                                        title="Lihat Laporan"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    $(function(){
        $('#pengadaan').dataTable();
    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/wadek2/pengadaan/index.blade.php ENDPATH**/ ?>
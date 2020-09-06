<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($notif->type == 'App\Notifications\verifSutgasKtu'): ?>

<li>
    <a href="<?php echo e(route('notifikasi.read', $notif->id)); ?>" style="white-space: initial;">
        Surat Tugas
        <?php if($notif->data['tipe_sutgas'] == "Surat Tugas Pembimbing"): ?>
        Pembimbing
        <?php elseif($notif->data['tipe_sutgas'] == "Surat Tugas Pembahas"): ?>
        Pembahas
        <?php else: ?>
        Penguji
        <?php endif; ?>
        <?php echo e($notif->data['no_surat']); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($notif->data['created_at'])->year); ?>

        telah diverifikasi.<br>
        <small
            style="color: grey;"><?php echo e(Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans()); ?></small>
    </a>
</li>
<?php elseif($notif->type == 'App\Notifications\verifSKSemproKtu'): ?>
<li>
    <a href="<?php echo e(route('notifikasi.read', $notif->id)); ?>" style="white-space: initial;">
        SK Sempro
        <?php echo e($notif->data['no_surat']); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($notif->data['created_at'])->year); ?>

        telah diverifikasi.<br>
        <small
            style="color: grey;"><?php echo e(Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans()); ?></small>
    </a>
</li>
<?php elseif($notif->type == 'App\Notifications\verifSKSkripsiKtu'): ?>
<li>
    <a href="<?php echo e(route('notifikasi.read', $notif->id)); ?>" style="white-space: initial;">
        SK Pembimbing Skripsi
        <?php echo e($notif->data['no_surat_pembimbing']); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($notif->data['created_at'])->year); ?>

        dan SK Penguji Skripsi
        <?php echo e($notif->data['no_surat_penguji']); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($notif->data['created_at'])->year); ?>

        telah diverifikasi.<br>
        <small
            style="color: grey;"><?php echo e(Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans()); ?></small>
    </a>
</li>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('notifikasi.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/notifikasi/akademik.blade.php ENDPATH**/ ?>
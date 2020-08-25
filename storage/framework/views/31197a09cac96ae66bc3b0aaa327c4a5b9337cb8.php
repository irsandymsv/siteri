<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($notif->type == 'App\Notifications\verifPengadaan'): ?>
		<li>
		    <a href="<?php echo e(route('notifikasi.read', $notif->id)); ?>" style="white-space: initial;">
		        <i class="fa fa-exclamation-circle col-xs-2"></i>
		        <div class="col-xs-10">
		            Laporan Pengadaan <?php echo e(($notif->data['pesan']) ? $notif->data['pesan'] : 'Baru'); ?><br>
		            <b><?php echo e($notif->data['keterangan']); ?></b><br>
		            <small
		                style="color: grey;"><?php echo e(Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans()); ?></small>
		        </div>
		    </a>
		</li>
	<?php elseif($notif->type == 'App\Notifications\suratTugasKepegawaian'): ?>
		<li>
			<a href="<?php echo e(route('notifikasi.read', $notif->id)); ?>" style="white-space: initial;">
				<i class="fa fa-exclamation-circle col-xs-2"></i>
				<div class="col-xs-10">
					Surat Tugas Kepegawaian 
				<?php echo e($notif->data['nomor_surat']); ?>/UN25.1.15/KP/<?php echo e(\Carbon\Carbon::parse($notif->data['created_at'])->year); ?> 
				Butuh Verifikasi.
				
				<br>
				<small style="color: grey;"><?php echo e(Carbon\Carbon::parse($notif->created_at)->locale('id_ID')->DiffForHumans()); ?></small>
				</div>
			</a>
		</li>
	<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('notifikasi.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/notifikasi/wadek2.blade.php ENDPATH**/ ?>
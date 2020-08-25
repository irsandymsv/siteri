<?php $__env->startSection('content'); ?>

<?php $__currentLoopData = Auth::user()->unreadNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php if($notif->type == 'App\Notifications\suratTugasKepegawaian'): ?>
		<li>
			<a href="<?php echo e(route('notifikasi.read', $notif->id)); ?>" style="white-space: initial;">
				<i class="fa fa-exclamation-circle col-xs-2"></i>
				<div class="col-xs-10">
					Surat Tugas Kepegawaian 
					<?php echo e($notif->data['nomor_surat']); ?>/UN25.1.15/KP/<?php echo e(\Carbon\Carbon::parse($notif->data['created_at'])->year); ?> 
					Ditujukan kepada Anda.
					
					<br>
					<small style="color: grey;"><?php echo e(Carbon\Carbon::parse($notif->created_at)->locale('id_ID')->DiffForHumans()); ?></small>
				</div>
			</a>
		</li>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('notifikasi.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/notifikasi/dekan.blade.php ENDPATH**/ ?>
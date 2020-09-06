<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.keuangan_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
			   	<h3 class="box-title">SK Sempro Baru</h3>

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
				      	<?php if($sk_sempro_baru->isEmpty()): ?>
				      		<tr>
				      			<td colspan="4" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	<?php else: ?>
	   			      	<?php $__currentLoopData = $sk_sempro_baru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	   			      		<tr>
	   			      			<td><?php echo e($loop->index+1); ?></td>
	   			      			<td><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
	   			      			<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
	   			      			<td>
				      					<a href="<?php echo e(route('keuangan.honor-sempro.store', $item->no_surat)); ?>" title="Buat Daftar honor untuk SK ini" class="btn btn-success">Generate</a>
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
		<div class="col col-xs-12">
			<div class="box box-success">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">SK Skripsi Baru</h3>

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
				      	<?php if($sk_skripsi_baru->isEmpty()): ?>
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	<?php else: ?>
	   			      	<?php $__currentLoopData = $sk_skripsi_baru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	   			      		<tr>
	   			      			<td><?php echo e($loop->index+1); ?></td>
	   			      			<td><?php echo e($item->no_surat_pembimbing); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
	   			      			<td><?php echo e($item->no_surat_penguji); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
	   			      			<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
	   			      			<td>
				      					<a href="<?php echo e(route('keuangan.honor-skripsi.store', $item->id)); ?>" title="Buat Daftar honor untuk SK ini" class="btn btn-success">Generate</a>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/keuangan/dashboard.blade.php ENDPATH**/ ?>
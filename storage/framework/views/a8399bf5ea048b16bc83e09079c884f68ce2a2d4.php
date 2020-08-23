<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.bpp_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
	Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
	Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col col-md-6">
			<div class="box box-primary">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Honor SK Sempro Terbaru</h3>

			   	<div class="box-tools">
			   		<a href="<?php echo e(route('bpp.honor-sempro.index')); ?>" class="btn btn-default" title="Lihat Semua SK Sempro">Lihat Semua</a>
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
	   			      			<td><?php echo e($item->sk_sempro->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
	   			      			<td><?php echo e(Carbon\Carbon::parse($item->sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
	   			      			<td>
				      					<a href="<?php echo e(route('bpp.honor-sempro.show', $item->id)); ?>" title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
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
			   		<a href="<?php echo e(route('bpp.honor-skripsi.index')); ?>" class="btn btn-default" title="Lihat Semua SK Skripsi">Lihat Semua</a>
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
	   			      			<td><?php echo e($item->sk_skripsi->no_surat_pembimbing); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
	   			      			<td><?php echo e($item->sk_skripsi->no_surat_penguji); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
	   			      			<td><?php echo e(Carbon\Carbon::parse($item->sk_skripsi->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
	   			      			<td>
				      					<a href="<?php echo e(route('bpp.honor-skripsi.show', $item->id)); ?>" title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/bpp/dashboard.blade.php ENDPATH**/ ?>
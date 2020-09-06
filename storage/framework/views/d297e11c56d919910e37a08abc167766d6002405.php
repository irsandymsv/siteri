<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.akademik_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
	Dashboard Akademik
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
	Dashboard
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
		<div class="col col-md-6">
			<div class="box box-primary">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Surat Tugas Berstatus Draft</h3>

			   	<div class="box-tools">
				    	<div class="btn-group">
							<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expand="false">Buat Baru <i class="fa fa-caret-down"></i></button>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo e(route('akademik.sutgas-pembimbing.create')); ?>">Surat Tugas Pembimbing Skripsi</a>
								</li>
								<li>
									<a href="<?php echo e(route('akademik.sutgas-pembahas.create')); ?>">Surat Tugas Pembahas Sempro</a>
								</li>
								<li>
									<a href="<?php echo e(route('akademik.sutgas-penguji.create')); ?>">Surat Tugas Penguji Skripsi</a>
								</li>
							</ul>
						</div>
			   	</div>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>No Surat</th>
			        		<th>Tipe Surat</th>
			        		<th>Tanggal</th>
			        		
			      	</tr>

				      <tbody>
				      	<?php if($sutgas_draft->isEmpty()): ?>
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	<?php else: ?>
	   			      	<?php $__currentLoopData = $sutgas_draft; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	   			      		<tr>
	   			      			<td><?php echo e($loop->index+1); ?></td>
				      				<?php if($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing"): ?>
					      				<td>
					      					<a href="<?php echo e(route('akademik.sutgas-pembimbing.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
					      				</td>
					      			<?php elseif($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembahas"): ?>
					      				<td>
					      					<a href="<?php echo e(route('akademik.sutgas-pembahas.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
					      				</td>
					      			<?php else: ?>
					      				<td>
					      					<a href="<?php echo e(route('akademik.sutgas-penguji.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
					      				</td>
				      				<?php endif; ?>
	   			      			<td><?php echo e($item->tipe_surat_tugas->tipe_surat); ?></td>
	   			      			<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
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
			    	<h3 class="box-title">Surat Tugas Butuh Revisi</h3>
			  	</div>
			  	<!-- /.box-header -->
			  	<div class="box-body">
				   <table class="table table-bordered">
				      <tr>
				        <th style="width: 10px">#</th>
				        <th>No Surat</th>
				        <th>Tipe Surat</th>
				        <th>Tanggal</th>
				      </tr>

				      <tbody>
				      	<?php if($sutgas_revisi->isEmpty()): ?>
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	<?php else: ?>
	   			      	<?php $__currentLoopData = $sutgas_revisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	   			      		<tr>
	   			      			<td><?php echo e($loop->index+1); ?></td>
				      				<?php if($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing"): ?>
					      				<td>
					      					<a href="<?php echo e(route('akademik.sutgas-pembimbing.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
					      				</td>
					      			<?php elseif($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembahas"): ?>
					      				<td>
					      					<a href="<?php echo e(route('akademik.sutgas-pembahas.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
					      				</td>
					      			<?php else: ?>
					      				<td>
					      					<a href="<?php echo e(route('akademik.sutgas-penguji.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
					      				</td>
				      				<?php endif; ?>
	   			      			<td><?php echo e($item->tipe_surat_tugas->tipe_surat); ?></td>
	   			      			<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
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
			    <h3 class="box-title">SK Sempro Berstatus Draft</h3>

			    <div class="box-tools">
			    	<a href="<?php echo e(route('akademik.sempro.create')); ?>" class="btn btn-success" title="Buat SK Sempro Baru"><i class="fa fa-plus"></i> Buat Baru</a>
			    </div>
			  </div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    <table class="table table-bordered">
			      <tr>
			        <th style="width: 10px">#</th>
			        <th>No Surat</th>
			        <th>Tanggal</th>
			      </tr>

			      <tbody>
			      	<?php if($sk_sempro_draft->isEmpty()): ?>
			      		<tr><td colspan="4" style="text-align: center;">Tidak Ada Data</td></tr>
			      	<?php else: ?>
			      		<?php $__currentLoopData = $sk_sempro_draft; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				      		<tr>
				      			<td><?php echo e($loop->index+1); ?></td>
				      			<td><a href="<?php echo e(route('akademik.sempro.show', $item->no_surat)); ?>" title="Lihat Detail"><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a></td>
				      			<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
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
			    <h3 class="box-title">SK Sempro Butuh Revisi</h3>
			  </div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    <table class="table table-bordered">
			      <tr>
			        <th style="width: 10px">#</th>
			        <th>No Surat</th>
			        <th>Tanggal</th>
			      </tr>

			      <tbody>
			      	<?php if($sk_sempro_revisi->isEmpty()): ?>
			      		<tr><td colspan="4" style="text-align: center;">Tidak Ada Data</td></tr>
			      	<?php else: ?>
			      		<?php $__currentLoopData = $sk_sempro_revisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				      		<tr>
				      			<td><?php echo e($loop->index+1); ?></td>
				      			<td><a href="<?php echo e(route('akademik.sempro.show', $item->no_surat)); ?>" title="Lihat Detail"><?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a></td>
				      			<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
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
			    <h3 class="box-title">SK Skripsi Berstatus Draft</h3>

			    <div class="box-tools">
			    	<a href="<?php echo e(route('akademik.skripsi.create')); ?>" class="btn btn-success" title="Buat SK Skripsi Baru"><i class="fa fa-plus"></i> Buat Baru</a>
			    </div>
			  </div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    <table class="table table-bordered">
			      <tr>
			        <th style="width: 10px">#</th>
			        <th>No SK Pembimbing</th>
			        <th>No SK Penguji</th>
			        <th>Tanggal</th>
			      </tr>

			      <tbody>
			      	<?php if($sk_skripsi_draft->isEmpty()): ?>
			      		<tr><td colspan="4" style="text-align: center;">Tidak Ada Data</td></tr>
			      	<?php else: ?>
			      		<?php $__currentLoopData = $sk_skripsi_draft; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				      		<tr>
				      			<td><?php echo e($loop->index+1); ?></td>
				      			<td>
				      				<a href="<?php echo e(route('akademik.skripsi.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat_pembimbing); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
				      			</td>
				      			<td>
				      				<a href="<?php echo e(route('akademik.skripsi.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat_penguji); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
				      			</td>
				      			<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
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
			    <h3 class="box-title">SK Skripsi Butuh Revisi</h3>
			  </div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    <table class="table table-bordered">
			      <tr>
			        <th style="width: 10px">#</th>
			        <th>No Surat Pembimbing</th>
			        <th>No Surat Penguji</th>
			        <th>Tanggal</th>
			      </tr>

			      <tbody>
			      	<?php if($sk_skripsi_revisi->isEmpty()): ?>
			      		<tr><td colspan="4" style="text-align: center;">Tidak Ada Data</td></tr>
			      	<?php else: ?>
			      		<?php $__currentLoopData = $sk_skripsi_revisi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				      		<tr>
				      			<td><?php echo e($loop->index+1); ?></td>
				      			<td>
				      				<a href="<?php echo e(route('akademik.skripsi.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat_pembimbing); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
				      			</td>
				      			<td>
				      				<a href="<?php echo e(route('akademik.skripsi.show', $item->id)); ?>" title="Lihat Detail"><?php echo e($item->no_surat_penguji); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></a>
				      			</td>
				      			<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/akademik/dashboard.blade.php ENDPATH**/ ?>
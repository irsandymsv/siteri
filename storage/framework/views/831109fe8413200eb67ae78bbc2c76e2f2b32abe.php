<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.ktu_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
	<?php if($tipe == "surat tugas pembimbing"): ?>
		Surat Tugas Pembimbing Skripsi
	<?php elseif($tipe == "surat tugas pembahas"): ?>
		Surat Tugas Pembahas Sempro
	<?php elseif($tipe == "surat tugas penguji"): ?>
		Surat Tugas Penguji Skripsi
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
	<?php if($tipe == "surat tugas pembimbing"): ?>
		Surat Tugas Pembimbing Skripsi
	<?php elseif($tipe == "surat tugas pembahas"): ?>
		Surat Tugas Pembahas Sempro
	<?php elseif($tipe == "surat tugas penguji"): ?>
		Surat Tugas Penguji Skripsi
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-success">
   			<div class="box-header">
   				<h3 class="box-title">
              		<?php if($tipe == "surat tugas pembimbing"): ?>
							Daftar Surat Tugas Pembimbing Skripsi
						<?php elseif($tipe == "surat tugas pembahas"): ?>
							Daftar Surat Tugas Pembahas Sempro
						<?php elseif($tipe == "surat tugas penguji"): ?>
							Daftar Surat Tugas Penguji Skripsi
						<?php endif; ?>
           		</h3>
            	
              	<?php if(session()->has('verif_ktu')): ?>
              	<br><br>
              	<div class="alert alert-info alert-dismissible" style="margin: auto;">
               	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               	<h4><i class="icon fa fa-info"></i> Berhasil</h4>
	           		<?php echo e(session('verif_ktu')); ?>

	          	</div>
	          	<?php endif; ?> 

	          	<?php 
	          		Session::forget('verif_ktu'); 
	          	?>
            </div>

            <div class="box-body">
            	<div class="table-responsive">
            		<table id="table_data1" class="table table-bordered table-hovered">
	            		<thead>
		            		<tr>
		            			<th>No</th>
		            			<th>No Surat</th>
		            			<th>Status</th>
		            			<th>Nama Mahasiswa</th>
		            			<th>Verifikasi KTU</th>
		            			<th>Tanggal Dibuat</th>
		            			<th>Pilihan</th>
		            		</tr>
		            	</thead>
		            	<tbody>
		            		<?php $__currentLoopData = $surat_tugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		            			<tr>
		            				<td><?php echo e($loop->index + 1); ?></td>
		            				<td>
		            					<?php echo e($item->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?>

		            				</td>
		            				<td><?php echo e($item->status_surat_tugas->status); ?></td>
		            				<td>
		            					<?php echo e($item->detail_skripsi->skripsi->mahasiswa->nama); ?>

		            					
		            				</td>
		            				<td>
		            					<?php if($item->verif_ktu == null): ?>
		            						Belum Diverifikasi
		            					<?php elseif($item->verif_ktu == 2): ?>
		            						<label class="label bg-red">Butuh Revisi</label>
		            					<?php else: ?>
		            						<label class="label bg-green">Sudah Diverifikasi</label>
		            					<?php endif; ?>
		            				</td>
		            				<td><?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
		            				<td>
		            					<?php if($tipe == "surat tugas pembimbing"): ?>
		            						<a href="<?php echo e(route('ktu.sutgas-pembimbing.show', $item->id)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
		            					<?php elseif($tipe == "surat tugas pembahas"): ?>
		            						<a href="<?php echo e(route('ktu.sutgas-pembahas.show', $item->id)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
		            					<?php elseif($tipe == "surat tugas penguji"): ?>
		            						<a href="<?php echo e(route('ktu.sutgas-penguji.show', $item->id)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
		            					<?php endif; ?>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/ktu/sutgas_akademik/index.blade.php ENDPATH**/ ?>
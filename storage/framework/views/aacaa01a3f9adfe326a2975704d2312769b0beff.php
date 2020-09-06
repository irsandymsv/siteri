<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.ktu_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
	<?php if($tipe == "SK Skripsi"): ?>
		Daftar Semua SK skripsi
	<?php else: ?>
		Daftar Semua SK Sempro
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
	<?php if($tipe == "SK Skripsi"): ?>
		SK Skripsi
	<?php else: ?>
		SK Sempro
	<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<p style="color: red;"><?php echo e(session('error')); ?></p>

<?php
	Session::forget('error');
?>
	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-success">
      			<div class="box-header">
	              <h3 class="box-title">Daftar SK <?php echo e(($tipe == "SK Skripsi"? 'Skripsi' : 'Sempro')); ?></h3>

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
	            		<table id="tbl_data1" class="table table-bordered table-hovered">
		            		<thead>
			            		<tr>
			            			<th>No</th>
			            			<?php if($tipe == "SK Skripsi"): ?>
				            			<th>No Surat SK Pembimbing</th>
				            			<th>No Surat SK Penguji</th>
			            			<?php else: ?>
			            				<th>No Surat</th>
			            			<?php endif; ?>
			            			<th>Tanggal Dibuat</th>
			            			<th>Status</th>
			            			<th>Verifikasi KTU</th>
			            			
			            			<th>Aksi</th>
			            		</tr>
			            	</thead>
			            	<tbody>
			            		<?php $__currentLoopData = $sk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			            			<tr id="<?php echo e(($tipe == "SK Skripsi"? 'sk_'.$item->id:'sk_'.$item->no_surat)); ?>">
			            				<td><?php echo e($loop->index + 1); ?></td>
			            				<?php if($tipe == "SK Skripsi"): ?>
				            				<td><?php echo e($item->no_surat_pembimbing); ?>/UN 25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
				            				<td><?php echo e($item->no_surat_penguji); ?>/UN 25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
			            				<?php else: ?>
			            					<td><?php echo e($item->no_surat); ?>/UN 25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->created_at)->year); ?></td>
			            				<?php endif; ?>
			            				<td>
			            					<?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

			            				</td>
			            				<td><?php echo e($item->status_sk->status); ?></td>
			            				<td>
			            					<?php if($item->verif_ktu == 0): ?> 
			            						Belum Diverifikasi
			            					<?php elseif($item->verif_ktu == 2): ?> 
			            						<label class="label bg-red">Butuh Revisi</label>
			            					<?php else: ?>
			            						<label class="label bg-green">Sudah Diverifikasi</label>
			            					<?php endif; ?>
			            				</td>
			            				
			            				<td>
			            					<?php if($tipe == "SK Skripsi"): ?>
			            					<a href="<?php echo e(route('ktu.sk-skripsi.show', $item->id)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					<?php else: ?>
			            					<a href="<?php echo e(route('ktu.sk-sempro.show', $item->no_surat)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
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

	<div id="success_verif" class="pop_up_info">
        <h4><i class="icon fa fa-check"></i>  <span></span></h4>
   </div>

	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
		$(function() {
			$.fn.dataTable.moment('D MMMM Y', 'id');
			$('#tbl_data1').DataTable()

			$("a[name='verif_sk']").click(function(event) {
				event.preventDefault();
				var id_sk = $(this).attr('id');
				
				$('div.modal-footer').off().on('click', '#verifBtn', function(event) {
					$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});

					$.ajax({
						url: '',
						type: 'POST',
						// dataType: '',
						data: {_method: 'PUT'},
					})
					.done(function(hasil) {
						console.log("success");
						// $("tr#sk_"+id_sk).hide();
						$("#success_verif").show();
						$("#success_verif").find('span').html(hasil);
						$("#success_verif").fadeOut(1800);
					})
					.fail(function() {
						console.log("error");
					});
				});
			
			});
		})
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/ktu/SK_view/sk_index.blade.php ENDPATH**/ ?>
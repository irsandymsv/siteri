<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.akademik_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
            
              <div style="float: right;">
            	<a href="<?php echo e(($tipe == "SK Skripsi"? route('akademik.skripsi.create') : route('akademik.sempro.create'))); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Buat SK Baru</a>
              </div>
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
		            			
		            			<th>Pilihan</th>
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
		            						<a href="<?php echo e(route('akademik.skripsi.show', $item->id)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					<?php if($item->verif_ktu != 1): ?>
			            					<a href="<?php echo e(route('akademik.skripsi.edit', $item->id)); ?>" class="btn btn-warning" title="Ubah SK"><i class="fa fa-edit"></i></a>
			            					<?php endif; ?>
						              	<?php else: ?>
						              		<a href="<?php echo e(route('akademik.sempro.show', $item->no_surat)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
			            					<?php if($item->verif_ktu != 1): ?>
			            					<a href="<?php echo e(route('akademik.sempro.edit', $item->no_surat)); ?>" class="btn btn-warning" title="Ubah SK"><i class="fa fa-edit"></i></a>
			            					<?php endif; ?>
						              	<?php endif; ?>

						              	
										
											<?php if($item->verif_ktu == 1): ?>
	                    					<a href="<?php echo e(($tipe == "SK Skripsi"? route('akademik.skripsi.cetak', $item->id) : route('akademik.sempro.cetak', $item->no_surat))); ?>" id="<?php echo e($item->id); ?>" name="cetak_sk" class="btn btn-info" title="Cetak SK"><i class="fa fa-print"></i></a>
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

	<div id="success_delete" class="pop_up_info">
        <h4><i class="icon fa fa-check"></i>  <span></span></h4>
    </div>

	<div class="modal modal-danger fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi Penghapusan</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus data SK ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>           
			<button type="button" id="hapusBtn" data-dismiss="modal" class="btn btn-outline">Hapus SK</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<script type="text/javascript">
		$(function() {
			$.fn.dataTable.moment('D MMMM Y', 'id');
			$('#tbl_data1').DataTable()

			$("a[name='delete_sk']").click(function(event) {
				event.preventDefault();
				var id_sk = $(this).attr('id');

				<?php if($tipe == "SK Skripsi"): ?>
				var url_del = "<?php echo e(route('akademik.skripsi.destroy')); ?>" + '/' + id_sk;					
				<?php else: ?>
				var url_del = "<?php echo e(route('akademik.sempro.destroy')); ?>" + '/' + id_sk;
				<?php endif; ?>
				console.log(url_del);
				
				$('div.modal-footer').off().on('click', '#hapusBtn', function(event) {
					$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});

					$.ajax({
						url: url_del,
						type: 'POST',
						// dataType: '',
						data: {_method: 'DELETE'},
					})
					.done(function(hasil) {
						console.log("success");
						$("tr#sk_"+id_sk).hide();
						$("#success_delete").show();
						$("#success_delete").find('span').html(hasil);
						$("#success_delete").fadeOut(1800);
					})
					.fail(function() {
						console.log("error");
					});
				});
			
			});
		})
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/akademik/SK_view/index.blade.php ENDPATH**/ ?>
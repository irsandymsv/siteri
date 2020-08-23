<?php $__env->startSection('page_title'); ?>
	Bukti Perjalanan
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold;
      }
	</style>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
	Preview Surat Tugas 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Detail Surat Tugas</h3>
            </div>
            <?php if(session()->has('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success')); ?>

            </div>
            <?php endif; ?>
            <div class="box-body">
         		<div class="table-responsive">
                  <table class="table table-striped table-bordered">
              

                     <tr>
                        <td>No Surat</td>
                        <td><?php echo e($surat_tugas->nomor_surat); ?></td>
                     </tr>

                     <tr>
                        <td>Yang Bertugas</td>
                        <td>
                            <?php $__currentLoopData = $dosen_tugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bertugas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <p><?php echo e($bertugas->user['nama']); ?> - <?php echo e($bertugas->user['no_pegawai']); ?></p>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                     </tr>
                     <tr>
                        <td>Tanggal Bertugas</td>
                        <td><?php echo e(Carbon\Carbon::parse($surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?> - <?php echo e(Carbon\Carbon::parse($surat_tugas->end_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
                     </tr>
                     <tr>
                        <td>Keterangan</td>
                        <td><?php echo e($surat_tugas->keterangan); ?></td>
                     </tr>
                     <tr>
                        <td>Status</td>
                        <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($stts->id == $surat_tugas->status): ?>
                        <td><?php echo e($stts->status); ?></td>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       
                     </tr>
                  </table>    
               </div>

               <div class="table-responsive">
                <h3><b>Bukti Perjalanan</b></h3>
                <table class="table table-striped table-bordered">
                     <tr>
                        <td>Lampiran Bukti Perjalanan</td>
                        <td>
                           <?php for( $i=0;$i< count($bukti[0]->transportasi);$i++): ?>
                               <a href="<?php echo e(route('bpp.spd.download',[ 'id' => $bukti[0]->id, 'index' => $i, 'jenis_bukti' => 1 ])); ?>"><i class="fa fa-file"></i>   <?php echo e($bukti[0]->transportasi[$i][0]); ?></a><br>
                           <?php endfor; ?>
                          
                        </td>
                     </tr>
                     <tr>
                        <td>Lampiran Bukti Pendaftaran</td>
                        <td>
                           <?php for( $i=0;$i< count($bukti[0]->pendaftaran);$i++): ?>
                               <a href="<?php echo e(route('bpp.spd.download',[ 'id' => $bukti[0]->id, 'index' => $i, 'jenis_bukti' => 2 ])); ?>"><i class="fa fa-file"></i>   <?php echo e($bukti[0]->pendaftaran[$i][0]); ?></a><br>
                           <?php endfor; ?>
                          
                        </td>
                     </tr>
                     <tr>
                        <td>Lampiran Bukti Penginapan</td>
                        <td>
                           <?php for( $i=0;$i< count($bukti[0]->penginapan);$i++): ?>
                               <a href="<?php echo e(route('bpp.spd.download',[ 'id' => $bukti[0]->id, 'index' => $i, 'jenis_bukti' => 3 ])); ?>"><i class="fa fa-file"></i>   <?php echo e($bukti[0]->penginapan[$i][0]); ?></a><br>
                           <?php endfor; ?>
                          
                        </td>
                     </tr>
                </table>    
             </div>
            </div>

            <div  class="box-footer">
            <a href="<?php echo e(route('bpp.spd.index')); ?>" class="btn btn-default">Kembali</a>
            <?php if($surat_tugas->status == 10): ?>
            <a href="<?php echo e(route('bpp.spd.selesai', $surat_tugas->id)); ?>" class="btn btn-primary">Selesai</a>
            <?php endif; ?>
            </div>
            
   		</div>
   	</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('bpp.bpp_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/bpp/surat_tugas/preview_spd.blade.php ENDPATH**/ ?>
<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.wadek2_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
      Daftar Honorarium <?php echo e(($tipe == "SK Skripsi"? "Skripsi" : "Sempro")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
   <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
      Honorarium <?php echo e(($tipe == "SK Skripsi"? "Skripsi" : "Sempro")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>     
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-success">
            <div class="box-header">
               <h3 class="box-title">Daftar Honorarium <?php echo e(($tipe == "SK Skripsi"? "Skripsi" : "Sempro")); ?></h3>

               <?php if(session()->has('verif_wadek2')): ?>
                  <div class="alert alert-info alert-dismissible" style="width: 35%; margin: auto;">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h4><i class="icon fa fa-info"></i> Berhasil</h4>
                     <?php echo e(session('verif_wadek2')); ?>

                  </div>
               <?php endif; ?> 

               <?php
                  Session::forget('verif_wadek2'); 
               ?>
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  <table id="table_data1" class="table table-bordered table-hovered">
                     <thead>
                        <tr>
                           <th>No</th>
                           <?php if($tipe == "SK Skripsi"): ?>
                              <th>Nomor SK Pembimbing</th>
                              <th>Nomor SK Penguji</th>   
                           <?php else: ?>
                              <th>Nomor SK Sempro</th>                           
                           <?php endif; ?>
                           <th>Tanggal Dibuat</th>
                           
                           <th>Status Honorarium</th>
                           <th>Pilihan</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php $__currentLoopData = $sk_honor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr id="sk_<?php echo e($item->id); ?>">
                              <td><?php echo e($loop->index + 1); ?></td>
                              <?php if($tipe == "SK Skripsi"): ?>
                                 <td><?php echo e($item->sk_skripsi->no_surat_pembimbing); ?>/UN 25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->sk_skripsi->created_at)->year); ?></td>
                                 <td><?php echo e($item->sk_skripsi->no_surat_penguji); ?>/UN 25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->sk_skripsi->created_at)->year); ?></td>
                              <?php else: ?>
                                 <td><?php echo e($item->sk_sempro->no_surat); ?>/UN 25.1.15/SP/<?php echo e(Carbon\Carbon::parse($item->sk_sempro->created_at)->year); ?></td>
                              <?php endif; ?>
                              <td>
                                 <?php echo e(Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                              </td>
                              <td><?php echo e($item->status_sk_honor->status); ?></td>
                              
                              <td>
                                 <?php if($tipe == "SK Skripsi"): ?>
                                    <a href="<?php echo e(route('wadek2.honor-skripsi.show', $item->id)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                 <?php else: ?>
                                    <a href="<?php echo e(route('wadek2.honor-sempro.show', $item->id)); ?>" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
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
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/wadek2/honor_sk/honor_index.blade.php ENDPATH**/ ?>
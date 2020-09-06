<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.akademik_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
	Detail Surat Tugas Pembahas Sempro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
	<style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold;: 
      }
	</style>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
	Surat Tugas Pembahas Sempro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Detail Surat Tugas Pembahas Sempro</h3>
               
               <?php if($surat_tugas->verif_ktu == 2): ?>
                  <label class="label bg-red">Butuh Revisi</label>
               <?php endif; ?>

               <?php if($surat_tugas->verif_ktu == 1): ?>
                  <div style="float: right;">
                     <a href="<?php echo e(route("akademik.sutgas-pembahas.cetak", $surat_tugas->id)); ?>" class="btn bg-teal"><i class="fa fa-print"></i> Download PDF</a>
                  </div>
               <?php endif; ?>

               <h5><b>Progres</b> :</h5>
               <div class="tl_wrap">
                  <div class="item_tl" id="progres_1">
                     <div><i class="fa fa-check"></i></div>
                     <h4>Disimpan</h4>
                  </div>

                  <div class="item_tl" id="progres_2">
                     <div><i></i></div>
                     <h4>Dikirim</h4>
                  </div>

                  <div class="item_tl" id="progres_3">
                     <div><i></i></div>
                     <h4>Disetujui KTU</h4>
                  </div>
               </div>

               <?php if(!is_null($surat_tugas->pesan_revisi)): ?>
               <div class="revisi_wrap">
                  <h4><b>Pesan Revisi</b> : </h4>
                  <blockquote>
                     <p><?php echo e($surat_tugas->pesan_revisi); ?></p>
                  </blockquote>
               </div>
               <?php endif; ?>

               <?php if(session('success')): ?>
               <div class="alert alert-success alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h4><i class="icon fa fa-check"></i> Sukses</h4>
                   <?php echo e(session('success')); ?>

               </div>
               <?php
               Session::forget('success');
               ?>
               <?php endif; ?>
            </div>

            <div class="box-body">
         		<div class="table-responsive">
                  <table class="table table-striped table-bordered">
                     <tr>
                        <td>Tanggal Dibuat</td>   
                        <td><?php echo e(Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
                     </tr>

                     <tr>
                        <td>No Surat</td>
                        <td><?php echo e($surat_tugas->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($surat_tugas->created_at)->year); ?></td>
                     </tr>

                     <tr>
                        <td>Nama Mahasiswa</td>
                        <td><?php echo e($surat_tugas->detail_skripsi->skripsi->mahasiswa->nama); ?></td>
                     </tr>

                     <tr>
                        <td>NIM</td>
                        <td><?php echo e($surat_tugas->detail_skripsi->skripsi->nim); ?></td>
                     </tr>

                     <tr>
                        <td>Program Studi</td>
                        <td><?php echo e($surat_tugas->detail_skripsi->skripsi->mahasiswa->prodi->nama); ?></td>
                     </tr>

                     <tr>
                        <td>Judul</td>
                        <td>
                           <?php echo e($surat_tugas->detail_skripsi->judul); ?>

                        </td>
                     </tr>

                     <tr>
                        <td>Judul Inggris</td>
                        <td>
                           <?php echo e($surat_tugas->detail_skripsi->judul_inggris); ?>

                        </td>
                     </tr>

                     <tr>
                        <td>Pembimbing Utama</td>
                        <td>
                           <p><?php echo e($pembimbing['dosen1']->nama); ?></p>
                           <p><?php echo e($pembimbing['dosen1']->no_pegawai); ?></p>
                        </td>
                     </tr>

                     <tr>
                        <td>Pembimbing Pendamping</td>
                        <td>
                           <p><?php echo e($pembimbing['dosen2']->nama); ?></p>
                           <p><?php echo e($pembimbing['dosen2']->no_pegawai); ?></p>
                        </td>
                     </tr>

                     <tr>
                        <td>Pembahas I</td>
                        <td>
                           <p><?php echo e($surat_tugas->dosen1->nama); ?></p>
                           <p><?php echo e($surat_tugas->id_dosen1); ?></p>
                        </td>
                     </tr>

                     <tr>
                        <td>pembahas II</td>
                        <td>
                           <p><?php echo e($surat_tugas->dosen2->nama); ?></p>
                           <p><?php echo e($surat_tugas->id_dosen2); ?></p>
                        </td>
                     </tr>

                     <tr>
                        <td>Tanggal Sempro</td>
                        <td><?php echo e(Carbon\Carbon::parse($surat_tugas->tanggal)->locale("id_ID")->isoFormat('dddd, D MMMM Y')); ?></td>
                     </tr>

                     <tr>
                        <td>Jam pelaksanaan</td>
                        <td><?php echo e(Carbon\Carbon::parse($surat_tugas->tanggal)->format("H:i")); ?> WIB</td>
                     </tr>

                     <tr>
                        <td>Tempat Sempro</td>
                        <td>Ruang <?php echo e($surat_tugas->data_ruang->nama_ruang); ?></td>
                     </tr>

                     <tr>
                        <td>Status Surat</td>
                        <td><?php echo e($surat_tugas->status_surat_tugas->status); ?></td>
                     </tr>
                  </table>    
               </div>
            </div>

            <div class="box-footer">
               <a href="<?php echo e(route('akademik.sutgas-pembahas.index')); ?>" class="btn btn-default">Kembali</a>
               <a href="<?php echo e(route('akademik.sutgas-pembahas.edit', $surat_tugas->id)); ?>" class="btn btn-warning pull-right"><i class="fa fa-edit"></i> Ubah</a> &ensp;   
            </div>
            
   		</div>
   	</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
   <script type="text/javascript">
      var status = <?php echo json_encode($surat_tugas->id_status_surat_tugas, 15, 512) ?>;
      for (var i = status; i > 0; i--) {
         // $("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
         $("#progres_"+i).addClass('verified');
         $("#progres_"+i).find('i').addClass('fa fa-check');
      }
   </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/akademik/sutgas_pembahas/show.blade.php ENDPATH**/ ?>
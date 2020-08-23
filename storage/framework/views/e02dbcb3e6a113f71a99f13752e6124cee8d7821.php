<?php $__env->startSection('side_menu'); ?>
  

  <?php echo $__env->make('include.'.$jabatan_user.'_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
	Preview Surat Tugas
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
         font-weight: bold; 
      }
      .siteri {
         width: 100%;
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

        <div class="box-body">
       		<div class="table-responsive">
            <table class="table table-striped table-bordered">

              <tr>
                <td>No Surat</td>
                <td><?php echo e($spd->surat_tugas->nomor_surat); ?></td>
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
                <td><?php echo e(Carbon\Carbon::parse($spd->surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?> - <?php echo e(Carbon\Carbon::parse($spd->surat_tugas->end_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td><?php echo e($spd->surat_tugas->keterangan); ?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td><?php echo e($spd->surat_tugas->status_sk->status); ?></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="box-body" style="width: 90%; margin: auto;">
          <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                <ul>
            
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
                      <li><?php echo e($error); ?></li>
            
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
                </ul>
            </div>
          <?php endif; ?>
          
          <?php if(session('success')): ?>
            <div class="alert alert-success">
              <?php echo e(session('success')); ?>

            </div> 
          <?php endif; ?>

          <?php if($spd->surat_tugas->status_sk->id != 10): ?>
            <h4>Upload Bukti Transportasi</h4>
            <form method="post" action="<?php echo e(route($jabatan_user.'.file.upload', $spd->id_spd)); ?>" enctype="multipart/form-data">
              <?php echo e(csrf_field()); ?>

              <div class="form-group">
                <div class="input-group siteri increment">
            
                  <input type="file" name="transportasi[]" class="myfrm form-control">
                  <input type="hidden" name="transport" value="1">
            
                  <div class="input-group-btn"> 
            
                    <button class="btn btn-success"  id="transportasi" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            
                  </div>
            
                </div>
            
                <div class="clone hide" clone_name="transportasi">
            
                  <div class="siteri input-group" style="margin-top:10px">
            
                    <input type="file" name="transportasi[]" class="myfrm form-control">
            
                    <div class="input-group-btn"> 
            
                      <button class="btn btn-danger delete" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>
              </div>

              <br>
              <?php if($spd->biaya_penginapan != null): ?>
              <div class="form-group">
                <h4>Upload Bukti Penginapan</h4>
                <div class="input-group siteri increment" >
            
                  <input type="file" name="penginapan[]" class="myfrm form-control">
                  <input type="hidden" name="nginap" value="1">
            
                  <div class="input-group-btn"> 
            
                    <button class="btn btn-success" id="penginapan" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            
                  </div>
            
                </div>
            
                <div class="clone hide" clone_name="penginapan">
            
                  <div class="siteri input-group" style="margin-top:10px">
            
                    <input type="file" name="penginapan[]" class="myfrm form-control">
            
                    <div class="input-group-btn"> 
            
                      <button class="btn btn-danger delete" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif; ?>

              <br>
              <?php if($spd->biaya_pendaftaran_acara != null): ?>
              <div class="form-group">  
                <h4>Upload Bukti Pendaftaran</h4>
                <div class="input-group siteri increment" >
            
                  <input type="file" name="pendaftaran[]" class="myfrm form-control">
                  <input type="hidden" name="daftar" value="1">
            
                  <div class="input-group-btn"> 
            
                    <button class="btn btn-success" id="pendaftaran" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            
                  </div>
            
                </div>
            
                <div class="clone hide" clone_name="pendaftaran">
            
                  <div class="siteri input-group" style="margin-top:10px">
            
                    <input type="file" name="pendaftaran[]" class="myfrm form-control">
            
                    <div class="input-group-btn"> 
            
                      <button class="btn btn-danger delete" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div>
                <br> 
              <?php endif; ?>
              <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
              </div>
            </form>
          <?php endif; ?>   
        </div>

        <div  class="box-footer">
          <a href="<?php echo e(route($jabatan_user.'.dosen_upload_index')); ?>" class="btn btn-default pull-right">Kembali</a>
        </div>
            
   		</div>
   	</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

   <script type="text/javascript">
      $(document).ready(function() {
        $(".btn-success").click(function(){ 
          id = $(this).attr('id');
          // console.log(id);
          var lsthmtl = $("div[clone_name=" + id + "]").html();
          $(this).parents(".increment").after(lsthmtl);
        });
  
        $("body").on("click",".delete",function(){ 
            $(this).parents(".siteri").remove();
            console.log("test");
        });
      });
  
  </script>
  
  
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/dosen/surat_tugas/preview_upload.blade.php ENDPATH**/ ?>
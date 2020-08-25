<?php $__env->startSection('side_menu'); ?>
  <?php if(Auth::user()->jabatan->jabatan == "Dekan"): ?>
    <?php echo $__env->make('include.dekan_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 1"): ?>
    <?php echo $__env->make('include.wadek1_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 2"): ?>
    <?php echo $__env->make('include.wadek2_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php elseif(Auth::user()->jabatan->jabatan == "Dosen"): ?>
    <?php echo $__env->make('include.dosen_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title','Uplaod Bukti Perjalanan'); ?>
<?php $__env->startSection('judul_header','Upload Bukti Perjalanan'); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Belum Upload</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="table_data1" class="table table-bordered table-hover dataTable">
            <thead>
              <tr>
                <th>
                  <center>No</center>
                </th>
                <th>
                  <center>Jenis Surat</center>
                </th>
                <th>
                  <center>Nama yang Bertugas</center>
                </th>
                <th>
                  <center>Tanggal</center>
                </th>
                <th>
                  <center>Keterangan</center>
                </th>
                <th>
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>

            <tbody>
              <?php $__currentLoopData = $surat_tugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$sk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <tr role="row">
                <td><?php echo e($index+1); ?></td>
                <td>
                  <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($item->id == $sk->jenis_surat): ?>
                          <?php echo e($item->jenis); ?>

                      <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                <td>
                  <?php echo e(Auth::user()->nama); ?>

                </td>
                <td><?php echo e(\Carbon\Carbon::parse($sk->started_at)->format('d/m/Y')); ?> -
                  <?php echo e(\Carbon\Carbon::parse($sk->end_at)->format('d/m/Y')); ?></td>
                <td><?php echo e($sk->keterangan); ?></td>
                <td>
                  <a href="<?php echo e(route($jabatan_user.'.dosen_upload_preview', $sk->id_spd)); ?>" class="btn btn-primary btn-sm" style="margin-left: 17px;">Upload</a>
                </td>
              </tr>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Sudah Upload</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="table_data2" class="table table-bordered table-hover dataTable" >
            <thead>
              <tr>
                <th>
                  <center>No</center>
                </th>
                <th>
                  <center>Jenis Surat</center>
                </th>
                <th>
                  <center>Nama yang Bertugas</center>
                </th>
                <th>
                  <center>Tanggal</center>
                </th>
                <th>
                  <center>Keterangan</center>
                </th>
                <th>
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>

            <tbody>
              <?php $__currentLoopData = $surat_tugas2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$sk2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <tr role="row">
                <td><?php echo e($index+1); ?></td>
                <td>
                  <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($item->id == $sk2->jenis_surat): ?>
                          <?php echo e($item->jenis); ?>

                      <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                <td>
                  <?php echo e(Auth::user()->nama); ?>

                </td>
                <td><?php echo e(\Carbon\Carbon::parse($sk2->started_at)->format('d/m/Y')); ?> -
                  <?php echo e(\Carbon\Carbon::parse($sk2->end_at)->format('d/m/Y')); ?></td>
                <td><?php echo e($sk2->keterangan); ?></td>
                <td>
                  <a href="<?php echo e(route($jabatan_user.'.edit.upload', $sk2->id_spd)); ?>" class="btn btn-primary btn-sm" style="margin-left: 17px;">Lihat</a>
                </td>
              </tr>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $('#table_data2').DataTable();
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/dosen/surat_tugas/upload.blade.php ENDPATH**/ ?>
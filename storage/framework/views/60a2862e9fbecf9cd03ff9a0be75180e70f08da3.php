<?php $__env->startSection('page_title','Bukti SPD'); ?>
<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12"></div>
      </div>

      <form method="POST" action="">
        <?php echo csrf_field(); ?>
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Search</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputmaksud" class="col-sm-3 control-label">Surat Tugas</label>
                  <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="maksud" id="inputmaksud"
                      placeholder="Cari Surat Tugas">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              Cari
            </button>
          </div>
        </div>
      </form>

      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
              aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th width="5" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>No</center>
                  </th>
                  <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Jenis Surat</center>
                  </th>
                  <th width="25%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Nama yang Bertugas</center>
                  </th>
                  <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Tanggal</center>
                  </th>
                  <th width="30%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Keterangan</center>
                  </th>
                  <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Aksi</center>
                  </th>
                </tr>
                <?php $__currentLoopData = $surat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <tr role="row">
                  <td><?php echo e($index+1); ?></td>
                  <td>
                  <?php $__currentLoopData = $jenis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jeniss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($jeniss->id == $sk->jenis_surat): ?>
                      <?php echo e($jeniss->jenis); ?>

                      <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                </td>
                  <td>
                    <?php $__currentLoopData = $dosen_sk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dosen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($dosen->id_sk == $sk->id): ?>
                    <p><?php echo e($dosen->user['nama']); ?></p>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $pemateri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pematerii): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($pematerii['id_sk'] == $sk->id): ?>
                        <p><?php echo e($pematerii['nama']); ?></p>   
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </td>
                  <td><?php echo e(\Carbon\Carbon::parse($sk->started_at)->format('d/m/Y')); ?> -
                    <?php echo e(\Carbon\Carbon::parse($sk->end_at)->format('d/m/Y')); ?></td>
                  <td><?php echo e($sk->keterangan); ?></td>
                  <td>
                    <a href="<?php echo e(route('bpp.spd.view', $sk->id_spd)); ?>" class="btn btn-primary" style="margin-left: 17px;"><i class="fa fa-eye"></i> </a>
                  </td>
                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </thead>
              <tbody>
                </td>
                </tr>
                </td>
                </tr>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">

          <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

            </div>
          </div>
        </div>

      </div>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('bpp.bpp_view', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/bpp/surat_tugas/spd.blade.php ENDPATH**/ ?>
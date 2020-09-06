<?php $__env->startSection('side_menu'); ?>
  <?php echo $__env->make('include.kepegawaian_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title','Surat Tugas'); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Daftar Surat Tugas</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12 table-responsive">
          <table id="data_table" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
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
                  <center class="status_surat">Status</center>
                </th>
                <th>
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $memu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index =>$sk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr role="row">
                <td><?php echo e($index+1); ?></td>
                <td><?php echo e($sk->jenis_sk->jenis); ?></td>
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
                <td><?php echo e($sk->status_sk->status); ?></td>
                <td>
                  <?php if($sk->status == 2): ?>
                    <a href="<?php echo e(route('kepegawaian.surat.create', $sk->id)); ?>" class="btn btn-primary btn-sm" title="Buat Surat Tugas dari Memo Ini">Buat</a>
                  <?php elseif($sk->status > 2): ?>
                    <a href="<?php echo e(route('kepegawaian.surat.preview', $sk->id)); ?>" class="btn btn-success btn-sm" title="Lihat Detail Surat Tugas">Lihat</a>
                    <?php if($sk->status == 4 || $sk->status == 6): ?>
                      <a href="<?php echo e(route('kepegawaian.surat.edit', $sk->id)); ?>" style="margin-top: 5px;" class="btn bg-purple btn-sm" title="Ubah Surat Tugas">Perbaiki</a>
                    <?php endif; ?>
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
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
  <script type="text/javascript">
  $(function(){
    $(".status_surat").text(function () {
      $(this).text().replace('Memu', 'Memo');
    });
  });

  $(`<tr>
     <th></th>
     <th></th>
     <th></th>
     <th></th>
     <th></th>
     <th></th>
     <th></th>
  </tr>`).clone(true).appendTo( '#data_table thead' );

  $('#data_table').DataTable({
    order: [],
    orderCellsTop: true,
    initComplete: function () {
      this.api().columns([1,5]).every( function () {
        var column = this;
        var select = $('<select><option value="">- Semua -</option></select>')
          .appendTo( $("#data_table thead tr:eq(1) th").eq(column.index()).empty() )
          .on( 'change', function () {
            var val = $.fn.dataTable.util.escapeRegex(
              $(this).val()
            );

            column
              .search( val ? '^'+val+'$' : '', true, false )
              .draw();
          });

        column.data().unique().sort().each( function ( d, j ) {
          select.append( '<option value="'+d+'">'+d+'</option>' )
        });
      });
    }
  });
  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/kepegawaian/surat_tugas/index.blade.php ENDPATH**/ ?>
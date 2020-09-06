<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.keuangan_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
      Daftar Honorarium SK <?php echo e(($tipe == "SK Skripsi"? "Skripsi" : "Sempro")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
   <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
      Honorarium SK <?php echo e(($tipe == "SK Skripsi"? "Skripsi" : "Sempro")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>     
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-success">
            <div class="box-header">
               <h3 class="box-title">Daftar Honorarium SK <?php echo e(($tipe == "SK Skripsi"? "Skripsi" : "Sempro")); ?></h3>

               
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  <table id="data_table" class="table table-bordered table-hovered">
                     <thead>
                        <tr>
                           <th>No</th>
                           <?php if($tipe == "SK Skripsi"): ?>
                              <th>SK Pembimbing Skripsi</th>
                              <th>SK Penguji Skripsi</th>
                           <?php else: ?>
                              <th>SK Pembahas Sempro</th>
                           <?php endif; ?>
                           <th>Tanggal SK</th>
                           <th>Status</th>
                           
                           <th>Pilihan</th>
                        </tr>
                     </thead>

                     <tbody>
                        <?php $__currentLoopData = $sk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <tr id="sk_<?php echo e($item->id); ?>">
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
                              <td>
                                 <?php if(is_null($item->sk_honor)): ?>
                                    Belum Ada Honor
                                 <?php else: ?>
                                    <?php echo e($item->sk_honor->status_sk_honor->status); ?>

                                 <?php endif; ?>
                              </td>
                              
                              
                              <td>
                                 <?php if($tipe == "SK Skripsi"): ?>
                                    <?php if(is_null($item->sk_honor)): ?>
                                       <a href="<?php echo e(route('keuangan.honor-skripsi.store', $item->id)); ?>" class="btn btn-success">Generate</a>
                                    <?php else: ?>
                                       <a href="<?php echo e(route('keuangan.honor-skripsi.show', $item->sk_honor->id)); ?>" class="btn btn-primary">Lihat</a>
                                       
                                    <?php endif; ?>
                                 <?php else: ?>
                                    <?php if(is_null($item->sk_honor)): ?>
                                       <a href="<?php echo e(route('keuangan.honor-sempro.store', $item->no_surat)); ?>" class="btn btn-success">Generate</a>
                                    <?php else: ?>
                                       <a href="<?php echo e(route('keuangan.honor-sempro.show', $item->sk_honor->id)); ?>" class="btn btn-primary">Lihat</a>
                                       
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
            <p>Apakah anda yakin ingin menghapus darfat honor ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>           
         <button type="button" id="hapusBtn" data-dismiss="modal" class="btn btn-outline">Hapus</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
   <script type="text/javascript">
      var nomor_kolom = 0;
      <?php if($tipe == "SK Skripsi"): ?>
         nomor_kolom = 4;
         $(`<tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
         </tr>`).clone(true).appendTo( '#data_table thead' );
      <?php else: ?>
         nomor_kolom = 3;
         $(`<tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
         </tr>`).clone(true).appendTo( '#data_table thead' );
      <?php endif; ?>

      $.fn.dataTable.moment('D MMMM Y', 'id');
      $('#data_table').DataTable({
         order: [],
         orderCellsTop: true,
         initComplete: function () {
             this.api().columns([nomor_kolom]).every( function () {
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
                     } );

                 column.data().unique().sort().each( function ( d, j ) {
                     select.append( '<option value="'+d+'">'+d+'</option>' )
                 } );
             } );
         }
      });
      
      // $("a[name='delete_honor']").click(function(event) {
      //    event.preventDefault();
      //    var id_sk = $(this).attr('id');

      //    <?php if($tipe == "SK Skripsi"): ?>
      //    var url_del = "link hapus honor sk Skripsi" + '/' + id_sk;             
      //    <?php else: ?>
      //    var url_del = "link hapus honor sk Skripsi" + '/' + id_sk;
      //    <?php endif; ?>
      //    console.log(url_del);
         
      //    $('div.modal-footer').off().on('click', '#hapusBtn', function(event) {
      //       $.ajaxSetup({
      //           headers: {
      //               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //           }
      //       });

      //       $.ajax({
      //          url: url_del,
      //          type: 'POST',
      //          // dataType: '',
      //          data: {_method: 'DELETE'},
      //       })
      //       .done(function(hasil) {
      //          console.log("success");
      //          $("tr#sk_"+id_sk).hide();
      //          $("#success_delete").show();
      //          $("#success_delete").find('span').html(hasil);
      //          $("#success_delete").fadeOut(1800);
      //       })
      //       .fail(function() {
      //          console.log("error");
      //       });
      //    });
      
      // });
   </script>
<?php $__env->stopSection(); ?>  
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/keuangan/honor_sk/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.akademik_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
      Buat SK Sempro baru
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('/adminlte/bower_components/select2/dist/css/select2.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
   <!-- bootstrap datepicker -->
   <link rel="stylesheet" href="<?php echo e(asset('/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
   
	<style type="text/css">
      table tbody tr td:first-child{
         /*width: 10%;*/
      }

      table th {
         text-align: center;
      }

      .tbl_row{
         display: table;
         width: 100%;
         border-bottom: 0.1px solid lightgrey;
         margin-top: 10px;
         margin-bottom: 10px;
      }
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
      SK Sempro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
   <form action="<?php echo e(route('akademik.sempro.store')); ?>" method="post" autocomplete="off">
      <?php echo csrf_field(); ?>
   	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
                  <h3 class="box-title">Buat SK Sempro</h3>

                    <br><br>
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
                    <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i>Error</h4>
                        <?php echo e(session('error')); ?>

                    </div>

                    <?php
                    Session::forget('error');
                    ?>
                    <?php endif; ?>
               </div>

                  <div class="box-body">
                     <div class="row">
                        <div class="form-group col-md-4">
                           <label for="no_surat">No Surat</label><br>
                           <input type="text" name="no_surat" id="no_surat" value="<?php echo e(old('no_surat')); ?>">
                           <span id="format_nomor">/UN25.1.15/SP/<?php echo e(Carbon\Carbon::today()->year); ?></span>

                           <?php if ($errors->has('no_surat')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('no_surat'); ?>
                              <br>
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong><?php echo e($message); ?></strong>
                              </span>
                           <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                        </div>

                        <div class="form-group col-md-4">
                           <label for="tgl_sempro1">Tanggal Sempro 1</label>
                           <input type="text" name="tgl_sempro1" id="tgl_sempro1" class="form-control datepicker" style="font-size: 16px;" value="<?php echo e(old('tgl_sempro1')); ?>">

                           <?php if ($errors->has('tgl_sempro1')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('tgl_sempro1'); ?>
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong><?php echo e($message); ?></strong>
                              </span>
                           <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                        </div>

                        <div class="form-group col-md-4">
                           <label for="tgl_sempro2">Tanggal Sempro 2</label>
                           <input type="text" name="tgl_sempro2" id="tgl_sempro2" class="form-control datepicker" style="font-size: 16px;" value="<?php echo e(old('tgl_sempro2')); ?>">

                           <?php if ($errors->has('tgl_sempro2')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('tgl_sempro2'); ?>
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong><?php echo e($message); ?></strong>
                              </span>
                           <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                        </div>
                     </div>

                  </div>

                  <div class="box-footer">
                     <input type="hidden" name="status" value="">
                     <button type="submit" name="simpan_kirim" class="btn btn-success pull-right">Simpan dan Kirim</button>
                     <button type="submit" name="simpan_draf" class="btn bg-purple pull-right" style="margin-right: 5px;">Simpan Sebagai Draft</button>
                  </div>

      		</div>
      	</div>
   	</div>

      <div class="row">
         <div class="col-xs-12">
            <div class="box box-default">
               <div class="box-header">
                 <h3 class="box-title">Pilih Mahasiswa</h3>
               </div>

               <div class="box-body">
                  <div class="table-responsive">
                    <?php if ($errors->has('nim')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('nim'); ?>
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                     <div class="form-group">
                        <label for="nim">Pilih NIM Mahasiswa: </label>
                        <select class="form-control select2" id="pilih_nim">
                           <option value="">--Pilih NIM--</option>
                           <?php if(!empty($old_data)): ?>
                              <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if(!in_array($item->nim, $old_data["nim"])): ?>
                                 <option value="<?php echo e($item->nim); ?>"><?php echo e($item->nim); ?> (Tgl Sempro: <?php echo e(Carbon\Carbon::parse($item->skripsi->detail_skripsi[0]->surat_tugas[0]->tanggal)->format('d/m/Y')); ?>)</option>
                                 <?php endif; ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php else: ?>
                              <?php $__currentLoopData = $mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($item->nim); ?>"><?php echo e($item->nim); ?> (Tgl Sempro: <?php echo e(Carbon\Carbon::parse($item->skripsi->detail_skripsi[0]->surat_tugas[0]->tanggal)->format('d/m/Y')); ?>)</option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           <?php endif; ?>
                        </select>
                     </div>

                     <h5>Total Data = <span class="data_count"></span></h5>
                     <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th>NIM</th>
                              <th>Nama Mahasiswa</th>
                              <th>Program Studi</th>
                              <th>Judul Skripsi</th>
                              <th>Dosen Pembahas</th>
                              <th>Opsi</th>
                           </tr>
                        </thead>

                        <tbody>
                        <?php if($old_mahasiswa != ""): ?>
                           <?php $__currentLoopData = $old_mahasiswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr id="<?php echo e($index); ?>" title="Tgl Sempro: <?php echo e(Carbon\Carbon::parse($val->skripsi->detail_skripsi[0]->surat_tugas[0]->tanggal)->format('d/m/Y')); ?>">
                                 <td style="width: 60px;">
                                    <?php echo e($val->nim); ?>

                                    <input type="hidden" name="nim[]" value="<?php echo e($val->nim); ?>">
                                 </td>
                                 <td><?php echo e($val->nama); ?></td>
                                 <td><?php echo e($val->prodi->nama); ?></td>
                                 <td style="width: 350px;" ><?php echo e($val->skripsi->detail_skripsi[0]->judul); ?></td>
                                 <td>
                                    <div class="tbl_row">
                                       1. <?php echo e($val->skripsi->detail_skripsi[0]->surat_tugas[0]->dosen1->nama); ?>

                                    </div>
                                    <div class="tbl_row">
                                       2. <?php echo e($val->skripsi->detail_skripsi[0]->surat_tugas[0]->dosen2->nama); ?>

                                    </div>
                                 </td>
                                 <td>
                                    <button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
                                 </td>
                              </tr>

                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        </tbody>

                        <tfoot>
                           <tr>
                              <th>NIM</th>
                              <th>Nama Mahasiswa</th>
                              <th>Program Studi</th>
                              <th>Judul Skripsi</th>
                              <th>Dosen Pembahas</th>
                              <th>Opsi</th>
                           </tr>
                        </tfoot>
                     </table>

                     <h5>Total Data = <span class="data_count"></span></h5>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
   <script src="<?php echo e(asset('/js/btn_backTop.js')); ?>"></script>
	<script src="<?php echo e(asset('/adminlte/bower_components/select2/dist/js/select2.full.min.js')); ?>"></script>
   <!-- bootstrap datepicker -->
   <script src="<?php echo e(asset('/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')); ?>"></script>
   <script src="<?php echo e(asset('/adminlte/bower_components/bootstrap-datepicker/js/locales/bootstrap-datepicker.id.js')); ?>"></script>

	<script type="text/javascript">
		$('.select2').select2();
		var mahasiswa = <?php echo json_encode($mahasiswa, 15, 512) ?>;
      // console.log(mahasiswa[0].skripsi.detail_skripsi);

      $("button[name='simpan_draf']").click(function(event) {
         event.preventDefault();
         $("input[name='status']").val(1);
         $('form').trigger('submit');
      });

      $("button[name='simpan_kirim']").click(function(event) {
         event.preventDefault();
         $("input[name='status']").val(2);
         $('form').trigger('submit');
      });

      //Date picker
      $('.datepicker').datepicker({
        autoclose: true,
        format: 'dd-mm-yyyy',
        language: 'id'
      })

      var no = 0;
      if ($("#tbl-data tbody tr").length) {
         var kelas = $("#tbl-data tbody tr:last-child").attr('id');
         no = parseInt(kelas);
      }

      $("#pilih_nim").on("select2:select", function(event) {
         var nim = $(this).val();
         $.each(mahasiswa, function(index, val) {
             if(nim == val.nim){
               var tgl = new Date(val.skripsi.detail_skripsi[0].surat_tugas[0].tanggal);
               var tgl_Sempro = tgl.toLocaleString('id-ID', {year: 'numeric', month:'2-digit', day: '2-digit'});
               no+=1;
               $("tbody").append(`
                  <tr id="`+no+`" title="Tgl Sempro: `+tgl_Sempro+`">
                     <td style="width: 60px;">
                        `+val.nim+`
                        <input type="hidden" name="nim[]" value="`+val.nim+`">
                     </td>
                     <td class="nama_mhs" >`+val.nama+`</td>
                     <td>`+val.prodi.nama+`</td>
                     <td style="width: 350px;" >`+val.skripsi.detail_skripsi[0].judul+`</td>
                     <td>
                        <div class="tbl_row">1. `+val.skripsi.detail_skripsi[0].surat_tugas[0].dosen1.nama+`</div>
                        <div class="tbl_row">2. `+val.skripsi.detail_skripsi[0].surat_tugas[0].dosen2.nama+`</div>
                     </td>
                     <td>
                        <button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
                     </td>
                  </tr>
               `);
             }
         });

         $(this).find('option[value="'+nim+'"]').remove();
         data_count();
         hapus_baris();
      });

      hapus_baris();
      function hapus_baris() {
         $('button[name="delete_data"]').off("click").click(function(event) {
            // console.log("hapus ya");
            var tgl_Sempro = $(this).parents("tr").attr('title');
            var nim = $(this).parents("tr").find('input[type="hidden"]').val();
            var text = nim+" ("+tgl_Sempro+")";
            var newOption = new Option(text, nim, false, false);
            $('#pilih_nim').append(newOption).trigger('change');

            var tr_class = $(this).parents("tr").remove();
            data_count();
         });
      }

      function data_count() {
         var count = $("tbody tr").length;
         $(".data_count").text(count);
      }

	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/akademik/SK_view/create_sk_sempro.blade.php ENDPATH**/ ?>
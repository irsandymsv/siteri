<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.ktu_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
	Detail SK Sempro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
	<style type="text/css">
		.tbl_row{
			display: table;
			width: 100%;
			border-bottom: 0.1px solid black;
			margin-top: 5px;
		}

		#tgl_sk{
			margin-top: 15px;
		}

		.box-body{
         width: 70%;
         margin: auto;
         margin-bottom: 20px;
         margin-top: 20px;
         font-family: 'Times New Roman';
         font-size: 16px;
         padding: 20px 50px;
         border: 1px solid black;
    }

    .landscape{
    	width: 95%;
    	padding: 20px 15px;
    }

		#kop_surat{
		   padding: 5px;
		   overflow: hidden;
		   border-bottom: 3px solid black;
		}

		#logo{
		   float: left;
		   width: 15%;
		}

		#logo img{
		   width: 100%;
		   height: auto;
		   margin-top: 10pt;

		}

		#keterangan_kop{
		   width: 85%;
		   float: left;
		   text-align: center;
		}

		#body_surat{
		   text-align: justify-all;
		}

		.top-title{
		   margin-top: 10px;
		   text-align: center;
		}

		.judul_surat{
		   font-size: 18px;
		   /*text-decoration: underline;*/
		   letter-spacing: 2pt;
		   font-weight: bold;
		}

		#detail_table{
			margin-top: 15px;
			width: 100%;
			border-collapse: collapse;
		}

		#detail_table th{
			text-align: center;
		}

		#detail_table td, th{
			border: 1px solid black;
			padding: 5px;
		}

		#detail_table td:last-child{
			padding: 0;
		}

    	#detail_table td:nth-child(5){
      	width: 280px;
    	}

		#isi_template_surat{
			width: 100%;
		}

		#isi_template_surat table:nth-child(2) tr:nth-child(6){
			page-break-after: always;
		}

		.ttd-right{
         float: right;
    }

    .right-margin{
    	margin-right: 60px;
    }
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
	SK Sempro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
	<div class="row">
		<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
              <h3 class="box-title">Data SK Sempro </h3>

              <div id="tgl_sk">
              		<h5><b>Tanggal Dibuat</b> : <?php echo e(Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></h5>

	              	<?php if($sk->verif_ktu == 0): ?>
						<b>Belum Diverifikasi</b>
						<?php elseif($sk->verif_ktu == 2): ?>
						<label class="label bg-red">Butuh Revisi</label>
						<?php else: ?>
						<label class="label bg-green">Sudah Diverifikasi</label>
						<?php endif; ?>
              </div>

              	<?php if(session()->has('verif_ktu')): ?>
              	   <br><br>
              	   <div class="alert alert-success alert-dismissible" style="margin: auto;">
              	      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              	      <h4><i class="icon fa fa-check"></i> Berhasil</h4>
              	      <?php echo e(session('verif_ktu')); ?>

              	   </div>
              	<?php endif; ?>
            </div>

            <div class="box-body">
            	<div id="kop_surat">
            	   <div id="logo">
            	      <img src="<?php echo e(asset('/image/logo-unej.png')); ?>">
            	   </div>

            	   <div id="keterangan_kop">
            	      <span class="header_18">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
            	      <span class="header_18">UNIVERSITAS JEMBER</span><br>
            	      <span class="header_18">FAKULTAS ILMU KOMPUTER</span>

            	      <br>

            	      <span>Jalan Kalimantan No. 37 Kampus Tegal Boto Jember 68121</span><br>
            	      <span>Telepon 0331 326935, Faximile 0331 326911</span><br>
            	      <span>Website : <i class="underline">www.ilkom.unej.ac.id</i></span>
            	   </div>
            	</div>

            	<div id="body_surat">
            	   <p class="top-title">
            	      <span class="judul_surat">KEPUTUSAN</span><br>
            	      <span>DEKAN FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</span><br>
            	      <span>Nomor: <?php echo e($sk->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($sk->created_at)->year); ?></span><br>
            	      <small><b>tentang</b></small><br>
            	      <span>PENETAPAN DOSEN PEMBAHAS SEMINAR PROPOSAL SKRIPSI MAHASISWA</span><br>
            	      <span>FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</span><br>
            	      <span>TAHUN AKADEMIK <?php echo e($tahun_akademik['tahun_awal'].'/'.$tahun_akademik['tahun_akhir']); ?></span><br>
            	   </p>

            	   <div id="isi_template_surat">
            	   	<?php echo $sk->template->isi; ?>

            	   </div>
                   <br>
            	   <div class="ttd-right">
            	   	
            	      Jember, <?php echo e(Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?> <br>
            	      Dekan,
            	      <br><br><br><br>
            	      <span><b><?php echo e($dekan->nama); ?></b></span><br>
            	      <span>NIP. <?php echo e($dekan->no_pegawai); ?></span>
            	   </div>

            	   <p style="clear: both;">Tembusan: </p>
            	   <ol>
            	      <li>Wakil Dekan I, II;</li>
            	      <li>Kasubag. Tata Usaha;</li>
            	   </ol>
            	   <span>Fakultas Ilmu Komputer Universitas Jember.</span>
            	</div>
            </div>

            <div class="box-body landscape">
            	<p>Lampiran SK Dekan Fakultas Ilmu Komputer Universitas Jember</p>
            	<table id="tabel_keterangan">
            		<tr>
            			<td>Nomor	</td>
            			<td>: <?php echo e($sk->no_surat); ?>/UN25.1.15/SP/<?php echo e(Carbon\Carbon::parse($sk->created_at)->year); ?></td>
            		</tr>
            		<tr>
            			<td>Tanggal	</td>
            			<td>: <?php echo e(Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?></td>
            		</tr>
            		<tr>
            			<td>Tentang		</td>
                    <td>: Penetapan Dosen Pembahas Seminar Porposal Skripsi Mahasiswa Fakultas Ilmu Komputer Jember Tahun Akademik <?php echo e($tahun_akademik['tahun_awal'].'/'.$tahun_akademik['tahun_akhir']); ?></td>
            		</tr>
            	</table>
         		<table id="detail_table">
            		<thead>
	            		<tr>
                        <th>No</th>
	            			<th>NIM</th>
	            			<th>Nama Mahasiswa</th>
	            			<th>Program Studi</th>
	            			<th>Judul Skripsi</th>
	            			<th>Dosen Pembahas</th>
	            		</tr>
	            	</thead>
	            	<tbody>
	            		<?php $__currentLoopData = $detail_skripsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            			<tr>
                        <td><?php echo e($loop->index + 1); ?></td>
            				<td><?php echo e($item->skripsi->nim); ?></td>
            				<td><?php echo e($item->skripsi->mahasiswa->nama); ?></td>
            				<td><?php echo e($item->skripsi->mahasiswa->prodi->nama); ?></td>
            				<td><?php echo e($item->judul); ?></td>
            				<td>
            					<div class="tbl_row">
            						<?php echo e($item->surat_tugas[0]->dosen1->nama); ?>

            					</div>
            					<div>
            						<?php echo e($item->surat_tugas[0]->dosen2->nama); ?>

            					</div>
            				</td>
            			</tr>
	            		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	            	</tbody>
	            </table>
                <br>
	            <div class="ttd-right">
	            	
	               Dekan,
	               <br><br><br><br>
	               <span><b><?php echo e($dekan->nama); ?></b></span><br>
	               <span>NIP. <?php echo e($dekan->no_pegawai); ?></span>
	            </div>
            </div>

            <div class="box-footer">
	            <?php if($sk->verif_dekan != 1): ?>
              	<form method="post" action="<?php echo e(route('ktu.sk-sempro.verif', $sk->no_surat)); ?>">
              		<?php echo csrf_field(); ?>
              		<?php echo method_field('put'); ?>
              		<input type="hidden" name="verif_ktu" value="<?php echo e($sk->verif_ktu); ?>">

              		<?php if($sk->verif_ktu != 1): ?>
              			<button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>
              			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik SK</button>
              		<?php endif; ?>
              	</form>
              	<?php endif; ?>
               <a href="<?php echo e(route('ktu.sk-sempro.index')); ?>" class="btn btn-default pull-right">Kembali</a>
            </div>
   		</div>
      </div>
	</div>

	<div class="modal fade" id="modal-tarik-sk">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-red">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pesan Penarikan SK</h4>
          </div>
          <form method="post" action="<?php echo e(route('ktu.sk-sempro.verif', $sk->no_surat)); ?>">
          	<?php echo csrf_field(); ?>
          	<?php echo method_field('PUT'); ?>
	          <div class="modal-body">
	            <label for="pesan_revisi">Masukkan Pesan Revisi</label>
	            <textarea name="pesan_revisi" id="pesan_revisi" class="form-control"><?php echo e(old('pesan_revisi')); ?></textarea>
	            <input type="hidden" name="verif_ktu" value="<?php echo e($sk->verif_ktu); ?>">
	            <?php if ($errors->has('pesan_revisi')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('pesan_revisi'); ?>
	            	<p style="color: red;"><?php echo e($message); ?></p>
	            <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
	          </div>
	          <div class="modal-footer">
	            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
				      <button type="submit" name="tarik_btn" class="btn btn-danger">Tarik SK</button>
	          </div>
      	  </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('/js/btn_backTop.js')); ?>"></script>
<script type="text/javascript">
	<?php if ($errors->has('pesan_revisi')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('pesan_revisi'); ?>
		$("#modal-tarik-sk").modal("show");
	<?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>

	var status = <?php echo json_encode($sk->id_status_sk, 15, 512) ?>;
	for (var i = status; i > 0; i--) {
		$("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
	}

	$("button[name='setuju_btn']").click(function(event) {
		event.preventDefault();
		$("input[name='verif_ktu']").val(1);
		$(this).parents("form").trigger('submit');
	});

	$("button[name='tarik_btn']").click(function(event) {
		event.preventDefault();
		$("input[name='verif_ktu']").val(2);
		$(this).parents("form").trigger('submit');
	});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/ktu/SK_view/sk_sempro_show.blade.php ENDPATH**/ ?>
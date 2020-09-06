<?php $__env->startSection('side_menu'); ?>
   <?php echo $__env->make('include.wadek2_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_title'); ?>
  Daftar Honorarium SK Sempro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css_link'); ?>
   <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/custom_style.css')); ?>">
   <style type="text/css">
      /*.font-sm{
         font-size: 65%;
      }*/

      .box-body{
         font-size: 15px;
      }

      .ket_tabel{
         border-collapse: inherit;
      }

      .ket_tabel td:first-child{
         padding-right: 10px;
      }

      .tabel_honor{
         width: 100%;
         border-collapse: collapse;
         border: 1px solid black;
      }

      .tabel_honor td,tr,th{
         border-collapse: collapse;
         border: 1px solid black;
      }

      .tabel_honor td{
          padding: 3px;
      }

      .th_pph{
         width: 90px;;
      }

      .th_ttd{
         width: 70px;
      }

      thead th{
         text-align: center;
      }

      .nama_dosen{
         width: 300px;
      }

      .first_td{
         text-align: center;
         width: 25px;
      }

      .jml_total td{
        font-weight: bold;
        background-color: white;
      }

      .jml_total td:first-child{
        text-align: center;
      }

      .span_uang{
         /*margin-left: 20px;*/
      }

      .to_center{
         text-align: center;
      }

      .to_left{
         float: left;
         margin-left: 35px;
      }

      .to_right{
         float: right;
         margin-right: 25%;
      }

      .ttd_row{
         clear: both;
         width: 100%;

      }

      .ttd_row div{
         width: 30%;
         float: left;
         margin-left: 35px;
      }
   </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('judul_header'); ?>
  Honorarium SK Sempro
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>

   <div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Daftar Honor Pembahas Sempro</h3>

               

               <?php if(session()->has('verif_wadek2')): ?>
                  <br><br>
                  <div class="alert alert-success alert-dismissible" style="margin: auto;">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h4><i class="icon fa fa-check"></i> Berhasil</h4>
                     <?php echo e(session('verif_wadek2')); ?>

                  </div>
               <?php endif; ?>
        </div>

        <div class="box-body">
            <table class="ket_tabel">
               <tr>
                  <td valign="top">DAFTAR</td>
                  <td valign="top">: </td>
                  <td valign="top">
                     Honorarium Dosen Pembahas Seminar Proposal Skripsi Mahasiswa Fak. Ilmu Komputer Universitas Jember T.A <?php echo e($tahun_akademik['tahun_awal']); ?>/<?php echo e($tahun_akademik['tahun_akhir']); ?> Di Lingkungan Fakultas Ilmu Komputer Universitas Jember
                  </td>
               </tr>
               <tr>
                  <td valign="top">SESUAI</td>
                  <td valign="top">: </td>
                  <td valign="top">
                     SK Dekan Fak. Ilmu Komputer UNEJ  No. <?php echo e($sk_honor->sk_sempro->no_surat); ?>/UN 25.1.15/SP/<?php echo e(Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->year); ?> Tanggal <?php echo e(Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')); ?>

                  </td>
               </tr>
            </table>
            <br>
            <div class="main_table">
               <table class="tabel_honor" style="margin-top:5px">
                  <thead>
                     <tr>
                        <th>No</th>
                        <th>Tim Pembahas I/II</th>
                        <th>NPWP</th>
                        <th>Nama Mahasiswa/NIM</th>
                        <th>Gol</th>
                        <th>Honorarium</th>
                        <th class="th_pph">PPH psl 21 5%-15%</th>
                        <th>Penerimaan</th>
                        <th class="th_ttd">Tanda Tangan</th>
                     </tr>
                  </thead>

                  <tbody id="tbl_pembahas">
                     <?php $no=0; $a = 1; $b = 1; $total_honor=0; $total_pph=0; $total_penerimaan=0; ?>

                     <?php $__currentLoopData = $detail_skripsi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($no+1 == 4*$a-1): ?>
                           <?php $a+=1; ?>
                           <tr id="<?php echo e($no+=1); ?>" style="background-color: #bbb;">
                        <?php else: ?>
                           <tr id="<?php echo e($no+=1); ?>">
                        <?php endif; ?>
                           <td class="first_td"><?php echo e($no); ?></td>
                           <td class="nama_dosen"><?php echo e($item->surat_tugas[0]->dosen1->nama); ?></td>
                           <td class="to_center"><?php echo e($item->surat_tugas[0]->dosen1->npwp); ?></td>
                           <td rowspan="2">
                              <p><?php echo e($item->skripsi->mahasiswa->nama); ?></p>
                              <p>NIM: <?php echo e($item->skripsi->nim); ?></p>
                           </td>
                           <td class="to_center">
                              <?php if(is_null($item->surat_tugas[0]->dosen1->golongan)): ?>
                                 -
                              <?php else: ?>
                              <?php
                                 $gol = $item->surat_tugas[0]->dosen1->golongan->golongan;
                              ?>
                                 <?php echo e(substr($gol,0,(strlen($gol)-2 ))); ?>

                              <?php endif; ?>
                           </td>
                           <td id="penguji_<?php echo e($no); ?>" class="pengujiHonor">Rp
                              <?php echo e(number_format($sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor, 0, ",", ".")); ?>

                           </td>
                           <td class="pph" id="pph_<?php echo e($no); ?>">Rp
                              <?php
                                 $pph = ($item->surat_tugas[0]->dosen1->pph * $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor)/100;
                              ?>
                              <span class="span_uang"><?php echo e(number_format($pph, 0, ",", ".")); ?></span>
                           </td>
                           <td class="penerimaan" id="penerimaan_<?php echo e($no); ?>">Rp
                              <?php
                                 $penerimaan = $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor - $pph;
                              ?>
                              <span class="span_uang"><?php echo e(number_format($penerimaan, 0, ",", ".")); ?></span>
                           </td>
                           <td><?php echo e($no); ?>.</td>

                           <?php
                              $total_honor+=$sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor;
                              $total_pph+=$pph;
                              $total_penerimaan+=$penerimaan;
                           ?>
                        </tr>

                        <?php if($no+1 == 4*$b): ?>
                           <?php $b+=1; ?>
                           <tr id="<?php echo e($no+=1); ?>" style="background-color: #bbb;">
                        <?php else: ?>
                           <tr id="<?php echo e($no+=1); ?>">
                        <?php endif; ?>
                           <td class="first_td"><?php echo e($no); ?></td>
                           <td class="nama_dosen"><?php echo e($item->surat_tugas[0]->dosen2->nama); ?></td>
                           <td class="to_center"><?php echo e($item->surat_tugas[0]->dosen2->npwp); ?></td>
                           <td class="to_center">
                              <?php if(is_null($item->surat_tugas[0]->dosen2->golongan)): ?>
                                 -
                              <?php else: ?>
                              <?php
                                 $gol = $item->surat_tugas[0]->dosen2->golongan->golongan;
                              ?>
                                 <?php echo e(substr($gol,0,(strlen($gol)-2 ))); ?>

                              <?php endif; ?>
                           </td>
                           <td id="penguji_<?php echo e($no); ?>" class="pengujiHonor">Rp
                              <?php echo e(number_format($sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor, 0, ",", ".")); ?>

                           </td>
                           <td class="pph" id="pph_<?php echo e($no); ?>">Rp
                              <?php
                                 $pph = ($item->surat_tugas[0]->dosen2->pph * $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor)/100;
                              ?>
                              <span class="span_uang"><?php echo e(number_format($pph, 0, ",", ".")); ?></span>
                           </td>
                           <td class="penerimaan" id="penerimaan_<?php echo e($no); ?>">Rp
                              <?php
                                 $penerimaan = $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor - $pph;
                              ?>
                              <span class="span_uang"><?php echo e(number_format($penerimaan, 0, ",", ".")); ?></span>
                           </td>
                           <td><?php echo e($no); ?>.</td>

                           <?php
                              $total_honor+=$sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor;
                              $total_pph+=$pph;
                              $total_penerimaan+=$penerimaan;
                           ?>
                        </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                     <tr class="jml_total">
                        <td colspan="5">Jumlah</td>
                        <td>Rp <?php echo e(number_format($total_honor, 0, ",", ".")); ?></td>
                        <td>Rp <?php echo e(number_format($total_pph, 0, ",", ".")); ?></td>
                        <td>Rp <?php echo e(number_format($total_penerimaan, 0, ",", ".")); ?></td>
                        <td></td>
                     </tr>
                      <?php
                          function penyebut($nilai) {
                              $nilai = abs($nilai);
                              $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
                              $temp = "";
                              if ($nilai < 12) {
                                  $temp = " ". $huruf[$nilai];
                              } else if ($nilai <20) {
                                  $temp = penyebut($nilai - 10). " Belas";
                              } else if ($nilai < 100) {
                                  $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
                              } else if ($nilai < 200) {
                                  $temp = " Seratus" . penyebut($nilai - 100);
                              } else if ($nilai < 1000) {
                                  $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
                              } else if ($nilai < 2000) {
                                  $temp = " Seribu" . penyebut($nilai - 1000);
                              } else if ($nilai < 1000000) {
                                  $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
                              } else if ($nilai < 1000000000) {
                                  $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
                              } else if ($nilai < 1000000000000) {
                                  $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
                              } else if ($nilai < 1000000000000000) {
                                  $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
                              }
                              return $temp;
                          }
                          function terbilang($nilai) {
                              if($nilai<0) {
                                  $hasil = "minus ". trim(penyebut($nilai));
                              } else {
                                  $hasil = trim(penyebut($nilai));
                              }
                              return $hasil;
                          }
                      ?>
                     <tr class="jml_total">
                        <td colspan="9">Terbilang:
                              <?php
                                  echo(terbilang($total_honor).' Rupiah');
                              ?>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
            <br>
            <span class="to_left">Mengetahui</span>
            <span class="to_right">Jember</span><br>
            <div class="ttd_row">
               <div>
                  PPK,
                  <br><br><br><br>
                  <span><b><?php echo e($dekan->nama); ?></b></span><br>
                  <span>NIP. <?php echo e($dekan->no_pegawai); ?></span>
               </div>

               <div>
                 Kasubag TU,
                 <br><br><br><br>
                 <span><b><?php echo e($ktu->nama); ?></b></span><br>
                 <span>NIP. <?php echo e($ktu->no_pegawai); ?></span>
               </div>

               <div>
                 BPP Fakultas Ilmu Komputer,
                 <br><br><br><br>
                 <span><b><?php echo e($bpp->nama); ?></b></span><br>
                 <span>NIP. <?php echo e($bpp->no_pegawai); ?></span>
               </div>
            </div>
        </div>

         <div class="box-footer">
            

            <a href="<?php echo e(route('wadek2.honor-sempro.index')); ?>" class="btn btn-default pull-right">Kembali</a>
         </div>
      </div>
    </div>
   </div>

   <div class="row">
      <div class="col-xs-12">
         
      </div>
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
    
    $("button[name='setuju_btn']").click(function(event) {
       event.preventDefault();
       $("input[name='verif_wadek2']").val(1);
       $(this).parents("form").trigger('submit');
    });

    $("button[name='tarik_btn']").click(function(event) {
       event.preventDefault();
       $("input[name='verif_wadek2']").val(2);
       $(this).parents("form").trigger('submit');
    });
   </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\siteri\resources\views/wadek2/honor_sk/show_sempro.blade.php ENDPATH**/ ?>
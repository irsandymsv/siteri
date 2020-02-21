@extends('layouts.template')

@section('side_menu')
   @include('include.keuangan_menu')
@endsection

@section('page_title')
	Buat Honorarium SK Sempro
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
   <style type="text/css">
      #btn_honor_pembimbing, #btn_honor_penguji{
         margin-left: 8px;
      }

      table{
         font-size: 15px;
      }

      table th{
         text-align: center;
      }

      .input_honor{
         margin-top: 5px;
      }

      td span{
         float: right;
      }

      #tbl_add_honor_pembimbing td{
         padding: 3px;
      }

      #tbl_add_honor_pembimbing td input{
         width: 100%;
      }

      .jml_total td{
         font-weight: bold;
         background-color: white;
      }

      /* .absolute{
         top: 0px;
         right: -250px;
      } */
   </style>
@endsection

@section('judul_header')
	Honorarium SK Sempro
@endsection

@section('content')
<button id="back_top" type="button" class="btn bg-black"><i class="fa fa-arrow-up"></i></button>

<form method="POST" action="{{ route("keuangan.honor-sempro.store") }}">
   @csrf
   <div class="row">
      <div class="col-xs-12" id="top_title">
            <div class="box box-success">
               <div class="box-header">
                  <h3 class="box-title">Buat Honorarium SK Sempro</h3>

                  <div class="box-tools pull-right">
                   <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                   </button>
                 </div>
               </div>

               <div class="box-body">
                  <h4><b>Informasi SK Sempro:</b></h3>
                  <p>
                     Nomor SK : {{ $sk_sempro->no_surat }}//UN 25.1.15/SP/{{Carbon\Carbon::parse($sk_sempro->created_at)->year}}
                  </p>
                  <p>Tanggal SK : {{Carbon\Carbon::parse($sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</p>
                  {{-- <button class="btn bg-purple" name="simpan_draf">Simpan Sebagai Draft</button> --}}
                  <input type="hidden" name="id_sk_sempro" value="{{ $sk_sempro->no_surat }}">
                  <button class="btn btn-success" name="simpan_kirim">Simpan dan Kirim</button>
               </div>
            </div>
      </div>
   </div>

   <div class="row">
   	<div class="col-xs-12">
   		<div class="box box-danger">
   			<div class="box-header">
   				<h3 class="box-title">Daftar Honor Pembahas Sempro</h3>

               <div class="box-tools pull-right">
                     <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                     </button>
                     <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                   </button>
               </div>
   			</div>

   			<div class="box-body">
               <div class="table-responsive">
                  <table id="dataTable2" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Pembahas I/II</th>
                           <th>NPWP</th>
                           <th>Nama Mahasiswa/NIM</th>
                           <th>Gol</th>
                           <th>Honorarium</th>
                           <th>PPH psl 5%-15%</th>
                           <th>Penerimaan</th>
                        </tr>
                     </thead>

                     <tbody id="tbl_penguji">
                        @php 
                           $no = 0; $total_honor=0; $total_pph=0; $total_penerimaan=0;
                        @endphp
                        @foreach($detail_skripsi as $item)
                           <tr id="{{ $no+=1 }}">
                              <td>{{ $no }}</td>
                              <td>{{ $item->surat_tugas[0]->dosen1->nama }}</td>
                              <td>{{ $item->surat_tugas[0]->dosen1->npwp }}</td>
                              <td rowspan="2">
                                 <p>{{ $item->skripsi->mahasiswa->nama }}</p>
                                 <p>NIM: {{ $item->skripsi->nim }}</p>
                              </td>
                              <td>{{ $item->surat_tugas[0]->dosen1->golongan->golongan }}</td>
                              <td class="pengujiHonor">Rp {{ $honor_pembahas->jumlah_honor }}</td>
                              <td class="pph" id="pph_{{$no}}">Rp 
                                 @php
                                    $pph = ($honor_pembahas->jumlah_honor * $item->surat_tugas[0]->dosen1->golongan->pph)/100;
                                 @endphp
                                 {{ number_format($pph, 0, ",", ".") }}
                              </td>
                              <td class="penerimaan" id="penerimaan_{{$no}}">Rp 
                                 @php
                                    $penerimaan = $honor_pembahas->jumlah_honor - $pph;
                                 @endphp
                                 {{ number_format($penerimaan, 0, ",", ".") }}
                              </td>

                              @php
                                 $total_honor+=$honor_pembahas->jumlah_honor;
                                 $total_pph+=$pph;
                                 $total_penerimaan+=$penerimaan;
                              @endphp
                           </tr>

                           <tr id="{{ $no+=1 }}">
                              <td>{{ $no }}</td>
                               <td>{{ $item->surat_tugas[0]->dosen2->nama }}</td>
                              <td>{{$item->surat_tugas[0]->dosen2->npwp}}</td>
                              <td>{{$item->surat_tugas[0]->dosen2->golongan->golongan}}</td>
                              <td class="pengujiHonor">Rp {{ number_format($honor_pembahas->jumlah_honor, 0, ",", ".")  }}</td>
                              <td class="pph" id="pph_{{$no}}">Rp 
                                 @php
                                    $pph = ($honor_pembahas->jumlah_honor * $item->surat_tugas[0]->dosen2->golongan->pph)/100;
                                 @endphp
                                 {{ number_format($pph, 0, ",", ".") }}
                              </td>
                              <td class="penerimaan" id="penerimaan_{{$no}}">Rp 
                                 @php
                                    $penerimaan = $honor_pembahas->jumlah_honor - $pph;
                                 @endphp
                                 {{ number_format($penerimaan, 0, ",", ".") }}
                              </td>

                              @php
                                 $total_honor+=$honor_pembahas->jumlah_honor;
                                 $total_pph+=$pph;
                                 $total_penerimaan+=$penerimaan;
                              @endphp
                           </tr>
                        @endforeach

                        <tr class="jml_total">
                           <td colspan="5" style="text-align: center;">Jumlah</td>
                           <td>Rp {{ number_format($total_honor, 0, ",", ".") }}</td>
                           <td>Rp {{ number_format($total_pph, 0, ",", ".") }}</td>
                           <td>Rp {{ number_format($total_penerimaan, 0, ",", ".") }}</td>
                        </tr>
                        <tr>
                           <td colspan="8">Terbilang: </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
   			</div>
   		</div>
   	</div>
   </div>
   <div class="row">
      <div class="col-xs-12">
         <input type="hidden" name="status" value="">
         <div class="form-group" style="float: left;">
		      	{{-- <button type="submit" name="simpan_draf" class="btn bg-purple">Simpan Sebagai Draft</button> --}}
		      	<button type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>	
		   </div>
      </div>
   </div>
</form>
@endsection

@section('script')
   <script src="{{asset('/js/btn_backTop.js')}}"></script>
   <script type="text/javascript">

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

      // var detail_sk = @json($detail_sk);
      // console.log(detail_sk);

      // $("#btn_honor_pembimbing").click(function(event) {
      //    var honor_1 = $("#honor_pembimbing1").val();
      //    var honor_2 = $("#honor_pembimbing2").val();
         
      //    $(".pembimbingHonor_1").children("span").text(formatRupiah(honor_1));
      //    $(".pembimbingHonor_2").children("span").text(formatRupiah(honor_2));

      //    var ttl_honor_pembimbing = 0;
      //    var ttl_pph_pembimbing = 0;
      //    var ttl_penerimaan_pembimbing = 0;
      //    var no = 0;
      //    $.each(detail_sk, function(index, val){
      //       no+=1;
      //       var pph1 = (honor_1 * val.pembimbing_utama.golongan.pph)/100;
      //       var penerimaan1 = honor_1 - pph1;

      //       $("#tbl_pembimbing").find("#pph_"+no).children('span').text(formatRupiah(pph1));
      //       $("#tbl_pembimbing").find("#penerimaan_"+no).children('span').text(formatRupiah(penerimaan1));
      //       ttl_honor_pembimbing += parseInt(honor_1);
      //       ttl_pph_pembimbing += pph1;
      //       ttl_penerimaan_pembimbing += penerimaan1;  

      //       no+=1;
      //       var pph2 = (honor_2 * val.pembimbing_pendamping.golongan.pph)/100;
      //       var penerimaan2 = honor_2 - pph2;
      //       $("#tbl_pembimbing").find("#pph_"+no).children('span').text(formatRupiah(pph2));
      //       $("#tbl_pembimbing").find("#penerimaan_"+no).children('span').text(formatRupiah(penerimaan2));
      //       ttl_honor_pembimbing += parseInt(honor_2);
      //       ttl_pph_pembimbing += pph2;
      //       ttl_penerimaan_pembimbing += penerimaan2;
      //    });

      //    $("#total_honor_pembimbing").text(formatRupiah(ttl_honor_pembimbing));
      //    $("#total_pph_pembimbing").text(formatRupiah(ttl_pph_pembimbing));
      //    $("#total_penerimaan_pembimbing").text(formatRupiah(ttl_penerimaan_pembimbing));
      // });


      // $("#btn_honor_penguji").click(function(event) {
      //    var honor = $("#honor_penguji").val();
      //    $(".pengujiHonor").children("span").text(formatRupiah(honor));

      //    var ttl_honor_penguji = 0;
      //    var ttl_pph_penguji = 0;
      //    var ttl_penerimaan_penguji = 0;
      //    var no = 0;
      //    $.each(detail_sk, function(index, val){
      //       no+=1;
      //       var pph1 = (honor * val.penguji_utama.golongan.pph)/100;
      //       var penerimaan1 = honor - pph1;
      //       $("#tbl_penguji").find("#pph_"+no).children('span').text(formatRupiah(pph1));
      //       $("#tbl_penguji").find("#penerimaan_"+no).children('span').text(formatRupiah(penerimaan1));
      //       ttl_honor_penguji += parseInt(honor);
      //       ttl_pph_penguji += pph1;
      //       ttl_penerimaan_penguji += penerimaan1;

      //       no+=1;
      //       var pph2 =( honor * val.penguji_pendamping.golongan.pph)/100;
      //       var penerimaan2 = honor - pph2;
      //       $("#tbl_penguji").find("#pph_"+no).children('span').text(formatRupiah(pph2));
      //       $("#tbl_penguji").find("#penerimaan_"+no).children('span').text(formatRupiah(penerimaan2));
      //       ttl_honor_penguji += parseInt(honor);
      //       ttl_pph_penguji += pph2;
      //       ttl_penerimaan_penguji += penerimaan2;
      //    });

      //    $("#total_honor_penguji").text(formatRupiah(ttl_honor_penguji));
      //    $("#total_pph_penguji").text(formatRupiah(ttl_pph_penguji));
      //    $("#total_penerimaan_penguji").text(formatRupiah(ttl_penerimaan_penguji));
      // });

      //Mengubah format angka
      // function formatRupiah(angka){
      //    var number_string = angka.toString().replace(/[^,\d]/g, ''),
      //    split       = number_string.split(','),
      //    sisa           = split[0].length % 3,
      //    rupiah         = split[0].substr(0, sisa),
      //    ribuan         = split[0].substr(sisa).match(/\d{3}/gi);
 
      //    // tambahkan titik jika yang di input sudah menjadi angka ribuan
      //    if(ribuan){
      //       separator = sisa ? '.' : '';
      //       rupiah += separator + ribuan.join('.');
      //    }
 
      //    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      //    return rupiah;
      //    // return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
      // }

      // new_pembimbing_honor();
      // function new_pembimbing_honor() {
      //    $(".pembimbingHonor").keyup(function(event) {
      //       var honor = $(this).val();
      //       var id = $(this).parents("tr").attr("id");
      //       console.log("honor = "+honor);

      //       var tanda = 0;
      //       if(id%2 == 0){
      //          tanda = 2;
      //       }
      //       else{
      //          tanda = 1;
      //       }

      //       var pph = 0;
      //       var nomor = 0;
      //       $.each(detail_sk, function(index, val) {
      //          nomor+=1;
      //           if(nomor == id){
      //             if(tanda == 1){
      //                pph = val.pembimbing_utama.golongan.pph;
      //                return false;
      //             }
      //             else{
      //                pph = val.pembimbing_pendamping.golongan.pph;
      //                return false;  
      //             }
      //           }

      //           nomor+=1;
      //           if(nomor == id){
      //             if(tanda == 1){
      //                pph = val.pembimbing_utama.golongan.pph;
      //                return false;
      //             }
      //             else{
      //                pph = val.pembimbing_pendamping.golongan.pph;
      //                return false;  
      //             }
      //           }
      //       });

      //       console.log("pph = "+pph);

      //       var uang_pph = (pph * honor)/100;
      //       var penerimaan = honor-uang_pph;
      //       $("#tbl_pembimbing").find("#pph_"+id).children('span').text(uang_pph);
      //       $("#tbl_pembimbing").find("#penerimaan_"+id).children('span').text(penerimaan);
      //    });
      // }

      // new_penguji_honor();
      // function new_penguji_honor() {
      //    $(".pengujiHonor").keyup(function(event) {
      //       var honor = $(this).val();
      //       var id = $(this).parents("tr").attr("id");
      //       console.log("honor = "+honor);

      //       var tanda = 0;
      //       if(id%2 == 0){
      //          tanda = 2;
      //       }
      //       else{
      //          tanda = 1;
      //       }

      //       var pph = 0;
      //       var nomor = 0;
      //       $.each(detail_sk, function(index, val) {
      //          nomor+=1;
      //           if(nomor == id){
      //             if(tanda == 1){
      //                pph = val.penguji_utama.golongan.pph;
      //                return false;
      //             }
      //             else{
      //                pph = val.penguji_pendamping.golongan.pph;
      //                return false;  
      //             }
      //           }

      //           nomor+=1;
      //           if(nomor == id){
      //             if(tanda == 1){
      //                pph = val.penguji_utama.golongan.pph;
      //                return false;
      //             }
      //             else{
      //                pph = val.penguji_pendamping.golongan.pph;
      //                return false;  
      //             }
      //           }
      //       });

      //       console.log("pph = "+pph);

      //       var uang_pph = (pph * honor)/100;
      //       var penerimaan = honor-uang_pph;
      //       $("#tbl_penguji").find("#pph_"+id).children('span').text(uang_pph);
      //       $("#tbl_penguji").find("#penerimaan_"+id).children('span').text(penerimaan);
      //    });
      // }
   </script>
@endsection
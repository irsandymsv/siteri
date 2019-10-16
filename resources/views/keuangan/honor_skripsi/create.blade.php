@extends('keuangan.keuangan_view')

@section('page_title')
	Buat Honorarium SK Skripsi
@endsection

@section('css_link')
   <style type="text/css">
      #btn_honor_pembimbing, #btn_honor_penguji{
         margin-left: 8px;
      }

      table{
         font-size: 16px;
      }

      table th{
         text-align: center;
      }
   </style>
@endsection

@section('judul_header')
	Honorarium Pembimbing Skripsi
@endsection

@section('content')
<form method="POST" action="#">
   @csrf
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-header">
               <h3 class="box-title">Buat Daftar Honor Pembimbing Skripsi</h3>

               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
               </div>
            </div>

            <div class="box-body">
               <div class="input_honor">
                  <label for="honor_pembimbing">Masukkan jumlah uang honorarium: Rp </label>
                  <input type="number" name="honor_pembimbing" id="honor_pembimbing">
                  <button type="button" id="btn_honor_pembimbing" class="btn btn-default">Ok</button>
               </div>
               <div class="table-responsive">
                  <table id="table_data1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Pembimbing I/II</th>
                           <th>NPWP</th>
                           <th>Nama Mahasiswa/NIM</th>
                           <th>Gol</th>
                           <th>Honorarium</th>
                           <th>PPH psl 5%-15%</th>
                           <th>Penerimaan</th>
                        </tr>
                     </thead>

                     <tbody id="tbl_pembimbing">
                        @php $no = 0; @endphp
                        @foreach($detail_sk as $item)
                           <tr id="{{$no+=1}}">
                              <td>{{$no}}</td>
                              <td>{{$item->pembimbing_utama->nama}}</td>
                              <td>{{$item->pembimbing_utama->npwp}}</td>
                              <td rowspan="2">
                                 <p>{{$item->nama_mhs}}</p>
                                 <p>NIM: {{$item->nim}}</p>
                              </td>
                              <td>{{$item->pembimbing_utama->golongan->golongan}}</td>
                              <td>
                                 Rp <input type="number" name="honorarium_pembimbing[]" class="pembimbingHonor" id="pembimbing_{{$no}}" min="0">
                              </td>
                              <td class="pph" id="pph_{{$no}}">Rp &ensp; <span></span></td>
                              <td class="penerimaan" id="penerimaan_{{$no}}">Rp &ensp; <span></span></td>
                           </tr>

                           <tr id="{{$no+=1}}">
                              <td>{{$no}}</td>
                               <td>{{$item->pembimbing_pendamping->nama}}</td>
                              <td>{{$item->pembimbing_pendamping->npwp}}</td>
                              <td>{{$item->pembimbing_pendamping->golongan->golongan}}</td>
                              <td>
                                 Rp <input type="number" name="honorarium_pembimbing[]" class="pembimbingHonor" id="pembimbing_{{$no}}" min="0">
                              </td>
                              <td class="pph" id="pph_{{$no}}">Rp &ensp; <span></span></td>
                              <td class="penerimaan" id="penerimaan_{{$no}}">Rp &ensp; <span></span></td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
   	<div class="col-xs-12">
   		<div class="box box-danger">
   			<div class="box-header">
   				<h3 class="box-title">Buat Daftar Honor Penguji Skripsi</h3>

               <div class="box-tools pull-right">
                     <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                     </button>
                     <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                   </button>
               </div>
   			</div>

   			<div class="box-body">
               <div class="input_honor">
                  <label for="honor_penguji">Masukkan jumlah uang honorarium: Rp </label>
                  <input type="number" name="honor_penguji" id="honor_penguji">
                  <button type="button" id="btn_honor_penguji" class="btn btn-default">Ok</button>
               </div>
               <div class="table-responsive">
                  <table id="table_data2" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Penguji I/II</th>
                           <th>NPWP</th>
                           <th>Nama Mahasiswa/NIM</th>
                           <th>Gol</th>
                           <th>Honorarium</th>
                           <th>PPH psl 5%-15%</th>
                           <th>Penerimaan</th>
                        </tr>
                     </thead>

                     <tbody id="tbl_penguji">
                        @php $no = 0; @endphp
                        @foreach($detail_sk as $item)
                           <tr id="{{$no+=1}}">
                              <td>{{$no}}</td>
                              <td>{{$item->penguji_utama->nama}}</td>
                              <td>{{$item->penguji_utama->npwp}}</td>
                              <td rowspan="2">
                                 <p>{{$item->nama_mhs}}</p>
                                 <p>NIM: {{$item->nim}}</p>
                              </td>
                              <td>{{$item->penguji_utama->golongan->golongan}} {{$item->penguji_utama->golongan->pph}}</td>
                              <td>
                                 Rp <input type="number" name="honorarium_penguji[]" class="pengujiHonor" id="penguji_{{$no}}" min="0">
                              </td>
                              <td class="pph" id="pph_{{$no}}">Rp &ensp; <span></span></td>
                              <td class="penerimaan" id="penerimaan_{{$no}}">Rp &ensp; <span></span></td>
                           </tr>

                           <tr id="{{$no+=1}}">
                              <td>{{$no}}</td>
                               <td>{{$item->penguji_pendamping->nama}}</td>
                              <td>{{$item->penguji_pendamping->npwp}}</td>
                              <td>{{$item->penguji_pendamping->golongan->golongan}} {{$item->penguji_pendamping->golongan->pph}}</td>
                              <td>
                                 Rp <input type="number" name="honorarium_penguji[]" class="pengujiHonor" name="penguji_{{$no}}" min="0">
                              </td>
                              <td class="pph" id="pph_{{$no}}">Rp &ensp; <span></span></td>
                              <td class="penerimaan" id="penerimaan_{{$no}}">Rp &ensp; <span></span></td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
   			</div>
   		</div>
   	</div>
   </div>
</form>
@endsection

@section('script')
   <script type="text/javascript">
      var detail_sk = @json($detail_sk);
      // console.log(detail_sk);

      $("#btn_honor_pembimbing").click(function(event) {
         var honor = $("#honor_pembimbing").val();
         $(".pembimbingHonor").val(honor);

         var no = 0;
         $.each(detail_sk, function(index, val){
            // console.log(val.penguji_pendamping.nama +" "+ val.penguji_pendamping.golongan.pph);
            no+=1;
            var pph1 = honor * val.pembimbing_utama.golongan.pph;
            var penerimaan1 = honor - pph1;
            $("#tbl_pembimbing").find("#pph_"+no).children('span').text(pph1);
            $("#tbl_pembimbing").find("#penerimaan_"+no).children('span').text(penerimaan1);

            no+=1;
            var pph2 = honor * val.pembimbing_pendamping.golongan.pph;
            var penerimaan2 = honor - pph2;
            $("#tbl_pembimbing").find("#pph_"+no).children('span').text(pph2);
            $("#tbl_pembimbing").find("#penerimaan_"+no).children('span').text(penerimaan2);
         });
      });

      $("#btn_honor_penguji").click(function(event) {
         var honor = $("#honor_penguji").val();
         $(".pengujiHonor").val(honor);

         var no = 0;
         $.each(detail_sk, function(index, val){
            // console.log(val.penguji_pendamping.nama +" "+ val.penguji_pendamping.golongan.pph);
            no+=1;
            var pph1 = honor * val.penguji_utama.golongan.pph;
            var penerimaan1 = honor - pph1;
            $("#tbl_penguji").find("#pph_"+no).children('span').text(pph1);
            $("#tbl_penguji").find("#penerimaan_"+no).children('span').text(penerimaan1);

            no+=1;
            var pph2 = honor * val.penguji_pendamping.golongan.pph;
            var penerimaan2 = honor - pph2;
            $("#tbl_penguji").find("#pph_"+no).children('span').text(pph2);
            $("#tbl_penguji").find("#penerimaan_"+no).children('span').text(penerimaan2);
         });
      });

      new_pembimbing_honor();

      function new_pembimbing_honor() {
         $(".pembimbingHonor").keyup(function(event) {
            var honor = $(this).val();
            var id = $(this).parents("tr").attr("id");
            console.log("honor = "+honor);

            var tanda = 0;
            if(id%2 == 0){
               tanda = 2;
            }
            else{
               tanda = 1;
            }

            var pph = 0;
            var nomor = 0;
            $.each(detail_sk, function(index, val) {
               nomor+=1;
                if(nomor == id){
                  if(tanda == 1){
                     pph = val.pembimbing_utama.golongan.pph;
                     return false;
                  }
                  else{
                     pph = val.pembimbing_pendamping.golongan.pph;
                     return false;  
                  }
                }

                nomor+=1;
                if(nomor == id){
                  if(tanda == 1){
                     pph = val.pembimbing_utama.golongan.pph;
                     return false;
                  }
                  else{
                     pph = val.pembimbing_pendamping.golongan.pph;
                     return false;  
                  }
                }
            });

            console.log("pph = "+pph);

            var uang_pph = pph * honor;
            var penerimaan = honor-uang_pph;
            $("#tbl_pembimbing").find("#pph_"+id).children('span').text(uang_pph);
            $("#tbl_pembimbing").find("#penerimaan_"+id).children('span').text(penerimaan);
         });
      }

      new_penguji_honor();
      function new_penguji_honor() {
         $(".pengujiHonor").keyup(function(event) {
            var honor = $(this).val();
            var id = $(this).parents("tr").attr("id");
            console.log("honor = "+honor);

            var tanda = 0;
            if(id%2 == 0){
               tanda = 2;
            }
            else{
               tanda = 1;
            }

            var pph = 0;
            var nomor = 0;
            $.each(detail_sk, function(index, val) {
               nomor+=1;
                if(nomor == id){
                  if(tanda == 1){
                     pph = val.penguji_utama.golongan.pph;
                     return false;
                  }
                  else{
                     pph = val.penguji_pendamping.golongan.pph;
                     return false;  
                  }
                }

                nomor+=1;
                if(nomor == id){
                  if(tanda == 1){
                     pph = val.penguji_utama.golongan.pph;
                     return false;
                  }
                  else{
                     pph = val.penguji_pendamping.golongan.pph;
                     return false;  
                  }
                }
            });

            console.log("pph = "+pph);

            var uang_pph = pph * honor;
            var penerimaan = honor-uang_pph;
            $("#tbl_penguji").find("#pph_"+id).children('span').text(uang_pph);
            $("#tbl_penguji").find("#penerimaan_"+id).children('span').text(penerimaan);
         });
      }
   </script>
@endsection
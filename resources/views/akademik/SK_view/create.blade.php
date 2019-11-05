@extends('akademik.akademik_view')

@section('page_title')
	@if($tipe == "sk skripsi")
      Buat SK skripsi Baru
   @else
      Buat SK Sempro baru
   @endif
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
      table tbody tr td:first-child{
         /*width: 10%;*/
      }

      table th {
         text-align: center;
      }

      .row_separator{
         border-bottom: 1px solid black;
         width: 100%;
      }
	</style>
@endsection

@section('judul_header')
	@if($tipe == "sk skripsi")
      SK Skripsi
   @else
      SK Sempro
   @endif
@endsection

@section('content')
   <form action="{{ ( $tipe == "sk skripsi"? route('akademik.skripsi.store') : route('akademik.sempro.store') ) }}" method="post">
      @csrf
   	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
                    <br><br>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Sukses</h4>
                        {{session('success')}}
                    </div>
                    @php
                    Session::forget('success');
                    @endphp

                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-ban"></i>Error</h4>
                        {{session('error')}}
                    </div>

                    @php
                    Session::forget('error');
                    @endphp
                    @endif
                    <h3 class="box-title">Buat SK Sempro</h3>
               </div>

                  <div class="box-body">
                     <div class="row">
                        <div class="form-group col-md-4">
                           <label for="no_surat">No Surat</label><br>
                           <input type="text" name="no_surat" id="no_surat">
                           <span id="format_nomor">/UN25.1.15/SP/{{ Carbon\Carbon::today()->year }}</span>

                           @error('no_surat')
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>

                        <div class="form-group col-md-4">
                           <label for="tgl_sempro1">Tanggal Sempro 1</label>
                           <input type="date" name="tgl_sempro1" id="tgl_sempro1" class="form-control">
                        </div>

                        <div class="form-group col-md-4">
                           <label for="tgl_sempro2">Tanggal Sempro 2</label>
                           <input type="date" name="tgl_sempro2" id="tgl_sempro2" class="form-control">
                        </div>
                     </div>

                  </div>

                  <div class="box-footer">
                     <div class="form-group" style="float: right;">
                        <input type="hidden" name="status" value="">
                        <button type="submit" name="simpan_draf" class="btn bg-purple">Simpan Sebagai Draft</button>
                           &ensp;
                        <button type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>
                     </div>
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

                     <div class="form-group">
                        <label for="nim">Pilih NIM Mahasiswa: </label>
                        <select class="form-control select2" id="pilih_nim">
                           <option value="">--Pilih NIM--</option>
                           @foreach ($mahasiswa as $item)
                              @if ($errors->any())
                                 @if (!in_array($item->nim, $old_data["nim"]))
                                 <option value="{{ $item->nim }}">{{ $item->nim }}</option>
                                 @endif
                              @else
                                 <option value="{{ $item->nim }}">{{ $item->nim }}</option>
                              @endif
                           @endforeach
                        </select>
                     </div>

                     <h5>Total Data = <span class="data_count"></span></h5>
                     <table id="tbl-data" class="table table-bordered">
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
                        @if ($errors->any())
                           @foreach($old_mahasiswa as $index => $val)
                              <tr class="{{ $index }}">
                                 <td style="width: 60px;" rowspan="2">
                                    {{ $val->nim }}
                                    <input type="hidden" name="nim[]" value="{{ $val->nim }}">
                                 </td>
                                 <td rowspan="2">{{ $val->nama }}</td>
                                 <td rowspan="2">{{ $val->bagian->bagian }}</td>
                                 <td style="width: 350px;" rowspan="2">{{ $val->detail_skripsi->judul }}</td>
                                 <td>{{ $val->detail_skripsi->pembahas1->nama }}</td>
                                 <td rowspan="2">
                                    <button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
                                 </td>
                              </tr>
                              <tr class="{{ $index }}">
                                 <td>{{ $val->detail_skripsi->pembahas2->nama }}</td>
                              </tr>
                           @endforeach
                        @endif
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
@endsection

@section('script')
	<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script type="text/javascript">
		$('.select2').select2();
		var mahasiswa = @json($mahasiswa);

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

      var no = 0;
      if ($("#tbl-data tbody tr").length) {
         var kelas = $("#tbl-data tbody tr:last-child").attr('class');
         no = parseInt(kelas);
      }

      $("#pilih_nim").on("select2:select", function(event) {
         var nim = $(this).val();
         $.each(mahasiswa, function(index, val) {
             if(nim == val.nim){
               no+=1;
               $("tbody").append(`
                  <tr class="`+no+`">
                     <td style="width: 60px;" rowspan="2">
                        `+val.nim+`
                        <input type="hidden" name="nim[]" value="`+val.nim+`">
                     </td>
                     <td class="nama_mhs" rowspan="2">`+val.nama+`</td>
                     <td rowspan="2">`+val.bagian.bagian+`</td>
                     <td style="width: 350px;" rowspan="2">`+val.detail_skripsi.judul+`</td>
                     <td>`+val.detail_skripsi.pembahas1.nama+`</td>
                     <td rowspan="2">
                        <button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
                     </td>
                  </tr>
                  <tr class="`+no+`">
                     <td>`+val.detail_skripsi.pembahas2.nama+`</td>
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
            console.log("hapus ya");
            var nim = $(this).parents("tr").find('input[type="hidden"]').val();
            var newOption = new Option(nim, nim, false, false);
            $('#pilih_nim').append(newOption).trigger('change');

            var tr_class = $(this).parents("tr").attr('class');
            $("tr."+tr_class).remove();
            data_count();
         });
      }

      function data_count() {
         var count = $("tbody tr").length;
         $(".data_count").text(count);
      }

	</script>
@endsection

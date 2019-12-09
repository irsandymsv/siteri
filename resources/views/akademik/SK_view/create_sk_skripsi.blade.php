@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
      Buat SK skripsi Baru
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

      .tbl_row{
         display: table;
         width: 100%;
         border-bottom: 0.1px solid lightgrey;
         margin-top: 10px;
         margin-bottom: 10px;
      }
	</style>
@endsection

@section('judul_header')
      SK Skripsi
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
   <form action="{{ route('akademik.skripsi.store') }}" method="post">
      @csrf
   	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
                  <h3 class="box-title">Buat SK Skripsi</h3>

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
               </div>

                  <div class="box-body">
                     <div class="row">
                        <div class="form-group col-md-4">
                           <label for="no_surat">No Surat</label><br>
                           <input type="text" name="no_surat" id="no_surat" value="{{ old('no_surat') }}">
                           <span id="format_nomor">/UN25.1.15/SP/{{ Carbon\Carbon::today()->year }}</span>

                           @error('no_surat')
                              <br>
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>

                        <div class="form-group col-md-4">
                           <label for="tgl_sk_pembimbing">Tanggal SK Pembimbing</label>
                           <input type="date" name="tgl_sk_pembimbing" id="tgl_sk_pembimbing" class="form-control" value="{{ old('tgl_sk_pembimbing') }}">

                           @error('tgl_sk_pembimbing')
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>

                        <div class="form-group col-md-4">
                           <label for="tgl_sk_penguji">Tanggal SK Penguji</label>
                           <input type="date" name="tgl_sk_penguji" id="tgl_sk_penguji" class="form-control" value="{{ old('tgl_sk_penguji') }}">

                           @error('tgl_sk_penguji')
                              <span class="invalid-feedback" role="alert" style="color: red;">
                                 <strong>{{ $message }}</strong>
                              </span>
                           @enderror
                        </div>
                     </div>

                  </div>

                  <div class="box-footer">
                     <div class="form-group">
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
                    @error('nim')
                        <span class="invalid-feedback" role="alert" style="color: red;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                     <div class="form-group">
                        <label for="nim">Pilih NIM Mahasiswa: </label>
                        <select class="form-control select2" id="pilih_nim">
                           <option value="">--Pilih NIM--</option>
                           @if (!empty($old_data))
                              @foreach ($mahasiswa as $item)
                                 @if (!in_array($item->nim, $old_data["nim"]))
                                 <option value="{{ $item->nim }}">{{ $item->nim }}</option>
                                 @endif
                              @endforeach
                           @else
                              @foreach ($mahasiswa as $item)
                                 <option value="{{ $item->nim }}">{{ $item->nim }}</option>
                              @endforeach
                           @endif
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
                              <th>Dosen Pembimbing</th>
                              <th>Dosen Penguji</th>
                              <th>Opsi</th>
                           </tr>
                        </thead>

                        <tbody>
                        @if ($old_mahasiswa != "")
                           @foreach($old_mahasiswa as $index => $val)
                           <tr id="{{ $index }}">
                              <td style="width: 60px;">
                                 {{ $val->nim }}
                                 <input type="hidden" name="nim[]" value="{{ $val->nim }}">
                              </td>
                              <td>{{ $val->nama }}</td>
                              <td>{{ $val->bagian->bagian }}</td>
                              <td style="width: 350px;" >{{ $val->skripsi->detail_skripsi[0]->judul }}</td>
                              @if ($val->skripsi->detail_skripsi[0]->surat_tugas[0]->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing")
                                 <td>
                                    <div class="tbl_row">
                                       1. {{ $val->skripsi->detail_skripsi[0]->surat_tugas[0]->dosen1->nama }}
                                    </div>
                                    <div class="tbl_row">
                                       2. {{ $val->skripsi->detail_skripsi[0]->surat_tugas[0]->dosen2->nama }}
                                    </div>
                                 </td>
                                 <td>
                                    <div class="tbl_row">
                                       1. {{ $val->skripsi->detail_skripsi[0]->surat_tugas[1]->dosen1->nama }}
                                    </div>
                                    <div class="tbl_row">
                                       2. {{ $val->skripsi->detail_skripsi[0]->surat_tugas[1]->dosen2->nama }}
                                    </div>
                                 </td>
                              @else
                                 <td>
                                    <div class="tbl_row">
                                       1. {{ $val->skripsi->detail_skripsi[0]->surat_tugas[1]->dosen1->nama }}
                                    </div>
                                    <div class="tbl_row">
                                       2. {{ $val->skripsi->detail_skripsi[0]->surat_tugas[1]->dosen2->nama }}
                                    </div>
                                 </td>
                                 <td>
                                    <div class="tbl_row">
                                       1. {{ $val->skripsi->detail_skripsi[0]->surat_tugas[0]->dosen1->nama }}
                                    </div>
                                    <div class="tbl_row">
                                       2. {{ $val->skripsi->detail_skripsi[0]->surat_tugas[0]->dosen2->nama }}
                                    </div>
                                 </td>
                              @endif
                              <td>
                                 <button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
                              </td>
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
                              <th>Dosen Pembimbing</th>
                              <th>Dosen Penguji</th>
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
   <script src="/js/btn_backTop.js"></script>
	<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
	<script type="text/javascript">
		$('.select2').select2();
		var mahasiswa = @json($mahasiswa);
      // console.log(mahasiswa[0].skripsi.detail_skripsi[0].surat_tugas[0].tipe_surat_tugas.tipe_surat);

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
         var kelas = $("#tbl-data tbody tr:last-child").attr('id');
         no = parseInt(kelas);
      }

      $("#pilih_nim").on("select2:select", function(event) {
         var nim = $(this).val();
         $.each(mahasiswa, function(index, val) {
            if(nim == val.nim){
               no+=1;
               if (val.skripsi.detail_skripsi[0].surat_tugas[0].tipe_surat_tugas.tipe_surat == "Surat Tugas Pembimbing") {
                  $("tbody").append(`
                     <tr id="`+no+`">
                        <td style="width: 60px;">
                           `+val.nim+`
                           <input type="hidden" name="nim[]" value="`+val.nim+`">
                        </td>
                        <td class="nama_mhs" >`+val.nama+`</td>
                        <td>`+val.bagian.bagian+`</td>
                        <td style="width: 350px;" >`+val.skripsi.detail_skripsi[0].judul+`</td>
                        <td>
                           <div class="tbl_row">1. `+val.skripsi.detail_skripsi[0].surat_tugas[0].dosen1.nama+`</div>
                           <div class="tbl_row">2. `+val.skripsi.detail_skripsi[0].surat_tugas[0].dosen2.nama+`</div>
                        </td>
                        <td>
                           <div class="tbl_row">1. `+val.skripsi.detail_skripsi[0].surat_tugas[1].dosen1.nama+`</div>
                           <div class="tbl_row">2. `+val.skripsi.detail_skripsi[0].surat_tugas[1].dosen2.nama+`</div>
                        </td>
                        <td>
                           <button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
                        </td>
                     </tr>
                  `);
               }
               else{
                  $("tbody").append(`
                     <tr id="`+no+`">
                        <td style="width: 60px;">
                           `+val.nim+`
                           <input type="hidden" name="nim[]" value="`+val.nim+`">
                        </td>
                        <td class="nama_mhs" >`+val.nama+`</td>
                        <td>`+val.bagian.bagian+`</td>
                        <td style="width: 350px;" >`+val.skripsi.detail_skripsi[0].judul+`</td>
                        <td>
                           <div class="tbl_row">1. `+val.skripsi.detail_skripsi[0].surat_tugas[1].dosen1.nama+`</div>
                           <div class="tbl_row">2. `+val.skripsi.detail_skripsi[0].surat_tugas[1].dosen2.nama+`</div>
                        </td>
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
               
               return false;
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

            var tr_class = $(this).parents("tr").remove();
            data_count();
         });
      }

      function data_count() {
         var count = $("tbody tr").length;
         $(".data_count").text(count);
      }

	</script>
@endsection

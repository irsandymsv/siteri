@extends('akademik.akademik_view')

@section('page_title')
	Buat SK Sempro
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
      table tbody tr td:first-child{
         width: 25%;
      }

	</style>	
@endsection

@section('judul_header')
	SK Sempro
@endsection

@section('content')
   <form action="{{ route('akademik.storeSempro') }}" method="post">
      @csrf
   	<div class="row">
      	<div class="col-xs-12">
      		<div class="box box-primary">
      			<div class="box-header">
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
                     <div id="btn_group">
                        <button type="submit" class="btn btn-primary">Submit</button>  
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
                           @foreach ($dosen as $item)
                           <option value="{{ $item->no_pegawai }}">{{ $item->no_pegawai }}</option>
                           @endforeach
                        </select>
                     </div>

                     <h5>Total Data = <span class="data_count"></span></h5>
                     <table id="tbl-data" class="table table-hover table-bordered">
                        <thead>
                           <tr>
                              <th>NIM</th>
                              <th>Nama Mahasiswa</th>
                              <th>Opsi</th>
                           </tr>
                        </thead>

                        <tbody>
                           {{-- <tr id="1">
                              <td>
                                 <select class="form-control select2" name="nim[]">
                                    <option value="">--Pilih NIM--</option>
                                    @foreach ($dosen as $item)
                                    <option value="{{ $item->no_pegawai }}">{{ $item->no_pegawai }}</option>
                                    @endforeach
                                 </select>
                              </td>
                              <td class="nama_mhs"></td>
                              <td>
                                 <button class="btn btn-danger" type="button" title="Hapus Data" name="delete_data"><i class="fa fa-trash"></i></button>
                              </td>
                           </tr> --}}
                        </tbody>

                        <tfoot>
                           <tr>
                              <th>NIM</th>
                              <th>Nama Mahasiswa</th>
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
		var dosen = @json($dosen);
      var selected_nim = [];

      $("#pilih_nim").on("select2:select", function(event) {
         var nim = $(this).val();
         var no = 0;
         $.each(dosen, function(index, val) {
             if(nim == val.no_pegawai){
               $("tbody").append(`
                  <tr id="`+(no+=1)+`">
                     <td>
                        `+val.no_pegawai+`
                        <input type="hidden" name="nim[]" value="`+val.no_pegawai+`">
                     </td>
                     <td class="nama_mhs">`+val.nama+`</td>
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

      function hapus_baris() {
         $('button[name="delete_data"]').off("click").click(function(event) {
            console.log("hapus ya");
            var nim = $(this).parents("tr").find('input[type="hidden"]').val();
            var newOption = new Option(nim, nim, false, false);
            $('#pilih_nim').append(newOption).trigger('change');

            $(this).parents("tr").remove();
            data_count();
         });
      }

      function data_count() {
         var count = $("tbody tr").length;
         $(".data_count").text(count);
      }
      
	</script>
@endsection
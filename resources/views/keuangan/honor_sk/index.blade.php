@extends('layouts.template')

@section('side_menu')
   @include('include.keuangan_menu')
@endsection

@section('page_title')
      Daftar Honorarium SK {{ ($tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}
@endsection

@section('css_link')
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('judul_header')
      Honorarium SK {{ ($tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}
@endsection

@section('content')     
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-success">
            <div class="box-header">
               <h3 class="box-title">Daftar Honorarium SK {{ ($tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}</h3>

               {{-- <div style="float: right;">
                  <a href="{{ ($tipe == "SK Skripsi"? route('keuangan.honor-skripsi.pilih-sk') : route('keuangan.honor-sempro.pilih-sk') ) }}" class="btn btn-primary"><i class="fa fa-plus"></i>  Buat Dartar Honor</a>
               </div> --}}
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  <table id="data_table" class="table table-bordered table-hovered">
                     <thead>
                        <tr>
                           <th>No</th>
                           @if($tipe == "SK Skripsi")
                              <th>SK Pembimbing Skripsi</th>
                              <th>SK Penguji Skripsi</th>
                           @else
                              <th>SK Pembahas Sempro</th>
                           @endif
                           <th>Tanggal SK</th>
                           <th>Status</th>
                           {{-- <th>Verif BPP</th>
                           <th>Verif KTU</th>
                           <th>Verif Wadek 2</th> --}}
                           <th>Pilihan</th>
                        </tr>
                     </thead>

                     <tbody>
                        @foreach ($sk as $item)
                           <tr id="sk_{{ $item->id }}">
                              <td>{{ $loop->index + 1 }}</td>
                              @if($tipe == "SK Skripsi")
                                 <td>{{ $item->no_surat_pembimbing }}//UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
                                 <td>{{ $item->no_surat_penguji }}//UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
                              @else
                                 <td>{{ $item->no_surat }}//UN 25.1.15/SP/{{Carbon\Carbon::parse($item->created_at)->year}}</td>
                              @endif
                              <td>
                                 {{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
                              </td>
                              <td>
                                 @if (is_null($item->sk_honor))
                                    Belum Ada Honor
                                 @else
                                    {{ $item->sk_honor->status_sk_honor->status }}
                                 @endif
                              </td>
                              {{-- <td>
                                 @if (is_null($item->sk_honor))
                                    -
                                 @else
                                    @if($item->sk_honor->verif_bpp == 0) 
                                       Belum Diverifikasi
                                    @elseif($item->sk_honor->verif_bpp == 2) 
                                       <label class="label bg-red">Butuh Revisi</label> 
                                    @else
                                       <label class="label bg-green">Sudah Diverifikasi</label>
                                    @endif
                                 @endif
                              </td>
                              <td>
                                 @if (is_null($item->sk_honor))
                                    -
                                 @else
                                    @if($item->sk_honor->verif_ktu == 0) 
                                       Belum Diverifikasi
                                    @elseif($item->sk_honor->verif_ktu == 2) 
                                       <label class="label bg-red">Butuh Revisi</label> 
                                    @else
                                       <label class="label bg-green">Sudah Diverifikasi</label>
                                    @endif
                                 @endif
                              </td>
                              <td>
                                 @if (is_null($item->sk_honor))
                                    -
                                 @else
                                    @if($item->sk_honor->verif_wadek2 == 0) 
                                       Belum Diverifikasi
                                    @elseif($item->sk_honor->verif_wadek2 == 2) 
                                       <label class="label bg-red">Butuh Revisi</label> 
                                    @else
                                       <label class="label bg-green">Sudah Diverifikasi</label>
                                    @endif
                                 @endif
                              </td> --}}
                              
                              <td>
                                 @if ($tipe == "SK Skripsi")
                                    @if (is_null($item->sk_honor))
                                       <a href="{{ route('keuangan.honor-skripsi.store', $item->id) }}" class="btn btn-success">Generate</a>
                                    @else
                                       <a href="{{ route('keuangan.honor-skripsi.show', $item->sk_honor->id) }}" class="btn btn-primary">Lihat</a>
                                       {{-- <button class="btn btn-danger" name="delete_honor" id="{{ $item->id }}" data-toggle="modal" data-target="#modal-delete">Hapus</button> --}}
                                    @endif
                                 @else
                                    @if (is_null($item->sk_honor))
                                       <a href="{{ route('keuangan.honor-sempro.store', $item->no_surat) }}" class="btn btn-success">Generate</a>
                                    @else
                                       <a href="{{ route('keuangan.honor-sempro.show', $item->sk_honor->id) }}" class="btn btn-primary">Lihat</a>
                                       {{-- <button class="btn btn-danger" name="delete_honor" id="{{ $item->id }}" data-toggle="modal" data-target="#modal-delete">Hapus</button> --}}
                                    @endif
                                 @endif
                              </td>

                              {{-- <td>
                                 @if ($tipe == "SK Skripsi")
                                    <a href="{{ route('keuangan.honor-skripsi.show', $item->sk_honor->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                    @if ($item->verif_bpp != 1)
                                       <a href="{{ route('keuangan.honor-skripsi.edit', $item->sk_honor->id) }}" class="btn btn-warning" title="Ubah Daftar Honor"><i class="fa fa-edit"></i></a>
                                    @endif
                                 @else
                                    <a href="{{ route('keuangan.honor-sempro.show', $item->sk_honor->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                    @if ($item->verif_bpp != 1)
                                       <a href="{{ route('keuangan.honor-sempro.edit', $item->sk_honor->id) }}" class="btn btn-warning" title="Ubah Daftar Honor"><i class="fa fa-edit"></i></a>
                                    @endif
                                 @endif

                                 @if ($item->verif_dekan != 1)
                                    <a href="#" class="btn btn-danger" name="delete_honor" id="{{ $item->id }}" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash" title="Hapus Daftar Honor"></i></a>
                                 @endif
                                 @if ($item->verif_dekan == 1)
                                    <a href="{{ route('keuangan.honor-skripsi.cetak', $item->id) }}" class="btn btn-info" title="Cetak Daftar Honor"><i class="fa fa-print"></i></a>
                                 @endif
                              </td> --}}
                           </tr>
                        @endforeach
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
@endsection

@section('script')
   <script type="text/javascript">
      var nomor_kolom = 0;
      @if ($tipe == "SK Skripsi")
         nomor_kolom = 4;
         $(`<tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
         </tr>`).clone(true).appendTo( '#data_table thead' );
      @else
         nomor_kolom = 3;
         $(`<tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
         </tr>`).clone(true).appendTo( '#data_table thead' );
      @endif

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

      //    @if($tipe == "SK Skripsi")
      //    var url_del = "link hapus honor sk Skripsi" + '/' + id_sk;             
      //    @else
      //    var url_del = "link hapus honor sk Skripsi" + '/' + id_sk;
      //    @endif
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
@endsection  
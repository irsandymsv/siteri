@extends('layouts.template')

@section('side_menu')
   @include('include.kemahasiswaan_menu')
@endsection

@section('page_title')
      Daftar Mahasiswa
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
@endsection

@section('judul_header')
      Daftar Mahasiswa
@endsection

@section('content')
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-success">
            <div class="box-header">
               <h3 class="box-title">Daftar Daftar Mahasiswa</h3>

               <div style="float: right;">
                  <a href="{{ route('kemahasiswaan.mahasiswa.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Baru</a>
              </div>
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  <table id="data_table" class="table table-bordered table-hovered">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>NIM</th>
                           <th>Nama</th>
                           <th>Program Studi</th>
                           <th>Angkatan</th>
                           <th>Opsi</th>
                        </tr>
                     </thead>

                     <tbody>
                        @foreach ($mahasiswa as $item)
                           <tr>
                              <td>{{ $loop->index+1 }}</td>
                              <td>{{ $item->nim }}</td>
                              <td>{{ $item->nama }}</td>
                              <td>{{ $item->prodi->nama }}</td>
                              <td>
                                 @php
                                    $angkatan = substr($item->nim, 0, 2);
                                 @endphp
                                 {{ '20'.$angkatan }}
                              </td>
                              <td>
                                 <a href="{{ route('kemahasiswaan.mahasiswa.show', $item->nim) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                 <a href="{{ route('kemahasiswaan.mahasiswa.edit', $item->nim) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@section('script')
   <script type="text/javascript">
      $(`<tr>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
         <th></th>
      </tr>`).clone(true).appendTo( '#data_table thead' );

      $('#data_table').DataTable({
         order: [],
         orderCellsTop: true,
         initComplete: function () {
            this.api().columns([3,4]).every( function () {
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
   </script>
@endsection

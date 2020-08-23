@extends('layouts.template')

@section('side_menu')
  {{-- @if (Auth::user()->jabatan->jabatan == "Dekan")
    @include('include.dekan_menu')
  @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 1")
    @include('include.wadek1_menu')
  @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 2")
    @include('include.wadek2_menu')
  @elseif(Auth::user()->jabatan->jabatan == "Dosen")
    @include('include.dosen_menu')
  @endif --}}

  @include('include.'.$jabatan_user.'_menu')
@endsection

@section('page_title','Surat Tugas')
@section('judul_header','Surat Tugas')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Surat Tugas</h3>
    </div>

    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="data_table" class="table table-bordered table-hover dataTable" >
            <thead>
              <tr>
                <th>
                  <center>No</center>
                </th>
                <th>
                  <center>Jenis Surat</center>
                </th>
                <th>
                  <center>Tanggal</center>
                </th>
                <th>
                  <center>Keterangan</center>
                </th>
                <th>
                  <center>Status</center>
                </th>
                <th>
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>

            <tbody>
              @foreach ($tugas_dosen as $index =>$td)

              <tr role="row">
                <td>{{$index+1}}</td>
                <td>
                  @foreach ($jenis as $item)
                      @if ($item->id == $td->surat_tugas->jenis_surat)
                          {{$item->jenis}}
                      @endif
                  @endforeach</td>
                <td>{{ \Carbon\Carbon::parse($td->surat_tugas->started_at)->format('d/m/Y')}} -
                  {{ \Carbon\Carbon::parse($td->surat_tugas->end_at)->format('d/m/Y')}}</td>
                <td>{{$td->surat_tugas->keterangan}}</td>
                <td>{{$td->surat_tugas->status_sk->status}}</td>
                <td>
                  <a href="{{route($jabatan_user.'.surat.preview', $td->surat_tugas->id)}}" class="btn btn-primary btn-sm" style="margin-left: 17px;">Lihat</a>

                </td>
              </tr>

              @endforeach
            
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</section>
<!-- /.content -->
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
      this.api().columns([1,4]).every( function () {
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
          });

        column.data().unique().sort().each( function ( d, j ) {
          select.append( '<option value="'+d+'">'+d+'</option>' )
        });
      });
    }
  });
</script>
@endsection
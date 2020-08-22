@extends('layouts.template')

@section('side_menu')
  @include('include.kepegawaian_menu')
@endsection

@section('page_title','Surat Tugas')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Daftar Surat Tugas</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="data_table" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr>
                <th>
                  <center>No</center>
                </th>
                <th>
                  <center>Jenis Surat</center>
                </th>
                <th>
                  <center>Nama yang Bertugas</center>
                </th>
                <th>
                  <center>Tanggal</center>
                </th>
                <th>
                  <center>Keterangan</center>
                </th>
                <th>
                  <center class="status_surat">Status</center>
                </th>
                <th>
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($memu as $index =>$sk)
              <tr role="row">
                <td>{{$index+1}}</td>
                <td>{{$sk->jenis_sk->jenis}}</td>
                <td>
                  @foreach ($dosen_sk as $dosen)
                  @if ($dosen->id_sk == $sk->id)
                  <p>{{$dosen->user['nama']}}</p>
                  @endif
                  @endforeach
                  @foreach ($pemateri as $pematerii)
                      @if ($pematerii['id_sk'] == $sk->id)
                      <p>{{$pematerii['nama']}}</p>   
                      @endif
                  @endforeach
                </td>
                <td>{{ \Carbon\Carbon::parse($sk->started_at)->format('d/m/Y')}} -
                  {{ \Carbon\Carbon::parse($sk->end_at)->format('d/m/Y')}}</td>
                <td>{{$sk->keterangan}}</td>
                <td>{{$sk->status_sk->status}}</td>
                <td>
                  @if ($sk->status == 2)
                    <a href="{{route('kepegawaian.surat.create', $sk->id)}}" class="btn btn-primary btn-sm" style="margin-left: 17px;" title="Buat Surat Tugas dari Memo Ini">Buat</a>
                  @elseif($sk->status > 2)
                    <a href="{{route('kepegawaian.surat.preview', $sk->id)}}" class="btn btn-success btn-sm" style="margin-left: 17px;" title="Lihat Detail Surat Tugas">Lihat</a>
                    @if($sk->status == 4 || $sk->status == 6)
                      <a href="{{route('kepegawaian.surat.edit', $sk->id)}}" class="btn btn-warning btn-sm" style="margin-left: 17px;" title="Ubah Surat Tugas">Perbaiki</a>
                    @endif
                  @endif

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
  $(function(){
    $(".status_surat").text(function () {
      $(this).text().replace('Memu', 'Memo');
    });
  });

  $(`<tr>
     <th></th>
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
      this.api().columns([1,5]).every( function () {
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
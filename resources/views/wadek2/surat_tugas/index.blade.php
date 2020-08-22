@extends('wadek2.wadek2_view')
@section('page_title','Surat Tugas')
@section('judul_header','Surat Tugas Kepegawaian')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h4>Daftar Surat Tugas Kepegawaian</h4>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="table_data1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr>
                <th>
                  <center>No</center>
                </th>
                <th >
                  <center>Jenis Surat</center>
                </th>
                <th >
                  <center>Nama Dosen</center>
                </th>
                <th >
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
              @foreach ($surat as $index =>$sk)
              <tr role="row">
                <td>{{$index+1}}</td>
                <td>{{$sk->jenis_sk['jenis']}}</td>
                <td>@foreach ($dosen_sk as $dosen)
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
                <td>
                  {{ $sk->status_sk->status }}
                </td>
                <td>
                  @if ($sk->status >= 7)
                    <a href="{{route('wadek2.surat.preview', $sk->id)}}" class="btn btn-primary" style="margin: 3px 0 0 17px;"><i class="fa fa-eye"></i></a>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- <form method="POST" action="">
        @csrf
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Search</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputmaksud" class="col-sm-3 control-label">Surat Tugas</label>
                  <div class="col-sm-9">
                    <input value="" type="text" class="form-control" name="maksud" id="inputmaksud"
                      placeholder="Cari Surat Tugas">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">
              <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
              Cari
            </button>
          </div>
        </div>
      </form> --}}
    </div>
  </div>
</section>
<!-- /.content -->
@endsection
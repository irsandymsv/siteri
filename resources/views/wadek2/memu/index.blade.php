@extends('wadek2.wadek2_view')
@section('page_title','Daftar Memo')
@section('judul_header','Daftar Memo')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <a href="{{route('wadek2.memu.create')}}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Memo</a>
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
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>

            <tbody>
              @foreach ($memu as $index =>$sk)
              <tr role="row">
                <td>{{$index+1}}</td>
                <td>{{$sk->jenis_sk['jenis']}}</td>
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
                <td>
                  @if ($sk->status == 1)
                  <form id="form" class="row" method="POST" action="{{route('wadek2.memu.delete', $sk->id)}}"
                      onsubmit="return confirm('Apakah anda yakin ingin menghapus memo ini ?')">
                      @method('DELETE')
                      @csrf
                    <a href="{{route('wadek2.memu.edit', $sk->id)}}" class="btn btn-primary btn-sm" style="margin-left: 17px;">Edit</a>
                      <button type="submit" id="deleteBtn" class="btn btn-danger btn-sm" >Delete</button>
                  </form>
                  @else
                  -
                  @endif
                  {{-- <a href=""><button class="btn btn-danger btn-sm">Delete</button></a> --}}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
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
      </form>
 --}}
      {{-- <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            
          </div>
        </div>
      </div> --}}

      {{-- <div class="row">

        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

          </div>
        </div>
      </div> --}}
</section>
<!-- /.content -->
@endsection
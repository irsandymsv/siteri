@extends('dosen.dosen_view')
@section('page_title','Surat Tugas')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12"></div>
      </div>

      <form method="POST" action="">
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

      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
              aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th width="5" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>No</center>
                  </th>
                  <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Jenis Surat</center>
                  </th>
                  <th width="25%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Nama yang Bertugas</center>
                  </th>
                  <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Tanggal</center>
                  </th>
                  <th width="30%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Keterangan</center>
                  </th>
                  <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Aksi</center>
                  </th>
                </tr>
                @foreach ($surat_tugas as $index =>$sk)

                <tr role="row">
                  <td>{{$index+1}}</td>
                  <td>
                    @foreach ($jenis as $item)
                        @if ($item->id == $sk->jenis_surat)
                            {{$item->jenis}}
                        @endif
                    @endforeach</td>
                  <td>
                    {{Auth::user()->nama}}
                  </td>
                  <td>{{ \Carbon\Carbon::parse($sk->started_at)->format('d/m/Y')}} -
                    {{ \Carbon\Carbon::parse($sk->end_at)->format('d/m/Y')}}</td>
                  <td>{{$sk->keterangan}}</td>
                  <td>
                  
                    <a href="{{route('dosen.dosen_upload_preview', $sk->id_spd)}}" class="btn btn-primary btn-sm" style="margin-left: 17px;">Upload</a>
                   
                  </td>
                </tr>

                @endforeach
              </thead>
              <tbody>
                </td>
                </tr>
                </td>
                </tr>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">

          <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

            </div>
          </div>
        </div>

      </div>
</section>


<section class="content">
  <div class="box">
    <div class="box-header">
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12"></div>
      </div>

      <form method="POST" action="">
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

      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
              aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th width="5" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>No</center>
                  </th>
                  <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Jenis Surat</center>
                  </th>
                  <th width="25%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Nama yang Bertugas</center>
                  </th>
                  <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Tanggal</center>
                  </th>
                  <th width="30%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Keterangan</center>
                  </th>
                  <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                    aria-label="Name: activate to sort column ascending">
                    <center>Aksi</center>
                  </th>
                </tr>
                @foreach ($surat_tugas2 as $index =>$sk2)

                <tr role="row">
                  <td>{{$index+1}}</td>
                  <td>
                    @foreach ($jenis as $item)
                        @if ($item->id == $sk2->jenis_surat)
                            {{$item->jenis}}
                        @endif
                    @endforeach</td>
                  <td>
                    {{Auth::user()->nama}}
                  </td>
                  <td>{{ \Carbon\Carbon::parse($sk2->started_at)->format('d/m/Y')}} -
                    {{ \Carbon\Carbon::parse($sk2->end_at)->format('d/m/Y')}}</td>
                  <td>{{$sk2->keterangan}}</td>
                  <td>

                    <a href="{{route('dosen.edit.upload', $sk2->id_spd)}}" class="btn btn-primary btn-sm" style="margin-left: 17px;">Edit</a>
                  </td>
                </tr>

                @endforeach
              </thead>
              <tbody>
                </td>
                </tr>
                </td>
                </tr>
                </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="row">

          <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">

            </div>
          </div>
        </div>

      </div>
</section>
<!-- /.content -->
@endsection
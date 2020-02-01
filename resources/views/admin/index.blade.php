@extends('admin.admin_view')
@section('page_title','Admin Dashboard')
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
          <input value="" type="text" class="form-control" name="maksud" id="inputmaksud" placeholder="Cari Surat Tugas">
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

  <a href="{{route('akademik.st.create')}}" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Surat Tugas Baru</a>
</div>
</div>    </form>

  <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
    <div class="row">
      <div class="col-sm-12">
        <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
          <thead>
            <tr role="row">
              <th width = "5" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending"><center>No</center></th>
              <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending"><center>Jenis Surat Tugas</center></th>
              <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending"><center>Nama Dosen</center></th>
              <th width = "13%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending"><center>NIP</center></th>
              <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending"><center>Deskripsi Kegiatan</center></th>
              <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending"><center>Aksi</center></th>
            </tr>
            <tr role="row">
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
            </tr>
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

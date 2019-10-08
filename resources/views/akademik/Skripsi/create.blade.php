@extends('akademik.akademik_view')

@section('judul_header')
	Buat SK Skripsi
@endsection

@section('content')
	<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Hover Data Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th contenteditable>Nama Mahasiswa</th>
                  <th>Nim</th>
                  <th>Jurusan</th>
                  <th>Judul</th>
                  <th>Dosen Pembimbing I/II</th>
                  <th>Dosen Penguji I/II</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><span id="nama_mhs-1" contenteditable></span></td>
                  <td><span id="nim-1" contenteditable></span></td>
                  <td></td>
                  <td><span id="judul" contenteditable></span></td>
                  <td></td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                  <th>Nama Mahasiswa</th>
                  <th>Nim</th>
                  <th>Jurusan</th>
                  <th>Judul</th>
                  <th>Dosen Pembimbing I</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-xs-9"></div>
        <div class="col-xs-3">
            <div class="text-align-right">
                <a class="btn btn-primary">Tambah Mahasiswa</a>
                <a class="btn btn-primary">Buat SK Skripsi</a>
            </div>
        </div>
        <!-- /.col -->
      </div>
@endsection
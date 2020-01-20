@extends('layouts.template')

@section('side_menu')
   @if (Auth::user()->jabatan->jabatan == "BPP")
    @include('include.bpp_menu')
  @elseif(Auth::user()->jabatan->jabatan == "Penata Dokumen Keuangan")
    @include('include.keuangan_menu')
  @endif
@endsection

@section('page_title')
	Daftar Besaran Honor
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('judul_header')
	Daftar Besaran Honor
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-success">
   			<div class="box-header">
              <h3 class="box-title">Daftar Besaran Honor</h3>

              <div style="float: right;">
            	<a href="{{ route('honor.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Besaran Honor</a>
              </div>

              <br><br>
              @if (session('success'))
              <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> Sukses</h4>
                  {{session('success')}}
              </div>

              @php
              Session::forget('success');
              @endphp

              @endif
            </div>

            <div class="box-body">
            	<div class="table-responsive">
            		<table id="table_data1" class="table table-bordered table-hovered">
	            		<thead>
		            		<tr>
		            			<th>No</th>
                           <th>Nama Honor</th>
                           <th>Besaran</th>
		            			<th>Pilihan</th>
		            		</tr>
		            	</thead>
		            	<tbody>
		            		@foreach ($honor as $item)
                           <tr>
                              <td>{{ $loop->index+1 }}</td>
                              <td>{{ $item->nama_honor }}</td>
                              <td>Rp &ensp; {{ number_format($item->histori_besaran_honor[0]->jumlah_honor, 0, ",", ".") }}</td>
                              <td>
                                 <a href="{{ route('honor.edit', $item->id) }}" title="Ubah Data" class="btn btn-warning"><i class="fa fa-edit"></i></a>
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
            <p>Apakah anda yakin ingin menghapus surat template ini?</p>
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

	</script>
@endsection

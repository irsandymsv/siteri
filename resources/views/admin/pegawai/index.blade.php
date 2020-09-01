@extends('layouts.template')

@section('side_menu')
    @include('include.'.$jabatan_user.'_menu')
@endsection

@if ($jabatan_user == "admin")
	@section('page_title','Admin Dashboard')
@elseif($jabatan_user == "kepegawaian")
	@section('page_title','Data Pegawai')
@endif

@section('judul_header', 'Data Pegawai')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
        	<h3 class="box-title">Data Pegawai</h3>
          <a class="btn btn-primary pull-right" href="{{route($jabatan_user.'.pegawai.create')}}">Tambah Pegawai</a>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12 table-responsive">

            	@if (session()->has('success'))
          	    <div class="alert alert-success alert-block">
          	      <button type="button" class="close" data-dismiss="alert">x</button>
          	        {{ session()->get('success')}}
          	    </div>
            	@endif
            	
            	<table id="table_data1" class="table table-bordered table-hover dataTable" >
          	    <thead>
        	        <tr>
      	            <th>
      	                <center>No</center>
      	            </th>
      	            <th>
      	                <center>Nama Pegawai</center>
      	            </th>
      	            <th>
      	                <center>NIP</center>
      	            </th>
      	            <th>
      	                <center>Jabatan Fungsional</center>
      	            </th>
      	            <th>
      	                <center>Jabatan</center>
      	            </th>
      	            <th>
      	                <center>Pangkat</center>
      	            </th>
      	            <th>
      	                <center>Golongan</center>
      	            </th>
      	            <th>
      	                <center>Aksi</center>
      	            </th>
        	        </tr>
          	    </thead>
          	    <tbody>
        	        @foreach ($data as $index => $user)
        	        <tr role="row" class="odd">
      	            <td class="sorting_1">{{$index + 1}}</td>
      	            <td class="hidden-xs">{{$user->nama}}</td>
      	            <td class="hidden-xs">{{$user->no_pegawai}}</td>
      	            <td class="hidden-xs">{{$user->fungsionalnya['jab_fungsional']}}</td>
      	            <td class="hidden-xs">{{$user->jabatannya['jabatan']}}</td>
      	            <td class="hidden-xs">{{$user->pangkatnya['pangkat']}}</td>
      	            <td class="hidden-xs">{{$user->golongannya['golongan']}}</td>
      	            <td style="display: inline-block">
      	              <form class="row" method="POST" action="{{route($jabatan_user.'.pegawai.destroy', $user->username)}}" onsubmit="return confirm('Apakah anda yakin menghapus user ini?')">
  	                    @method('DELETE')
  	                    @csrf
  	                    <a href="{{route($jabatan_user.'.pegawai.edit', $user->username)}}" type="button" class="btn btn-warning btn-margin btn-sm" style="margin-bottom: 3px;">
  	                        Edit
  	                    </a>
  	                    <button type="submit" class="btn btn-danger btn-margin btn-sm"
  	                        style="margin-bottom: 3px;">
  	                        Hapus
  	                    </button>
      	              </form>

    	                <form id="resetpass{{$index}}" class="row" method="POST" action="{{route($jabatan_user.'.pegawai.reset', $user->username)}}" onsubmit="return confirm('Apakah anda yakin reset password user ini?')">
	                        @method('DELETE')
	                        @csrf

	                        <button type="submit" id="resetsubmit{{$index}}" class="btn btn-info btn-margin btn-sm btn-reset" name="{{ $index }}">
	                          Reset
	                        </button>
    	                </form>

      	            </td>
        	        </tr>
      	          @endforeach
          	    </tbody>
            	</table>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
    </div>
</section>
<!-- /.content -->
@endsection
@section('script')

<script type="text/javascript">

$(document).ready(function() {
		
	

		// $(".btn-reset").click(function(event) {
		// 	id = $(this).attr('name');
		// 	console.log('id: '+ id);
		// 	$('#resetpass'+id).submit();
		// });

});
</script>
@endsection

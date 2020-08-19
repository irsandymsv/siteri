@extends('kepegawaian.kepegawaian_view')
@section('page_title','Ganti Password')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
    </div>

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold;: 
      }
      .siteri {
         width: 100%;
      }
	</style>	
@endsection

	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Ganti Password</h3>
            </div>
            
            <div class="box-body">
			      <div class="row">
			        	<div class="col-sm-12">
			        		
			        	@if(session('success'))
			        	<div class="alert alert-success">
			        	  {{ session('success') }}
			        	</div> 
			        	@endif
	                <!-- /.login-logo -->
	               <div class="card">
	                  <div class="col-md-4">
	                     <form action="{{route('simpan.password', Auth::user()->no_pegawai)}}" method="POST">
	                        @method('put')
	                        @csrf
		                    <div class="form-group">
			                    <label for="password"> Password Baru </label>
			                    <input style="margin-bottom:8px;" type="password" name="password" class="form-control" placeholder="Masukan Password Baru">

			                    <label for="password"> Konfirmasi Password Baru </label>
			                    <input type="password" name="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password Baru">
		                    </div>
		                    <button type="submit" class="btn btn-primary">Simpan</button>
		                    <a href="{{route('kepegawaian.surat.index')}}" class="btn btn-default">Kembali</a>
		                  </form>
	              		</div>
			        	</div>
			      </div>
            </div>
   		</div>
   	</div>
	</div>

</section>
<!-- /.content -->
@endsection
@extends('akademik.akademik_view')

@section('page_title')
	Detail Surat Tugas Pembimbing
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.table-responsive{
         width: 80%;
         margin: auto;
      }

      table tr td:first-child{
         width: 35%;
         font-weight: bold;: 
      }
	</style>	
@endsection

@section('judul_header')
	Surat Tugas Pembimbing
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
              <h3 class="box-title">Detail Surat Tugas Pembimbing</h3>
            </div>

            <div class="box-body">
         		<div class="table-responsive">
                  <table class="table table-striped table-bordered">
                     <tr>
                        <td>Tanggal</td>   
                        <td></td>
                     </tr>

                     <tr>
                        <td>No Surat</td>
                        <td></td>
                     </tr>

                     <tr>
                        <td>Pembimbing Utama</td>
                        <td>
                           <p>nama</p>
                           <p>NIP</p>
                        </td>
                     </tr>

                     <tr>
                        <td>Pembimbing Pendamping</td>
                        <td>
                           <p>nama</p>
                           <p>NIP</p>
                        </td>
                     </tr>

                     <tr>
                        <td>Nama Mahasiswa</td>
                        <td></td>
                     </tr>

                     <tr>
                        <td>NIM</td>
                        <td></td>
                     </tr>

                     <tr>
                        <td>Judul</td>
                        <td>
                           Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                           tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        </td>
                     </tr>
                  </table>    
               </div>
            </div>

            <div class="box-footer">
               <a href="#" class="btn btn-warning">Ubah</a> &ensp;
            </div>
            
   		</div>
   	</div>
	</div>
@endsection

@section('script')

@endsection
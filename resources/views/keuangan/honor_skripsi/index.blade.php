@extends('keuangan.keuangan_view')

@section('page_title')
      Daftar Honorarium Skripsi
@endsection

@section('judul_header')
      Honorarium Skripsi
@endsection

@section('content')     
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-success">
            <div class="box-header">
               <h3 class="box-title">Daftar Honorarium Skripsi</h3>

               <div style="float: right;">
                  <a href="{{route('keuangan.honor-skripsi.pilih-sk')}}" class="btn btn-primary"><i class="fa fa-plus"></i>  Buat Dartar Honor</a>
               </div>
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  <table id="dataTable" class="table table-bordered table-hovered">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Tanggal Dibuat</th>
                           <th>Status</th>
                           <th>Verif BPP</th>
                           <th>Verif KTU</th>
                           <th>Verif Wadek 2</th>
                           <th>Verif Dekan</th>
                           <th>Opsi</th>
                        </tr>
                     </thead>

                     <tbody>
                           
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection      
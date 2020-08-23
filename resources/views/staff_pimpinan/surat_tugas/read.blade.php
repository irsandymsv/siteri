@extends('layouts.template')

@section('side_menu')
	@include('include.staffpim_menu')
@endsection

@section('page_title','Surat Tugas Kepegawaian')
@section('judul_header','Surat Tugas Kepegawaian')

@section('content')
<div class="row">
  <div class="col col-xs-12">
    <div class="box box-primary">
    	<div class="box-header with-border">
    		<h3 class="box-title">Daftar Surat Tugas Kepegawaian</h3>
     	</div>

     	<div class="box-body">
     		<div class="table-responsive">
     			@if (session()->has('success'))
     			  <div class="alert alert-success alert-block">
     			    <button type="button" class="close" data-dismiss="alert">x</button>
     			      {{ session()->get('success')}}
     			  </div>
     			@endif
     			
     			<table id="table_data1" class="table table-bordered table-hover dataTable">
     			  <thead>
     			    <tr>
     			      <th>
     			        <center>No</center>
     			      </th>
     			      <th>
     			        <center>Jenis Surat</center>
     			      </th>
     			      <th>
     			        <center>Nama Dosen</center>
     			      </th>
     			      <th>
     			        <center>Tanggal</center>
     			      </th>
     			      <th>
     			        <center>Keterangan</center>
     			      </th>
     			      <th>
     			        <center>Status SK</center>
     			      </th>
     			      <th>
     			        <center>Aksi</center>
     			      </th>
     			    </tr>
     			  </thead>

     			  <tbody>
     			    @foreach ($surat_tugas as $index => $sk)
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
     			        @endforeach</td>
     			      <td>{{ \Carbon\Carbon::parse($sk->started_at)->format('d/m/Y')}} -
     			        {{ \Carbon\Carbon::parse($sk->end_at)->format('d/m/Y')}}</td>
     			      <td>{{$sk->keterangan}}</td>
     			      <td>
     			       {{$sk->status_sk['status']}}
     			      </td>
     			      <td>
     			        <a href="{{route('staffpim.sp.preview', $sk->id)}}" class="btn btn-primary" style="margin: 3px 0 0 17px;"><i class="fa fa-eye"></i></a>
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
<!-- /.content -->
@endsection
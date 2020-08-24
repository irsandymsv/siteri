@extends('layouts.template')

@section('side_menu')
@include('include.kepegawaian_menu')
@endsection

@section('page_title')
	Dashboard
@endsection

@section('judul_header')
	Dashboard
@endsection

@section('content')
<div class="row">
	<div class="col col-md-12">
		<div class="box box-primary">
		  <div class="box-header with-border">
		  	<h3 class="box-title">Memo Baru dari Wadek 2</h3>

		  </div>
		  <!-- /.box-header -->
		  <div class="box-body">
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
	    	      <td>{{$sk->jenis_sk->jenis}}</td>
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
	    	        <a href="{{route('kepegawaian.surat.create', $sk->id)}}" class="btn btn-primary btn-sm" title="Buat Surat Tugas dari Memo Ini">Buat</a>
	    	      </td>
	    	    </tr>
	    	    @endforeach
	    	  </tbody>
	    	</table>
	    </div>
	  </div>
	</div>
</div>
@endsection
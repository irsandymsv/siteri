@extends('layouts.template')

@section('side_menu')
   @include('include.ktu_menu')
@endsection

@section('page_title','Surat Tugas')
@section('judul_header','Surat Tugas Kepegawaian')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
    	<h3 class="box-title">Daftar Surat Tugas</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
        	<table id="data_table" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
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
        	        <center>Status</center>
        	      </th>
        	      <th>
        	        <center>Aksi</center>
        	      </th>
        	    </tr>
        	  </thead>
        	  <tbody>
        	    @foreach ($surat as $index =>$sk)
        	    <tr role="row">
        	      <td>{{$index+1}}</td>
        	      <td>{{$sk->jenis_sk->jenis}}</td>
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
        	      <td>{{$sk->status_sk->status}}</td>
        	      <td>
        	        <a href="{{route('ktu.surat.preview', $sk->id)}}" class="btn btn-primary" style="margin: 3px 0 0 17px;"><i class="fa fa-eye"></i></a>
        	      </td>
        	    </tr>
        	    @endforeach
        	  </tbody>
        	</table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection

@section('script')
<script type="text/javascript">
	$(`<tr>
	   <th></th>
	   <th></th>
	   <th></th>
	   <th></th>
	   <th></th>
	   <th></th>
	   <th></th>
	</tr>`).clone(true).appendTo( '#data_table thead' );

	$('#data_table').DataTable({
	  order: [],
	  orderCellsTop: true,
	  initComplete: function () {
	    this.api().columns([1,5]).every( function () {
	      var column = this;
	      var select = $('<select><option value="">- Semua -</option></select>')
	        .appendTo( $("#data_table thead tr:eq(1) th").eq(column.index()).empty() )
	        .on( 'change', function () {
	          var val = $.fn.dataTable.util.escapeRegex(
	            $(this).val()
	          );

	          column
	            .search( val ? '^'+val+'$' : '', true, false )
	            .draw();
	        });

	      column.data().unique().sort().each( function ( d, j ) {
	        select.append( '<option value="'+d+'">'+d+'</option>' )
	      });
	    });
	  }
	});
</script>
@endsection
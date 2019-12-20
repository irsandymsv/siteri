@extends('layouts.template')

@section('side_menu')
   @include('include.dosen_menu')
@endsection

@section('page_title')
	Pembimbing Skripsi
@endsection

@section('judul_header')
	Pembimbing Skripsi
@endsection

@section('content')
	<div class="row">
		<div class="col col-xs-12">
			<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              	<li class="active"><a href="#tab_1" data-toggle="tab">Pembimbing Utama</a></li>
              	<li><a href="#tab_2" data-toggle="tab">Pembimbing pendamping</a></li>
              	
            </ul>
            <div class="tab-content">
            	<div class="tab-pane active" id="tab_1">
            		<p>Daftar Mahasiswa yang Anda Bimbing Sebagai Pembimbing Utama Skripsi</p>

               	<table id="tabel_1" class="table table-bordered table-hovered">
               		<thead>
	               		<tr>
	               			<th>No</th>
	               			<th>NIM</th>
	               			<th>Nama</th>
	               			<th>Prodi</th>
	               			<th>Status</th>
	               			<th>Opsi</th>
	               		</tr>
	               	</thead>
               		<tbody>
            				@foreach ($sutgas_pembimbing_1 as $item)
               				<tr>
               					<td>{{ $loop->index+1 }}</td>
               					<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
               					<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->status_skripsi->status }}</td>
	   			      			<td>
	   			      				<a href="{{ route('dosen.pembimbing-skripsi.show', $item->detail_skripsi->skripsi->nim) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
	   			      			</td>
               				</tr>
            				@endforeach
               		</tbody>
               	</table> 
              	</div>
              	<!-- /.tab-pane -->
              	<div class="tab-pane" id="tab_2">
              		<p>Daftar Mahasiswa yang Anda Bimbing Sebagai Pembimbing Pendamping Skripsi</p>
               	<table id="tabel_2" class="table table-bordered table-hovered">
               		<thead>
	               		<tr>
	               			<th>No</th>
	               			<th>NIM</th>
	               			<th>Nama</th>
	               			<th>Prodi</th>
	               			<th>Status</th>
	               			<th>Opsi</th>
	               		</tr>
	               	</thead>
            				@foreach ($sutgas_pembimbing_2 as $item)
               				<tr>
               					<td>{{ $loop->index+1 }}</td>
               					<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
               					<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->status_skripsi->status }}</td>
	   			      			<td>
	   			      				<a href="{{ route('dosen.pembimbing-skripsi.show', $item->detail_skripsi->skripsi->nim) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
	   			      			</td>
               				</tr>
            				@endforeach
               		</tbody>
               	</table> 
              	</div>
              	<!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$('#tabel_1').DataTable({})
		$('#tabel_2').DataTable({})
	</script>
@endsection
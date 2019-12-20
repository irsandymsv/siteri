@extends('layouts.template')

@section('side_menu')
   @include('include.dosen_menu')
@endsection

@section('page_title')
	Dashboard
@endsection

@section('judul_header')
	Dashboard
@endsection

@section('content')
	<div class="row">
		<div class="col col-md-6">
			<div class="box box-primary">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Pembimbing Utama Skripsi</h3>

			   	<div class="box-tools">
			   		{{-- <a href="{{ route('dekan.sk-sempro.index') }}" class="btn btn-default">Lihat Semua</a> --}}
			   	</div>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>NIM</th>
			        		<th>Nama</th>
			        		<th>Prodi</th>
			        		<th>Opsi</th>
			      	</tr>

				      <tbody>
				      	@if ($sutgas_pembimbing_1->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sutgas_pembimbing_1 as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>
				      					<a href="#" title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
				      				</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>

		<div class="col col-md-6">
			<div class="box box-primary">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Pembimbing Pendamping Skripsi</h3>

			   	<div class="box-tools">
			   		{{-- <a href="{{ route('dekan.sk-sempro.index') }}" class="btn btn-default">Lihat Semua</a> --}}
			   	</div>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>NIM</th>
			        		<th>Nama</th>
			        		<th>Prodi</th>
			        		<th>Opsi</th>
			      	</tr>

				      <tbody>
				      	@if ($sutgas_pembimbing_2->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sutgas_pembimbing_2 as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>
				      					<a href="#" title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
				      				</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col col-md-6">
			<div class="box box-warning">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Pembahas Sempro 1</h3>

			   	<div class="box-tools">
			   		{{-- <a href="{{ route('dekan.sk-sempro.index') }}" class="btn btn-default">Lihat Semua</a> --}}
			   	</div>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>NIM</th>
			        		<th>Nama</th>
			        		<th>Prodi</th>
			        		<th>Opsi</th>
			      	</tr>

				      <tbody>
				      	@if ($sutgas_pembahas_1->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sutgas_pembahas_1 as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>
				      					<a href="#" title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
				      				</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>

		<div class="col col-md-6">
			<div class="box box-warning">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Pembahas Sempro 2</h3>

			   	<div class="box-tools">
			   		{{-- <a href="{{ route('dekan.sk-sempro.index') }}" class="btn btn-default">Lihat Semua</a> --}}
			   	</div>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>NIM</th>
			        		<th>Nama</th>
			        		<th>Prodi</th>
			        		<th>Opsi</th>
			      	</tr>

				      <tbody>
				      	@if ($sutgas_pembahas_2->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sutgas_pembahas_2 as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>
				      					<a href="#" title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
				      				</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col col-md-6">
			<div class="box box-danger">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Penguji Skripsi Utama</h3>

			   	<div class="box-tools">
			   		{{-- <a href="{{ route('dekan.sk-sempro.index') }}" class="btn btn-default">Lihat Semua</a> --}}
			   	</div>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>NIM</th>
			        		<th>Nama</th>
			        		<th>Prodi</th>
			        		<th>Opsi</th>
			      	</tr>

				      <tbody>
				      	@if ($sutgas_penguji_1->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sutgas_penguji_1 as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>
				      					<a href="#" title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
				      				</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>

		<div class="col col-md-6">
			<div class="box box-danger">
			  	<div class="box-header with-border">
			   	<h3 class="box-title">Penguji Skripsi Pendamping</h3>

			   	<div class="box-tools">
			   		{{-- <a href="{{ route('dekan.sk-sempro.index') }}" class="btn btn-default">Lihat Semua</a> --}}
			   	</div>
			  	</div>
			  <!-- /.box-header -->
			  <div class="box-body">
			    	<table class="table table-bordered">
			      	<tr>
			       		<th style="width: 10px">#</th>
			        		<th>NIM</th>
			        		<th>Nama</th>
			        		<th>Prodi</th>
			        		<th>Opsi</th>
			      	</tr>

				      <tbody>
				      	@if ($sutgas_penguji_2->isEmpty())
				      		<tr>
				      			<td colspan="5" style="text-align: center;">Tidak Ada Data</td>
				      		</tr>
				      	@else
	   			      	@foreach ($sutgas_penguji_2 as $item)
	   			      		<tr>
	   			      			<td>{{ $loop->index+1 }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->nim }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->nama }}</td>
	   			      			<td>{{ $item->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
	   			      			<td>
				      					<a href="#" title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
				      				</td>
	   			      		</tr>
	   			      	@endforeach
				      	@endif
				      </tbody>
			    </table>
			  </div>
			  <!-- /.box-body -->
			</div>
		</div>
	</div>
@endsection
@extends('layouts.template')

@section('side_menu')
	@if (Auth::user()->jabatan->jabatan == 'Pengelola Data Akademik')
		@include('include.akademik_menu')
	@endif
@endsection

@section('page_title')
	Notifikasi
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		thead tr th{
			text-align: center;
		}
	</style>
@endsection

@section('judul_header')
	Notifikasi
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-warning">
			<div class="box-header">
				<h3 class="box-title">Daftar Semua Notifikasi</h3>
			</div>

			<div class="box-body">
				<div class="table-responsive">
					<table id="table_data1" class="table table-bordered table-hovered">
						<thead>
							<tr>
								<th>No</th>
								<th>Notifikasi</th>
								<th>Tanggal</th>
								<th>Dilihat</th>
							</tr>
						</thead>
						<tbody>
							@if (Auth::user()->jabatan->jabatan == 'Pengelola Data Akademik')
								
								@foreach ($notifications as $notif)
									<tr>
										<td>{{ $loop->index + 1 }}</td>
										<td>
											@if ($notif->type == 'App\Notifications\verifSutgasKtu')
												Surat Tugas 
												@if ($notif->data['tipe_sutgas'] == "Surat Tugas Pembimbing")
												Pembimbing
												@elseif($notif->data['tipe_sutgas'] == "Surat Tugas Pembahas")
												Pembahas
												@else
												Penguji
												@endif 
												{{ $notif->data['no_surat'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }} telah diverifikasi<br>
											@elseif($notif->type == 'App\Notifications\verifSKSemproKtu')
												SK Sempro {{ $notif->data['no_surat'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }} telah diverifikasi
											@elseif($notif->type == 'App\Notifications\verifSKSkripsiKtu')
												SK Pembimbing Skripsi {{ $notif->data['no_surat_pembimbing'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }} 
												dan SK Penguji Skripsi {{ $notif->data['no_surat_penguji'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }} telah diverifikasi
											@endif
										</td>
										<td>
											{{ Carbon\Carbon::parse($notif->created_at)->locale('id_ID')->isoFormat('D MMMM Y H:mm') }}
										</td>
										<td>
											@if ($notif->read_at == null)
												<a href="{{ route('notifikasi.read', $notif->id) }}" title="Lihat Detail">Belum</a>
											@else
												Sudah
											@endif
										</td>
									</tr>
								@endforeach

							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

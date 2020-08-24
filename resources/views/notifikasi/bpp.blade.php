@extends('notifikasi.template')
@section('content')

@foreach (Auth::user()->unreadNotifications as $notif)
	@if ($notif->type == 'App\Notifications\suratTugasKepegawaian')
		@if ($notif->data['tipe_notif'] == 'butuh_verif')
			<li>
				<a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
					<i class="fa fa-exclamation-circle col-xs-2"></i>
					<div class="col-xs-10">
						Surat Tugas Kepegawaian 
						{{ $notif->data['nomor_surat'] }}/UN25.1.15/KP/{{ \Carbon\Carbon::parse($notif->data['created_at'])->year }} 
						Butuh Verifikasi.
					
						<br>
						<small style="color: grey;">{{ Carbon\Carbon::parse($notif->created_at)->locale('id_ID')->DiffForHumans() }}</small>
					</div>
				</a>
			</li>
		@elseif($notif->data['tipe_notif'] == 'sudah_upload_bukti')
			<li>
				<a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
					<i class="fa fa-exclamation-circle col-xs-2"></i>
					<div class="col-xs-10">
						Bukti Surat Tugas Kepegawaian 
						{{ $notif->data['nomor_surat'] }}/UN25.1.15/KP/{{ \Carbon\Carbon::parse($notif->data['created_at'])->year }} 
						Sudah Diunggah.
						
						<br>
						<small style="color: grey;">{{ Carbon\Carbon::parse($notif->created_at)->locale('id_ID')->DiffForHumans() }}</small>
					</div>
				</a>
			</li>
		@endif
	@endif
@endforeach

@endsection

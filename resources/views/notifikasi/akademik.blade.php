@extends('notifikasi.template')
@section('content')

@foreach (Auth::user()->unreadNotifications as $notif)
@if ($notif->type == 'App\Notifications\verifSutgasKtu')

<li>
    <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
        Surat Tugas
        @if ($notif->data['tipe_sutgas'] == "Surat Tugas Pembimbing")
        Pembimbing
        @elseif($notif->data['tipe_sutgas'] == "Surat Tugas Pembahas")
        Pembahas
        @else
        Penguji
        @endif
        {{ $notif->data['no_surat'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }}
        telah diverifikasi.<br>
        <small
            style="color: grey;">{{ Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans() }}</small>
    </a>
</li>
@elseif($notif->type == 'App\Notifications\verifSKSemproKtu')
<li>
    <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
        SK Sempro
        {{ $notif->data['no_surat'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }}
        telah diverifikasi.<br>
        <small
            style="color: grey;">{{ Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans() }}</small>
    </a>
</li>
@elseif($notif->type == 'App\Notifications\verifSKSkripsiKtu')
<li>
    <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
        SK Pembimbing Skripsi
        {{ $notif->data['no_surat_pembimbing'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }}
        dan SK Penguji Skripsi
        {{ $notif->data['no_surat_penguji'] }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($notif->data['created_at'])->year }}
        telah diverifikasi.<br>
        <small
            style="color: grey;">{{ Carbon\Carbon::parse($notif->data['waktu_verif'])->locale('id_ID')->DiffForHumans() }}</small>
    </a>
</li>
@endif
@endforeach

@endsection

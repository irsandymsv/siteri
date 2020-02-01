@extends('notifikasi.template')
@section('content')

@foreach (Auth::user()->unreadNotifications as $notif)
<li>
    <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
        <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
        <div class="col-xs-10">
            Laporan Peminjaman Barang<br>
            <b>{{ $notif->data['keterangan'] }}</b><br>
            @if ($notif->data['pesan'])
            {{ $notif->data['pesan'] }}<br>
            @endif
            <small
                style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
        </div>
    </a>
</li>
@endforeach

@endsection

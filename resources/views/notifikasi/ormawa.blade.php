@extends('notifikasi.template')
@section('content')

@foreach (Auth::user()->unreadNotifications as $notif)
@if ($notif->type == 'App\Notifications\verifPeminjamanBarang')
<li>
    <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
        <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
        <div class="col-xs-10">
            Laporan Peminjaman Barang<br>
            @if ($notif->data['verif_baper'])
            <b>{{ $notif->data['kegiatan'] }}</b>telah disetujui Bagian Perlengkapan<br>
            @elseif ($notif->data['verif_ktu'])
            <b>{{ $notif->data['kegiatan'] }}</b>telah diverifikasi KTU<br>
            @endif
            <small
                style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
        </div>
    </a>
</li>
@elseif ($notif->type == 'App\Notifications\verifPeminjamanRuang')
<li>
    <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
        <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
        <div class="col-xs-10">
            Laporan Peminjaman Ruang<br>
            <b>{{ $notif->data['kegiatan'] }}</b><br>
            @if ($notif->data['verif_baper'])
            Telah Disetujui Bagian Perlengkapan<br>
            @elseif ($notif->data['verif_ktu'])
            Telah Disetujui KTU<br>
            @endif
            <small
                style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
        </div>
    </a>
</li>
@endif
@endforeach

@endsection

@extends('notifikasi.template')
@section('content')

@foreach (Auth::user()->unreadNotifications as $notif)
@if ($notif->type == 'App\Notifications\verifPengadaan')
<li>
    <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
        <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
        <div class="col-xs-10">
            Laporan Pengadaan<br>
            <b>{{ $notif->data['keterangan'] }}</b><br>
            @if ($notif->data['pesan'])
            {{ $notif->data['pesan'] }}<br>
            @endif
            <small
                style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
        </div>
    </a>
</li>
@elseif ($notif->type == 'App\Notifications\verifPeminjamanBarang')
<li>
    <a href="{{ route('notifikasi.read', $notif->id) }}" style="white-space: initial;">
        <i class="{{ ($notif->data['pesan']) ? 'fa fa-times-circle' : 'fa fa-check-circle' }} col-xs-2"></i>
        <div class="col-xs-10">
            @if ($notif->data['verif_ktu'])
            Laporan Peminjaman Barang<br>
            <b>{{ $notif->data['kegiatan'] }}</b>telah diverifikasi KTU<br>
            @else
            Laporan Peminjaman Barang Baru<br>
            <b>{{ $notif->data['kegiatan'] }}</b><br>
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
            @if ($notif->data['verif_ktu'])
            Laporan Peminjaman Ruang<br>
            <b>{{ $notif->data['kegiatan'] }}</b>telah diverifikasi KTU<br>
            @else
            Laporan Peminjaman Ruang Baru<br>
            <b>{{ $notif->data['kegiatan'] }}</b><br>
            @endif
            <small
                style="color: grey;">{{ Carbon\Carbon::parse($notif->data['updated_at'])->locale('id_ID')->DiffForHumans() }}</small>
        </div>
    </a>
</li>
@endif
@endforeach

@endsection

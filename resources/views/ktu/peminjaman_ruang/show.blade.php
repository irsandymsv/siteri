@extends('layouts.template')

@section('side_menu')
@include('include.ktu_menu')
@endsection

@section('page_title', 'Peminjaman Ruang')

@section('judul_header', 'Peminjaman Ruang')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Detail Peminjaman Ruang</h3>
            </div>

            <div class="box-body">
                <div class="">
                    <table class="tabel-keterangan">
                        <tr>
                            <td><b>Tanggal Mulai</b></td>
                            <td>: {{$laporan->tanggal_mulai}}</td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Berakhir</b></td>
                            <td>: {{$laporan->tanggal_berakhir}}</td>
                        </tr>
                        <tr>
                            <td><b>Jam Mulai</b></td>
                            <td>: {{$laporan->jam_mulai}}</td>
                        </tr>
                        <tr>
                            <td><b>Jam Berakhir</b></td>
                            <td>: {{$laporan->jam_berakhir}}</td>
                        </tr>
                        <tr>
                            <td><b>Kegiatan</b></td>
                            <td>: {{$laporan->kegiatan}}</td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Peserta</b></td>
                            <td>: {{$laporan->jumlah_peserta}}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>: @if($laporan->verif_baper == 0)
                                Belum Disetujui
                                @elseif($laporan->verif_ktu == 0)
                                Belum Diverifikasi
                                @else
                                <label class="label bg-green">Sudah Diverifikasi</label>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="inventaris" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruang</th>
                                <th>Kuota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($detail_laporan as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{$no+=1}}</td>
                                <td>{{$item->data_ruang->nama_ruang}}</td>
                                <td>{{$item->data_ruang->kuota}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br><br>
                @if($laporan->verif_baper == 1 && $laporan->verif_ktu == 0)
                {!! Form::open(['route' => ['ktu.peminjaman_ruang.verif', $laporan->id], 'method' =>
                'PUT'])!!}
                {!! Form::hidden("verif_ktu", 1) !!}
                <div class="form-group" style="float: right;">
                    {!! Form::submit('Setujui', [ 'class'=>'btn btn-success', 'id' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(function(){

        $('#peminjaman_ruang').DataTable();

    });

</script>
@endsection
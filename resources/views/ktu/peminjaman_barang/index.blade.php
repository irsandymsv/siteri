@extends('layouts.template')

@section('side_menu')
@include('include.ktu_menu')
@endsection

@section('page_title', 'Peminjaman Barang')

@section('judul_header', 'Peminjaman Barang')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Laporan Peminjaman Barang</h3>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table id="peminjaman_barang" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berakhir</th>
                                <th>Kegiatan</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($laporan as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{$no+=1}}</td>
                                <td>{{$item->tanggal_mulai}}</td>
                                <td>{{$item->tanggal_berakhir}}</td>
                                <td>{{$item->jam_mulai}}</td>
                                <td>{{$item->jam_berakhir}}</td>
                                <td>{{$item->kegiatan}}</td>
                                <td>
                                    @if($item->verif_baper == 0)
                                    Belum Disetujui
                                    @elseif($item->verif_ktu == 0)
                                    Belum Diverifikasi
                                    @else
                                    <label class="label bg-green">Sudah Diverifikasi</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('ktu.peminjaman_barang.show', $item->id) }}"
                                        class="btn btn-primary" title="Lihat Laporan"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(function(){

        $('#peminjaman_barang').DataTable();

    });

</script>
@endsection

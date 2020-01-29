@extends('layouts.template')

@section('side_menu')
@include('include.ormawa_menu')
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
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Peminjaman Barang</h3>

                <div class="box-tools">
                    <a href="{{ route('ormawa.peminjaman_barang.index') }}" class="btn btn-default"
                        title="Lihat Semua Peminjaman Barang">Lihat Semua</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Kegiatan</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        @if ($pinjam_barang->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        @else
                        @foreach ($pinjam_barang as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tanggal_mulai)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->tanggal_berakhir)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>
                                <a href="{{ route('ormawa.peminjaman_barang.show', $item->id) }}" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
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
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Peminjaman Ruang</h3>

                <div class="box-tools">
                    <a href="{{ route('ormawa.peminjaman_ruang.index') }}" class="btn btn-default"
                        title="Lihat Semua Peminjaman ruang">Lihat Semua</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Kegiatan</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        @if ($pinjam_ruang->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        @else
                        @foreach ($pinjam_ruang as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tanggal_mulai)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->tanggal_berakhir)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>{{ $item->kegiatan }}</td>
                            <td>
                                <a href="{{ route('ormawa.peminjaman_ruang.show', $item->id) }}" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
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

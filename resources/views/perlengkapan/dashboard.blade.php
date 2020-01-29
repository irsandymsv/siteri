@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title')
Dashboard
@endsection

@section('judul_header')
Dashboard
@endsection

@section('content')
<div class="row">

    <div class="col col-md-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Laporan Pengadaan Butuh Revisi</h3>

                <div class="box-tools">
                    <a href="{{ route('perlengkapan.pengadaan.index') }}" class="btn btn-default"
                        title="Lihat Laporan Pengadaan">Lihat Semua</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Keterangan</th>
                        <th>Pesan</th>
                        <th>Dibuat</th>
                        <th>Ditolak</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        @if ($pengadaan->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        @else
                        @foreach ($pengadaan as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->pesan }}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y - HH:mm') }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->updated_at)->locale('id_ID')->isoFormat('D MMMM Y - HH:mm') }}
                            </td>
                            <td>
                                <a href="{{ route('perlengkapan.pengadaan.show', $item->id) }}" title="Lihat Detail"
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
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Peminjaman Barang Butuh Verifikasi</h3>

                <div class="box-tools">
                    <a href="{{ route('perlengkapan.peminjaman_barang.index') }}" class="btn btn-default"
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
                                <a href="{{ route('perlengkapan.peminjaman_barang.show', $item->id) }}"
                                    title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
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
                <h3 class="box-title">Peminjaman Ruang Butuh Verifikasi</h3>

                <div class="box-tools">
                    <a href="{{ route('perlengkapan.peminjaman_ruang.index') }}" class="btn btn-default"
                        title="Lihat Semua Peminjaman Ruang">Lihat Semua</a>
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
                                <a href="{{ route('perlengkapan.peminjaman_ruang.show', $item->id) }}"
                                    title="Lihat Detail" class="btn btn-primary"><i class="fa fa-eye"></i></a>
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

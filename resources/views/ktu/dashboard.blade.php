@extends('layouts.template')

@section('side_menu')
@include('include.ktu_menu')
@endsection

@section('page_title')
Dashboard
@endsection

@section('judul_header')
Dashboard
@endsection

@section('content')
<div class="row">
    <div class="col col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Surat Tugas yang Butuh Verifikasi</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table_data1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>No Surat</th>
                            <th>Tipe Surat</th>
                            <th>Tanggal Dibuat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($sutgas_dikirim->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        @else
                        @foreach ($sutgas_dikirim as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
                            </td>
                            <td>{{ $item->tipe_surat_tugas->tipe_surat }}</td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            @if($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembimbing")
                            <td>
                                <a href="{{ route('ktu.sutgas-pembimbing.show', $item->id) }}" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                            @elseif($item->tipe_surat_tugas->tipe_surat == "Surat Tugas Pembahas")
                            <td>
                                <a href="{{ route('ktu.sutgas-pembahas.show', $item->id) }}" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                            @else
                            <td>
                                <a href="{{ route('ktu.sutgas-penguji.show', $item->id) }}" title="Lihat Detail"
                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                            </td>
                            @endif
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

<div class="row">
    <div class="col col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">SK Sempro yang Butuh Verifikasi</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No Surat</th>
                        <th>Tanggal Dibuat</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        @if ($sk_sempro_dikirim->isEmpty())
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        @else
                        @foreach ($sk_sempro_dikirim as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>
                                <a href="{{ route('ktu.sk-sempro.show', $item->no_surat) }}" title="Lihat Detail"
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
                <h3 class="box-title">SK Skripsi yang Butuh Verifikasi</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No SK Pembimbing</th>
                        <th>No SK Penguji</th>
                        <th>Tanggal Dibuat</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        @if ($sk_skripsi_dikirim->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        @else
                        @foreach ($sk_skripsi_dikirim as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item->no_surat_pembimbing }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
                            </td>
                            <td>{{ $item->no_surat_penguji }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>
                                <a href="{{ route('ktu.sk-skripsi.show', $item->id) }}" title="Lihat Detail"
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

<div class="row">
    <div class="col col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Honor SK Sempro Terbaru</h3>

                <div class="box-tools">
                    <a href="{{ route('ktu.honor-sempro.index') }}" class="btn btn-default"
                        title="Lihat Semua SK Sempro">Lihat Semua</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No SK Sempro</th>
                        <th>Tanggal Dibuat</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        @if ($sk_honor_sempro->isEmpty())
                        <tr>
                            <td colspan="4" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        @else
                        @foreach ($sk_honor_sempro as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item->sk_sempro->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>
                                <a href="{{ route('ktu.honor-sempro.show', $item->id) }}" title="Lihat Detail"
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
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Honor SK Skripsi Terbaru</h3>

                <div class="box-tools">
                    <a href="{{ route('ktu.honor-skripsi.index') }}" class="btn btn-default"
                        title="Lihat Semua SK Skripsi">Lihat Semua</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>No SK Pembimbing</th>
                        <th>No SK Penguji</th>
                        <th>Tanggal Dibuat</th>
                        <th>Opsi</th>
                    </tr>

                    <tbody>
                        @if ($sk_honor_skripsi->isEmpty())
                        <tr>
                            <td colspan="5" style="text-align: center;">Tidak Ada Data</td>
                        </tr>
                        @else
                        @foreach ($sk_honor_skripsi as $item)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $item->sk_skripsi->no_surat_pembimbing }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
                            </td>
                            <td>{{ $item->sk_skripsi->no_surat_penguji }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($item->created_at)->year }}
                            </td>
                            <td>{{ Carbon\Carbon::parse($item->sk_skripsi->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
                            </td>
                            <td>
                                <a href="{{ route('ktu.honor-skripsi.show', $item->id) }}" title="Lihat Detail"
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
                    <a href="{{ route('ktu.peminjaman_barang.index') }}" class="btn btn-default"
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
                                <a href="{{ route('ktu.peminjaman_barang.show', $item->id) }}" title="Lihat Detail"
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
                <h3 class="box-title">Peminjaman Ruang Butuh Verifikasi</h3>

                <div class="box-tools">
                    <a href="{{ route('ktu.peminjaman_ruang.index') }}" class="btn btn-default"
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
                                <a href="{{ route('ktu.peminjaman_ruang.show', $item->id) }}" title="Lihat Detail"
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

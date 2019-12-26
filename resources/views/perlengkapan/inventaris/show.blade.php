@extends('perlengkapan.perlengkapan_view')

@section('page_title', 'Laporan Inventaris')

@section('css_link')
<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
<style type="text/css">
    .tabel-keterangan td {
        padding-right: 10px;
        font-size: 15px;
    }
</style>
@endsection

@section('judul_header', 'Laporan Inventaris')

@section('content')

<!-- <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button> -->
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Data Inventaris</h3>
            </div>

            <div class="box-body">
                <div class="">
                    <table class="tabel-keterangan">
                        <tr>
                            <td><b>Kode Barang</b></td>
                            <td>: {{$barang->kode_barang}}</td>
                        </tr>
                        <tr>
                            <td><b>Nama Barang</b></td>
                            <td>: {{$barang->nama_barang}}</td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="inventaris" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>NUP</th>
                                <th>Tanggal</th>
                                <th>Merk Barang</th>
                                <th>Kode Ruang</th>
                                <th>Uraian Ruang</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail_barang as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{ $item->nup }}</td>
                                <td>{{ $item->tanggal }}</td>
                                <td>{{ $item->merk_barang }}</td>
                                <td>{{ $item->data_ruang->kode_ruang }}</td>
                                <td>{{ $item->data_ruang->nama_ruang }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    <a href="{{ route('perlengkapan.inventaris.edit', $item->id) }}"
                                        class="btn btn-warning" title="Ubah Laporan"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" id="{{ $item->id }}" name="hapus_laporan"
                                        title="Hapus Laporan" data-toggle="modal" data-target="#modal-delete"><i
                                            class="fa fa-trash"></i></a>
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

<div id="success_delete" class="pop_up_info">
    <h4><i class="icon fa fa-check"></i> <span></span></h4>
</div>

<div class="modal modal-danger fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Konfirmasi Pembatalan</h4>
            </div>
            <div class="modal-body">
                <p>Apakah anda yakin ingin membatalkan inventaris ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <button type="button" id="hapusBtn" data-dismiss="modal" class="btn btn-outline">Iya</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection

@section('script')
<!-- <script src="/js/btn_backTop.js"></script> -->

<script type="text/javascript">
    $(function() {
        $('#inventaris').DataTable();

        // $("a[name='hapus_laporan']").click(function(event) {
        //     event.preventDefault();
        //     var id_lap = $(this).attr('id');

        // });
    });
</script>
@endsection

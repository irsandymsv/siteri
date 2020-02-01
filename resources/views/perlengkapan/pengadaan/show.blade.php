@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Pengadaan')

@section('css_link')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
<style type="text/css">
    .tabel-keterangan td {
        padding-right: 10px;
        font-size: 15px;
    }
</style>
@endsection

@section('judul_header', 'Pengadaan')

@section('content')

<!-- <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button> -->
<div class="row">
    <div class="col-xs-12">
        <div id="box"
            class="{{ ($laporan_pengadaan->verif_wadek2 == 0) ? "box box-primary" : (($laporan_pengadaan->verif_wadek2 == 1) ? "box box-danger" : "box box-success") }}">
            <div class="box-header">
                <h3 class="box-title">Data Pengadaan</h3>
                @if ($laporan_pengadaan->verif_wadek2 != 2)
                <div style="float: right;">
                    <a href="{{ route('perlengkapan.pengadaan.edit', [$laporan_pengadaan->id, 'laporan' => true]) }}"
                        class="btn btn-primary"><i class="fa fa-plus"></i> Ubah Laporan</a>
                </div>
                @endif
            </div>

            <div class="box-body">
                <div class="">
                    <table class="tabel-keterangan">
                        <tr>
                            <td><b>Tanggal Dibuat</b></td>
                            <td>: {{$laporan_pengadaan->created_at}}</td>
                        </tr>
                        <tr>
                            <td><b>Terakhir Diubah</b></td>
                            <td>: {{$laporan_pengadaan->updated_at}}</td>
                        </tr>
                        <tr>
                            <td><b>Peruntukan</b></td>
                            <td>: {{$laporan_pengadaan->keterangan}}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td id="status">:
                                @switch($laporan_pengadaan->verif_wadek2)
                                @case(1)
                                <label class="label bg-red">Ditolak</label>
                                @break
                                @case(2)
                                <label class="label bg-green">Disetujui</label>
                                @break
                                @default
                                Belum Diverifikasi
                                @endswitch
                            </td>
                        </tr>
                        @if ($laporan_pengadaan->verif_wadek2 == 1)
                        <tr id="pesan">
                            <td><b>Pesan</b></td>
                            <td>: {{$laporan_pengadaan->pesan}}</td>
                        </tr>
                        @endif
                    </table>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="pengadaan" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengadaan as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->spesifikasi }}</td>
                                <td>{{ $item->jumlah }} {{ $item->satuan->satuan }}</td>
                                <td>{{ $item->harga }}</td>
                                @if ($laporan_pengadaan->verif_wadek2 != 2)
                                <td>
                                    <a href="{{ route('perlengkapan.pengadaan.edit', $item->id) }}"
                                        class="btn btn-warning" title="Ubah Laporan"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" id="{{ $item->id }}"
                                        id2="{{ $laporan_pengadaan->id }}" name="hapus_laporan" title="Hapus Laporan"
                                        data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash"></i></a>
                                </td>
                                @endif
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
                <p>Apakah anda yakin ingin membatalkan pengadaan ini?</p>
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
<script>
    $(function(){
        $('a.btn.btn-danger').click(function(){
            event.preventDefault();
				var id = $(this).attr('id');
				var id2 = $(this).attr('id2');
                console.log(id);

				var url_del = "{{route('perlengkapan.pengadaan.destroy', ["id", 'lap' => 'compek'])}}";
                url_del = url_del.replace('id', id);
                url_del = url_del.replace('compek', id2);
				console.log(url_del);

				$('div.modal-footer').off().on('click', '#hapusBtn', function(event) {
					$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});

					$.ajax({
						url: url_del,
						type: 'POST',
						data: {_method: 'DELETE'},
					})
					.done(function(hasil) {
						console.log("success");
                        $("tr#lap_"+id).remove();
                        if ($('#box').hasClass('box-danger')) {
                            $('#status').html(': Belom Diverifikasi');
                            $('#pesan').remove();
                            $('#box').removeClass('box-danger').addClass('box-primary');
                        }
					})
					.fail(function() {
                        alert("Gagal Menghapus")
						console.log("error");
					});
				});
        });
    });

</script>

@endsection

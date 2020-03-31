@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Peminjaman Barang')

@section('judul_header', 'Peminjaman Barang')

@section('css_link')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/custom_style.css') }}">
<style type="text/css">
    .tabel-keterangan td {
        padding-right: 10px;
        font-size: 15px;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Detail Peminjaman Barang</h3>
                <div style="float: right;">
                    <a href="{{ route('perlengkapan.peminjaman_barang.edit', [$laporan->id, 'laporan' => true]) }}"
                        class="btn btn-warning"><i class="fa fa-edit"></i> Ubah Laporan</a>
                </div>
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
                                <th>Nama Barang</th>
                                <th>Merk Barang</th>
                                <th>Jumlah</th>
                                {{-- <th style="width:99.8px">Opsi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($detail_laporan as $item)
                            {{-- {{dd($item)}} --}}
                            <tr id="{{ $item->iddetail_data_barang_fk }}">
                                <td>{{$no+=1}}</td>
                                <td>{{$item->detail_data_barang->data_barang->nama_barang}}</td>
                                <td>{{$item->detail_data_barang->merk_barang}}</td>
                                <td>{{$item->jumlah }} {{$item->satuan->satuan }}</td>
                                <td>
                                    {{-- @if($item->verif_baper != 1)
                                    <a href="{{ route('perlengkapan.peminjaman_barang.edit', $item->id) }}" class="btn
                                    btn-warning"
                                    title="Ubah Laporan"><i class="fa fa-edit"></i></a>
                                    @endif --}}
                                    <a href="#" class="btn btn-danger" id="{{ $item->idpinjam_barang_fk }}"
                                        name="hapus_laporan" title="Hapus Laporan" data-toggle="modal"
                                        data-target="#modal-delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br><br>
                @if($laporan->verif_baper == 0)
                {!! Form::open(['route' => ['perlengkapan.peminjaman_barang.verif', $laporan->id], 'method' =>
                'PUT'])!!}
                {!! Form::hidden("verif_baper", 1) !!}
                <div class="form-group" style="float: right;">
                    {!! Form::submit('Setujui', [ 'class'=>'btn btn-success', 'id' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
                @endif
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
                <p>Apakah anda yakin ingin membatalkan peminjaman barang ini?</p>
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
    $(function() {
        $('#peminjaman_barang').DataTable({
            "fnDrawCallback": function( oSettings ) {

                $('a.btn.btn-danger').click(function(){
                    event.preventDefault();
                    id = $(this).attr('id');
                    idmerk = $(this).parents('tr').attr('id');
                    console.log(id);
                    console.log(idmerk);

                    url_del = "{{route('perlengkapan.peminjaman_barang.destroy', "id")}}";
                    url_del = url_del.replace('id', id);
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
                            data: {_method: 'DELETE', 'idmerk':idmerk},
                        })
                        .done(function(hasil) {
                            console.log("success");
                            $("tr#"+idmerk).remove();
                            $("#success_delete").show();
                            $("#success_delete").find('span').html(hasil);
                            $("#success_delete").fadeOut(1800);
                        })
                        .fail(function() {
                            console.log("error");
                            $("tr#"+idmerk).remove();
                        });
                    });
                });
            }
        });

    });
</script>
@endsection

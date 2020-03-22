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

@section('judul_header', 'Permohonan Pengadaan')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Permohonan Pengadaan</h3>

                <div style="float: right;">
                    <a href="{{ route('perlengkapan.pengadaan.create') }}" class="btn btn-primary"><i
                            class="fa fa-plus"></i> Ajukan Permohonan Baru</a>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table id="pengadaan" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Dibuat</th>
                                <th>Terakhir Diubah</th>
                                <th>Peruntukan</th>
                                {{-- <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total</th> --}}
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($laporan as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{$no+=1}}</td>
                                <td>
                                    {{Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
                                </td>
                                <td>
                                    {{Carbon\Carbon::parse($item->updated_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
                                </td>
                                <td>{{$item->keterangan}}</td>
                                {{-- <td>{{$item->nama_barang}}</td>
                                <td>{{$item->spesifikasi}}</td>
                                <td>{{$item->jumlah}}</td>
                                <td>Rp {{$item->harga}}</td>
                                <td>Rp {{$item->jumlah * $item->harga}}</td> --}}
                                <td>
                                    @switch($item->verif_wadek2)
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
                                <td>
                                    <a href="{{ route('perlengkapan.pengadaan.show', $item->id) }}"
                                        class="btn btn-primary" title="Lihat Permohonan"><i class="fa fa-eye"></i></a>
                                    @if($item->verif_wadek2 != 2)
                                    <a href="{{ route('perlengkapan.pengadaan.edit', [$item->id, 'laporan' => true]) }}"
                                        class="btn btn-warning" title="Ubah Permohonan"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if($item->verif_wadek2 != 2)
                                    <a href="#" class="btn btn-danger" id="{{ $item->id }}" name="hapus_laporan"
                                        title="Hapus Permohonan" data-toggle="modal" data-target="#modal-delete"><i
                                            class="fa fa-trash"></i></a>
                                    @endif

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

<div id="failed_delete" class="pop_up_info">
    <h4><i class="icon fa fa-times"></i> <span></span></h4>
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
        $('#pengadaan').DataTable({
            "fnDrawCallback": function( oSettings ) {

                $('a.btn.btn-danger').click(function(){
                    $("#success_delete").show();
                    $("#success_delete").find('span').html("Compek");
                    $("#success_delete").fadeOut(1800);
                });

                $('a.btn.btn-danger').click(function(){
                    event.preventDefault();
                    id = $(this).attr('id');

                    url_del = "{{route('perlengkapan.pengadaan.destroy', "id")}}";
                    url_del = url_del.replace('id', id)
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
                            // dataType: '',
                            data: {_method: 'DELETE', 'laporan':true},
                        })
                        .done(function(hasil) {
                            console.log("success");
                            $("tr#lap_"+id).remove();
                            $("#success_delete").show();
                            $("#success_delete").find('span').html(hasil);
                            $("#success_delete").fadeOut(1800);
                        })
                        .fail(function() {
                            console.log("error");
                        });
                    });
                });

            }
        });

    });
</script>

@endsection

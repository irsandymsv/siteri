@extends('ormawa.ormawa_view')

@section('side_menu')
@include('include.ormawa_menu')
@endsection

@section('page_title', 'Peminjaman Barang')

@section('judul_header', 'Peminjaman Barang')

@section('css_link')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Laporan Peminjaman Barang</h3>

                <div style="float: right;">
                    <a href="{{ route('ormawa.peminjaman_barang.create') }}" class="btn btn-primary"><i
                            class="fa fa-plus"></i> Buat Laporan</a>
                </div>
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
                                <th style="width:102px">Opsi</th>
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
                                    <a href="{{ route('ormawa.peminjaman_barang.show', $item->id) }}"
                                        class="btn btn-primary" title="Lihat Laporan"><i class="fa fa-eye"></i></a>
                                    @if($item->verif_ktu != 1)
                                    <a href="{{ route('ormawa.peminjaman_barang.edit', $item->id) }}"
                                        class="btn btn-warning" title="Ubah Laporan"><i class="fa fa-edit"></i></a>
                                    @endif
                                    @if($item->verif_ktu != 1)
                                    <a href="#" class="btn btn-danger" id="{{ $item->id }}" name="hapus_laporan"
                                        title="Hapus Laporan" data-toggle="modal" data-target="#modal-delete"><i
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
        $('#peminjaman_barang').DataTable();

        $('a.btn.btn-danger').click(function(){
            event.preventDefault();
            id = $(this).attr('id');
            console.log(id);

            url_del = "{{route('ormawa.peminjaman_barang.destroy', "id")}}";
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
    });

</script>
@endsection

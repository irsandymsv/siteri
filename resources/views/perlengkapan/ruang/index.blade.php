@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Ruang')

@section('css_link')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/css/custom_style.css') }}">
@endsection

@section('judul_header', 'Ruang')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Data Ruang</h3>

                <div style="float: right;">
                    <a href="{{ route('perlengkapan.ruang.create') }}" class="btn btn-primary"><i
                            class="fa fa-plus"></i> Buat Data Baru</a>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table id="ruang" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Ruang</th>
                                <th>Nama Ruang</th>
                                <th>Kuota</th>
                                <th style="width:80px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($ruang as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{ $no+=1 }}</td>
                                <td>{{ $item->kode_ruang }}</td>
                                <td>{{ $item->nama_ruang }}</td>
                                <td>{{ $item->kuota }}</td>
                                <td>
                                    <a href="{{ route('perlengkapan.ruang.edit', $item->id) }}" class="btn btn-warning"
                                        title="Ubah Data Ruang"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" id="{{ $item->id }}" name="hapus_laporan"
                                        title="Hapus Data Ruang" data-toggle="modal" data-target="#modal-delete"><i
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
                <p>Apakah anda yakin ingin membatalkan ruang ini?</p>
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
<script type="text/javascript">
    $(function() {
        $('#ruang').DataTable({
            "fnDrawCallback": function( oSettings ) {

                $('a.btn.btn-danger').click(function(){
                    event.preventDefault();
                    id = $(this).attr('id');
                    console.log(id);

                    url_del = "{{route('perlengkapan.ruang.destroy', "id")}}";
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
                            data: {_method: 'DELETE', 'barang':true},
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
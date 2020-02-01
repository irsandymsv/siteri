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
                        <tr id="{{ $laporan_pengadaan->id }}">
                            <td><b>Peruntukan</b></td>
                            <td id="peruntukan">: {{$laporan_pengadaan->keterangan}}</td>
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
                            <tr id="{{ $item->id }}" id2="{{ $laporan_pengadaan->id }}">
                                <td class="nama">{{ $item->nama_barang }}</td>
                                <td class="spesifikasi">{{ $item->spesifikasi }}</td>
                                <td style="max-width: 100px"><span class="jumlah"
                                        style="float:left; margin-right: 2px;">{{ $item->jumlah }}
                                    </span><span class="satuan" idd="{{ $item->satuan->id }}"
                                        style="float:left">{{ $item->satuan->satuan }}</span></td>
                                <td class="harga">{{ $item->harga }}</td>
                                @if ($laporan_pengadaan->verif_wadek2 != 2)
                                <td>
                                    {{-- <a href="{{ route('perlengkapan.pengadaan.edit', $item->id) }}"
                                    class="btn btn-warning" title="Ubah Laporan"><i class="fa fa-edit"></i></a> --}}
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
				id = $(this).attr('id');
				id2 = $(this).attr('id2');
                console.log(id);

				url_del = "{{route('perlengkapan.pengadaan.destroy', ["id", 'lap' => 'compek'])}}";
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
                        $("tr#"+id).remove();
                        ubahStatus();
					})
					.fail(function() {
                        alert("Gagal Menghapus")
						console.log("error");
					});
				});
            keyPress();
        });

        function ubahStatus(){
            if ($('#box').hasClass('box-danger')) {
                $('#status').html(': Belom Diverifikasi');
                $('#pesan').remove();
                $('#box').removeClass('box-danger').addClass('box-primary');
            }
        }

        function getSelector(prop){
            select = '';
            id = $(prop).attr("id");
            if (id) {
                select =  id;
            }

            classNames = $(prop).attr("class");
            if (classNames) {
                select = classNames;
            }
            return select;
        }

        @if ($laporan_pengadaan->verif_wadek2 != 4)
        edit = false;
        target = null;
        ori = null;
        select = null;
        value = null;

        $('#peruntukan, .nama, .spesifikasi, .jumlah, .satuan, .harga').dblclick(function(event){
            if (target) {
                unedit();
                save();
            }
            if (!target) {
                value = $(this).html();
                ori = $(this).html();
                select = getSelector(this);
                target = this;
                edit = true;
                // console.log(select);
                if (select == 'peruntukan') {
                    value = value.substring(2);
                } else

                console.log(value);
                if (select == 'peruntukan' || select == 'nama' || select == 'spesifikasi') {
                    form = '{!! Form::text('keterangan', 'null', ['class' => 'form-control', 'required']) !!}';
                    form = form.replace('null', value);
                    form = form.replace('keterangan', select);
                    // console.log(form);
                    $(this).html(form);
                } else

                if (select == 'harga') {
                    form = '{!! Form::text('harga', 'null', ['class' => 'form-control jumlah angka', 'required'])!!}';
                    form = form.replace('null', value);
                    console.log(form);
                    $(this).html(form);
                } else

                if (select == 'jumlah') {
                    form = '{!! Form::text('jumlah', 'null', ['class' => 'form-control jumlah angka', 'required', 'style' => 'max-width:60px'])!!}';
                    form = form.replace('null', value);
                    console.log(form);
                    $(this).html(form);
                } else

                if (select == 'satuan') {
                    @php
                    $loop = true;
                    $count = 0;
                    foreach ($satuan as $val) {
                    @endphp
                        if (value == '{{ $val }}') {
                            @php
                            $value = $count;
                            $loop = false;
                            @endphp
                        }
                    @php
                        if ($loop) {
                            break;
                        } else continue;
                        $count++;
                    }
                    @endphp
                    value = $(this).attr('idd') - 1;
                    urls = '{{ route("perlengkapan.pengadaan.getForm", "id") }}';
                    urls = urls.replace('id', value);
                    console.log(urls);
                    $.ajax({
                        type: 'GET',
                        url: urls,
                        headers: {'X-Requested-With': 'XMLHttpRequest'},
                        // data: {value: value},
                        success: function (response) {
                            form = response;
                            // console.log(value);
                            // console.log(form);
                            $(target).html(form);
                        }
                    });
                }
            } else {
            }
        });

        function unedit() {
            value = $(target).children().val();
            console.log(value);
            if (select == 'peruntukan') {
                $(target).html(': ' + value);
            } else
            if (select == 'satuan') {
                $(target).html($(target).children().find(':selected').text());
            } else
            if (select == 'jumlah' || select == 'harga') {
                value = value.replace(/\D/g,'');
                $(target).html(value);
            } else {
                $(target).html(value);
            }
        }

        function save(params) {
            id = $(target).parents('tr').attr('id');
            id2 = $(target).parents('tr').attr('id2');
            console.log(id, id2);
            url = "{{route('perlengkapan.pengadaan.saveItem', ["id", 'lap' => 'compek'])}}";
            url = url.replace('id', id);
            url = url.replace('compek', id2);
            console.log(url);

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {select: select, value: value},
                })
                .done(function(hasil) {
                    if (hasil.status == "Gagal Ubah") {
                        alert("Gagal Ubah")
                        target = null;
                    }
                })
                .fail(function() {
                    alert("Gagal Menyimpan");
                    target = null;
                });
        }

        function keyPress (e) {
            console.log("Mitet!!");
            if (edit) {
                if(e.key === "Escape") {
                    $(target).html(ori);
                } else
                if(e.key === "Enter"){
                    unedit();
                    save();
                }

                edit = false;
            }
        }

        @endif
    });

</script>

@endsection

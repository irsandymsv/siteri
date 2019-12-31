@extends('perlengkapan.perlengkapan_view')

@section('page_title', 'Peminjaman Barang')

@section('judul_header', 'Peminjaman Barang')

@section('css_link')
<style type="text/css">
    .hidden {
        display: none important !;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Buat Peminjaman Barang</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'perlengkapan.peminjaman_barang.store', 'id'=>'form']) !!}
                <div id="isiForm" class="table-responsive">
                    <h5>Total Data = <span class="data_count">0</span></h5>
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berakhir</th>
                                <th>Kegiatan</th>
                            </tr>
                            <tr>
                                <td>
                                    {!! Form::date('tanggal_mulai', null, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::date('tanggal_berakhir', null, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::time('jam_mulai', null, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::time('jam_berakhir', null, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::text('kegiatan', null, ['class' => 'form-control']) !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Merk Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
                            <tr>
                                <td>
                                    {!! Form::select('nama_barang[]', $nama_barang, null, ['class' =>
                                    'form-control'])!!}
                                </td>
                                <td>
                                    {!! Form::select('merk_barang[]', $merk_barang, null, ['class' =>
                                    'form-control'])!!}
                                </td>
                                <td>
                                    {!! Form::text('nama_barang', null, ['class' => 'form-control', 'id' =>
                                    'nama_barang']) !!}
                                </td>

                                <td>
                                    {!! Form::text('spesifikasi', null, ['class' => 'form-control', 'id' =>
                                    'spesifikasi']) !!}
                                </td>

                                <td>
                                    {!! Form::text('jumlah', null, ['class' => 'form-control', 'id' => 'jumlah'])
                                    !!}
                                </td>

                                <td>
                                    {!! Form::select('satuan', $satuan, null, ['class' => 'form-control', 'id' =>
                                    'satuan'])!!}
                                </td>

                                <td>
                                    {!! Form::text('harga', null, ['class' => 'form-control', 'id' => 'harga']) !!}
                                </td>

                                <td>
                                    {!! Form::label(null , null, ['class' => 'control-label', 'id' => 'total'])
                                    !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <h5>Total Data = <span class="data_count">0</span></h5>
                </div>
                <button id="tambah" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                <br><br>
                <div class="form-group" style="float: right;">
                    {!! Form::submit('Simpan dan Kirim', [ 'class'=>'btn btn-success', 'id' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="table-responsive">
                <table id="peminjaman_barang" class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Spesifikasi</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th style="width:99.8px">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){

        $('#jumlah, #harga').on('input', function(){
            $('#total').empty();
            jumlah = $('#jumlah').val();
            harga = $('#harga').val();
            $('#total').append('Rp ' + jumlah * harga);
        });

        $('#tambah').click(function(event) {
            nama = $('#nama_barang').val();
            spesifikasi = $('#spesifikasi').val();
            jumlah = $('#jumlah').val();
            satuan = $('#satuan').val();
            harga = $('#harga').val();
            total = $('#total').html();
            data = $('#tbody tr').length;
            $('#tbody').append(`
                <tr id="data">
                    <td>
                        ` + ++data + `
                    </td>

                    <td>
                        ` + nama + `
                    </td>

                    <td>
                        ` + spesifikasi + `
                    </td>

                    <td>
                        ` + jumlah + `
                    </td>

                    <td class="hidden">
                        ` + ++satuan + `
                    </td>

                    <td>
                        ` + harga + `
                    </td>

                    <td>
                        ` + total + `
                    </td>

                    <td>
                        OPSI
                    </td>
                </tr>
            `);

            $('#nama_barang').val('');
            $('#spesifikasi').val('');
            $('#jumlah').val('');
            $('#harga').val('');
            $('#total').html('');
			$(".data_count").text(data);

        });

        $('#submit').click(function(event){
            // event.preventDefault();
            table = $('#tbody tr');
            data = [];
            length = ($('#data td').length - (3 * $('#tbody tr').length))/$('#tbody tr').length;
            $.each(table, function(index, val){
                // val = val + '';
                vall = $(val).text().split(/\s+/);
                vall.shift();
                vall.shift();
                vall.pop();
                vall.pop();
                vall.pop();
                vall.splice($.inArray("Rp", vall),1);
                data.push(vall);
            });
            console.log(data);
            $('#isiForm').empty();
            $('#isiForm').append(`<input type="hidden" name="data" value="` + data + `">`);
            $('#isiForm').append(`<input type="hidden" name="length" value="` + length + `">`);
        });
    });

</script>
@endsection

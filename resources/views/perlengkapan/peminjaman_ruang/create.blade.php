@extends('perlengkapan.perlengkapan_view')

@section('page_title', 'Peminjaman Ruang')

@section('judul_header', 'Peminjaman Ruang')

@section('css_link')
<link href="/adminlte/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
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
                {!! Form::open(['route' => 'perlengkapan.peminjaman_ruang.store', 'id'=>'form']) !!}
                <div id="isiForm" class="table-responsive">
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berakhir</th>
                                <th>Kegiatan</th>
                                <th>Jumlah Peserta</th>
                                <th>Nama Ruang</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
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

                                <td>
                                    {!! Form::text('jumlah_peserta', null, ['class' => 'form-control number']) !!}
                                </td>

                                <td>
                                    {!! Form::select('nama_ruang[]', $nama_ruang, null, ['class' =>
                                    'form-control js-example-basic-multiple', 'multiple' => 'multiple'])!!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br><br>
                <div class="form-group" style="float: right;">
                    {!! Form::submit('Simpan dan Kirim', [ 'class'=>'btn btn-success', 'id' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
    $(function(){

        $('.js-example-basic-multiple').select2();

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


@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Buat Pengadaan')

@section('judul_header', 'Buat Pengadaan')

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
                <h3 class="box-title">Buat Laporan Pengadaan</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'perlengkapan.pengadaan.store', 'id'=>'form']) !!}
                <div id="isiForm" class="table-responsive">
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>🗙</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
                            <span><strong>Peruntukan</strong></span>
                            {!! Form::text('keterangan', null, ['class' => 'form-control', 'required']) !!}
                            <tr>
                                <td>
                                    {!! Form::text('nama_barang[]', null, ['class' => 'form-control', 'required'])
                                    !!}
                                </td>

                                <td>
                                    {!! Form::text('spesifikasi[]', null, ['class' => 'form-control', 'required']) !!}
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', null, ['class' => 'form-control jumlah angka',
                                    'required'])!!}
                                </td>

                                <td>
                                    {!! Form::select('satuan[]', $satuan, null, ['class' => 'form-control',
                                    'required'])!!}
                                </td>

                                <td>
                                    {!! Form::text('harga[]', null, ['class' => 'form-control harga angka', 'required'])
                                    !!}
                                </td>

                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>🗙</th>
                            </tr>
                        </tfoot>
                    </table>

                    <h5>Total Data = <span class="data_count">0</span></h5>
                    <h5>Total Harga = <span class="total">0</span></h5>
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
{{--


<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="table-responsive">
                <table id="pengadaan" class="table table-bordered table-hovered">
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
</div> --}}

@endsection

@section('script')

<script>
    $(function(){

        opsiButton();
        tableCount();
        totaling();

        // $('#jumlah, #harga').on('input', function(){
        //     jumlah = $('#jumlah').val();
        //     harga = $('#harga').val();
        //     $('#total').html('Rp ' + jumlah * harga);
        // });

        $('#tambah').click(function(event) {
                $('#inputan').append(`
                <tr>
                                <td>
                                    {!! Form::text('nama_barang[]', null, ['class' => 'form-control'], 'required') !!}
                                </td>

                                <td>
                                    {!! Form::text('spesifikasi[]', null, ['class' => 'form-control'], 'required') !!}
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', null, ['class' => 'form-control jumlah angka'], 'required')!!}
                                </td>

                                <td>
                                    {!! Form::select('satuan[]', $satuan, null, ['class' => 'form-control'], 'required')!!}
                                </td>

                                <td>
                                    {!! Form::text('harga[]', null, ['class' => 'form-control harga angka'], 'required') !!}
                                </td>

                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                `);

                // inputReset();
                opsiButton();
                tableCount();
                totaling();
        });

        // function inputReset(){
        //     $('#nama_barang').val('');
        //         $('#spesifikasi').val('');
        //         $('#jumlah').val('');
        //         $('#satuan').val(0);
        //         $('#harga').val('');
        //         $('#total').html('');
        // }

        function tableCount(){
            data = $('#inputan tr').length;
            $(".data_count").text(data);
        }

        // $('#form').submit(function(event){
        //     event.stopPropagation();
        //     $("form#form :input").each(function () {
        //         if ($(this).attr('name') === 'satuan[]') {
        //             $(this).val($(this).val()+1);
        //         }
        //     });
        //     return true;
        //     tableData = $('#tbody tr');
        //     table = $('#tbody').html();
        //     data = [];
        //     length = ($('.data td').length - (3 * $('#tbody tr').length))/$('#tbody tr').length;
        //     $.each(tableData, function(index, val){
        //         // val = val + '';
        //         vall = $(val).text().split(/\s+/);
        //         vall.shift();
        //         vall.shift();
        //         vall.pop();
        //         vall.pop();
        //         vall.pop();
        //         // vall.splice($.inArray("Rp", vall),1);
        //         data.push(vall);
        //     });
        //     console.log(data, length);
        //     $('#isiForm').empty();
        //     $('#isiForm').append(`<input type="hidden" name="data" value="` + data + `">`);
        //     $('#isiForm').append(`<input type="hidden" name="length" value="` + length + `">`);
        //     $('#isiForm').append(`<input type="hidden" name="table" value='` + table + `''>`);
        // });

        function opsiButton(){
            $('.fa.fa-trash').click(function(){
                if (data > 1) {
                    $(this).parents('tr').remove();
                    tableCount();
                }
                totaling();
            });
        }

        function totaling(){
            $('.jumlah, .harga').change(function(){
                jumlah = [];
                harga = [];
                total = 0;
                $('.jumlah').each(function(){
                    jumlah.push($(this).val() - 0);
                    // console.log("===============================")
                    // console.log("Jumlah "+$(this).val());
                    // console.log("===============================")
                });
                $('.harga').each(function(){
                    harga.push($(this).val() - 0);
                    // console.log("Harga "+$(this).val());
                });
                $("#inputan tr").each(function(key){
                    total += ((jumlah[key]) * (harga[key]));
                    console.log("Total "+total);
                    // console.log("Key "+key);
                    // console.log("Jumlah "+jumlah[key]);
                    // console.log("Harga "+harga[key]);
                });
                $('.total').text(total);
                console.log(jumlah);
                console.log(harga);
                // harga = $('#harga').val();
                // $('#total').html('Rp ' + jumlah * harga);
            });
        }
    });

</script>

@endsection

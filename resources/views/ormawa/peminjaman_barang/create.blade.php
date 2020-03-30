@extends('layouts.template')

@section('side_menu')
@include('include.ormawa_menu')
@endsection

@section('page_title', 'Buat Laporan Peminjaman Barang')

@section('judul_header', 'Peminjaman Barang')

@section('css_link')
<link href="{{ asset('/adminlte/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('/adminlte/dist/css/AdminLTE.min.css') }}">
<link href="{{ asset('/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
<link href="{{ asset('/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"
    rel="stylesheet" />
<link href="{{ asset('/adminlte/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet" />
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
            <div class="box-header with-border">
                <h3 class="box-title">Buat Laporan Peminjaman Barang</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'ormawa.peminjaman_barang.store', 'id'=>'form']) !!}
                <div id="isiForm" class="table-responsive">
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal/Jam</th>
                                <th>Kegiatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    {!! Form::text('tanggal', null, ['class' => 'form-control not-rounded-border', 'id'
                                    => 'reservationtime']) !!}
                                </td>

                                <td>
                                    {!! Form::text('kegiatan', null, ['class' => 'form-control']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Merk Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>🗙</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
                            <tr>
                                <td>
                                    <select id="barang1" name="barang[]" class="form-control barang select2"
                                        style="width: 100%">
                                        <option value="null">Pilih Barang</option>
                                        @foreach ($barang as $val)
                                        <option value="{{ $val->id }}">{{ $val->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="merk">
                                    <select id="merk_barang1" name="merk_barang[]"
                                        class="form-control merk_barang select2" style="width: 100%" disabled="true">
                                    </select>
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', null, ['class' => 'form-control jumlah angka'])
                                    !!}
                                </td>

                                <td>
                                    {!! Form::select('satuan[]', $satuan, null, ['class' => 'form-control'])!!}
                                </td>

                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Merk Barang</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>🗙</th>
                            </tr>
                        </tfoot>
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
@endsection

@section('script')
<script src="{{ asset('/adminlte/bower_components/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
</script>
<script src="{{ asset('/adminlte/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script>
    var dataAjax = null;
    $(function(){

        opsiButton();
        tableCount();
        barangAjax();
        maxJumlah();

        $('#barang1, #merk_barang1').select2();

        $('.js-example-basic-multiple').select2();

        $('#reservation').daterangepicker();

        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 15,
            minDate: moment().add(1, "days"),
            locale: { format: 'YYYY/MM/DD HH:mm:ss' }
        });

        $('.datepicker').datepicker({
            autoclose: true,
            // format: 'yyyy-mm-dd'
        });

        $('.timepicker').timepicker({
            showInputs: false
        });

        count = 1;
        $('#tambah').click(function(event) {
            count++;

            $('#inputan').append(`
                <tr>
                    <td>
                        <select id="barang`+count+`" name="barang[]" class="form-control barang select2" style="width: 100%">
                            <option value="">Pilih Barang</option>
                            @foreach ($barang as $val)
                            <option value="{{ $val->id }}">{{$val->nama_barang}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="merk">
                        <select id="merk_barang`+count+`" name="merk_barang[]" class="form-control merk_barang select2" style="width: 100%" disabled="true">
                        </select>
                    </td>

                    <td>
                        {!! Form::text('jumlah[]', null, ['class' => 'form-control jumlah angka'])
                        !!}
                    </td>

                    <td>
                        {!! Form::select('satuan[]', $satuan, null, ['class' => 'form-control', 'id' =>
                        'satuan'])!!}
                    </td>

                    <td>
                        {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                    </td>
                </tr>
            `);
            $('#barang'+count+', #merk_barang'+count).select2();

            compek = $('#inputan').children().last();
            $($($(compek)[0]).children().first()).children().select2();

            // console.log(compek.children('.select2'));
            // $('.select2').select2();
            opsiButton();
            tableCount();
            barangAjax();
            maxJumlah();
        });

        function barangAjax(){
            $('.barang').on('change', function(){
                var id = $(this).val();
                jumlah = $('.jumlah').val();

                // console.log($(this).parents('tr'));
                // console.log($(this).parents('tr')["0"].children[1]);
                merk = $(this).parents('tr').children('.merk').children('.merk_barang');
                // console.log($(this).parents('tr').children('.merk').children());
                // console.log($(this).parents('tr').children('.merk_barang'));

                if(id) {
                    $.ajax({
                        url: "/ormawa/peminjaman_barang/barang/" + id,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            dataAjax = data;
                            $(merk).empty();
                            $(merk).prop('disabled', false);
                            // console.log(data);
                            i = -1;
                            $(merk).append('<option> Pilih Merk Barang </option>');
                            $.each(data, function(key, value) {
                                i++;
                                // console.log(value, key);
                                $(merk).append('<option value="'+ value.id +'">(' + data.jumlah[i] + ') ' + value.merk_barang + '</option>');
                            });
                            $(merk).children().last().remove();
                            // console.log(merk);
                        }
                    });
                } else {
                    $(merk).prop('disabled', true);
                    $(this).parents('tr').children('.merk_barang').empty();
                }

            });
        }

        function maxJumlah(){
            $('.jumlah').on('input', function(){
                max = $($(this).parents('tr').children()[1]).children('.merk_barang').select2('data')[0].text;
                if ($($(this).parents('tr').children()[1]).children('.merk_barang').select2('data')[0].text){
                    max = max.split(" ");
                    max = max[0];
                    max = max.split("(")[1];
                    max = max.split(")")[0];

                    if($(this).val()-0 >= max) {
                        $(this).val(max);
                    }
                }
            });
        }

        function tableCount(){
            data = $('#inputan tr').length;
            $(".data_count").text(data);
        }

        function opsiButton(){
            $('.fa.fa-trash').click(function(){
                if (data > 1) {
                    $(this).parents('tr').remove();
                    tableCount();
                }
            });
        }
    });

</script>
@endsection

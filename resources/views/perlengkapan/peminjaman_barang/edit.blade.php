@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Peminjaman Barang')

@section('judul_header', 'Ubah Laporan Peminjaman Barang')

@section('css_link')
<link href="/adminlte/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
<link href="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<link href="/adminlte/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
<style type="text/css">
    .hidden {
        display: none important !;
    }
</style>
@endsection

@section('content')
{{-- @php
$status = $status[0];
@endphp --}}
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Ubah Laporan Peminjaman Barang</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => ['perlengkapan.peminjaman_barang.update', $laporan->id], 'method' => 'PUT',
                'id'=>'form']) !!}
                <div id="isiForm" class="table-responsive">
                    {{-- @if ($status) --}}
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
                                    {!! Form::text('tanggal', $tanggal, ['class' => 'form-control not-rounded-border',
                                    'id' => 'reservationtime']) !!}
                                </td>
                                <td>
                                    {!! Form::text('kegiatan', $laporan->kegiatan, ['class' => 'form-control']) !!}
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
                            {!! Form::hidden('laporan', true) !!}
                            @php $i = 0 @endphp
                            @foreach($laporan->detail_pinjam_barang as $item)
                            {{-- @dump($item) --}}
                            <tr>
                                <td>
                                    <select id="barang1" name="barang[]" class="form-control barang select2"
                                        style="width: 100%">
                                        <option value="">Pilih Barang</option>
                                        @foreach ($barang as $val)
                                        <option value="{{ $val->id }}"
                                            {{ ($val->id == $item->detail_data_barang->idbarang_fk) ? 'selected' : '' }}>
                                            {{ $val->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="merk">
                                    <select id="merk_barang1" name="merk_barang[]"
                                        class="form-control merk_barang select2" style="width: 100%">
                                        @foreach ($merk[$i] as $val)
                                        <option value="{{ $val->id }}"
                                            {{ ($val->id == $item->iddetail_data_barang_fk) ? 'selected' : '' }}>
                                            {{ $val->merk_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', $item->jumlah, ['class' => 'form-control angka', 'id' =>
                                    'jumlah'])
                                    !!}
                                </td>

                                <td>
                                    {!! Form::select('satuan[]', $satuan, $item->idsatuan_fk-1, ['class' =>
                                    'form-control', 'id' =>
                                    'satuan'])!!}
                                </td>

                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                            @php $i++ @endphp
                            @endforeach

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

                    <button id="tambah" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                    <br><br>
                    {{-- Edit 1 Item --}}
                    {{-- @else
                    <div class="">
                        <table class="tabel-keterangan">
                            <tr>
                                <td><b>Tanggal Mulai</b></td>
                                <td>: {{$laporan->peminjaman_barang->tanggal_mulai}}</td>
                    </tr>
                    <tr>
                        <td><b>Tanggal Berakhir</b></td>
                        <td>: {{$laporan->peminjaman_barang->tanggal_berakhir}}</td>
                    </tr>
                    <tr>
                        <td><b>Jam Mulai</b></td>
                        <td>: {{$laporan->peminjaman_barang->jam_mulai}}</td>
                    </tr>
                    <tr>
                        <td><b>Jam Berakhir</b></td>
                        <td>: {{$laporan->peminjaman_barang->jam_berakhir}}</td>
                    </tr>
                    <tr>
                        <td><b>Kegiatan</b></td>
                        <td>: {{$laporan->peminjaman_barang->kegiatan}}</td>
                    </tr>
                    </table>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="inventaris" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Merk Barang</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                            <tr id="lap_{{ $laporan->id }}">
                                {!! Form::hidden("id", $laporan->idpinjam_barang_fk) !!}
                                {!! Form::hidden("idmerk", $laporan->iddetail_data_barang_fk) !!}
                                <td>
                                    <select id="barang" name="barang[]" class="form-control barang">
                                        <option value="">Pilih Barang</option>
                                        @foreach ($barang as $val)
                                        <option value="{{ $val->id }}"
                                            {{ ($val->id == $laporan->detail_data_barang->idbarang_fk) ? 'selected' : '' }}>
                                            {{ $val->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td class="merk">
                                    <select id="merk_barang" name="merk_barang[]" class="form-control merk_barang">
                                        @foreach ($merk[$i] as $val)
                                        <option value="{{ $val->id }}"
                                            {{ ($val->id == $laporan->iddetail_data_barang_fk) ? 'selected' : '' }}>
                                            {{ $val->merk_barang }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', $laporan->jumlah, ['class' => 'form-control angka', 'id'
                                    =>
                                    'jumlah'])
                                    !!}
                                </td>

                                <td>
                                    {!! Form::select('satuan[]', $satuan, $laporan->idsatuan_fk-1, ['class' =>
                                    'form-control', 'id' =>
                                    'satuan'])!!}
                                </td>

                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                            @php $i++ @endphp
                        </tbody>
                    </table>
                </div>
                @endif --}}
                <div class="form-group" style="float: right;">
                    {!! Form::submit('Simpan dan Kirim', [ 'class'=>'btn btn-success', 'id' => 'submit']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
</div>
@endsection

{{-- @if ($status) --}}
@section('script')
<script src="/adminlte/bower_components/select2/dist/js/select2.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    var dataAjax = null;
    $(function(){

        opsiButton();
        tableCount();
        barangAjax();

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
        });

        function barangAjax(){
            $('.barang').on('change', function(){
                var id = $(this).val();

                // console.log($(this).parents('tr'));
                // console.log($(this).parents('tr')["0"].children[1]);
                merk = $(this).parents('tr').children('.merk').children('.merk_barang');
                // console.log($(this).parents('tr').children('.merk').children());
                // console.log($(this).parents('tr').children('.merk_barang'));

                if(id) {
                    $.ajax({
                    url: "/perlengkapan/peminjaman_barang/barang/" + id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        dataAjax = data;
                        $(merk).empty();
                        $(merk).prop('disabled', false);
                        $.each(data, function(key, value) {
                            $(merk).append('<option value="'+ value.id +'">' + value.merk_barang + '</option>');
                        });
                        // console.log(merk);
                    }
                });
                } else {
                    $(merk).prop('disabled', true);
                    $(this).parents('tr').children('.merk_barang').empty();
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
{{-- @endif --}}

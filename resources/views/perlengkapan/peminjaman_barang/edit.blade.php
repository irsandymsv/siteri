@extends('perlengkapan.perlengkapan_view')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Peminjaman Barang')

@section('judul_header', 'Ubah Laporan Peminjaman Barang')

@section('css_link')
<link href="/adminlte/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
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
                    {{-- Form Edit Laporan --}}
                    @if ($status)
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Berakhir</th>
                                <th>Jam Mulai</th>
                                <th>Jam Berakhir</th>
                                <th>Kegiatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    {!! Form::date('tanggal_mulai', $laporan->tanggal_mulai, ['class' => 'form-control
                                    tanggal']) !!}
                                </td>

                                <td>
                                    {!! Form::date('tanggal_berakhir', $laporan->tanggal_berakhir, ['class' =>
                                    'form-control tanggal']) !!}
                                </td>

                                <td>
                                    {!! Form::time('jam_mulai', $laporan->jam_mulai, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::time('jam_berakhir', $laporan->jam_berakhir, ['class' => 'form-control'])
                                    !!}
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
                            @foreach($laporan->detail_pinjam_barang as $item)
                            <tr>
                                <td>
                                    <select id="barang" name="barang[]" class="form-control barang select2">
                                        @foreach ($barang as $val)
                                        <option value="{{ $val->id }}" onchange="{{ $val->nama_barang }}">
                                            {{ $item->idbarang_fk-1 }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                <td>
                                    <select id="merk_barang" name="merk_barang[]"
                                        class="form-control merk_barang select2" disabled="true">
                                    </select>
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', $item->jumlah, ['class' => 'form-control', 'id' =>
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
                    @else
                    <div class="">
                        <table class="tabel-keterangan">
                            <tr>
                                <td><b>Tanggal Mulai</b></td>
                                <td>: {{$laporan->detail_pinjam_barang->tanggal_mulai}}</td>
                            </tr>
                            <tr>
                                <td><b>Tanggal Berakhir</b></td>
                                <td>: {{$laporan->detail_pinjam_barang->tanggal_berakhir}}</td>
                            </tr>
                            <tr>
                                <td><b>Jam Mulai</b></td>
                                <td>: {{$laporan->detail_pinjam_barang->jam_mulai}}</td>
                            </tr>
                            <tr>
                                <td><b>Jam Berakhir</b></td>
                                <td>: {{$laporan->detail_pinjam_barang->jam_berakhir}}</td>
                            </tr>
                            <tr>
                                <td><b>Kegiatan</b></td>
                                <td>: {{$laporan->detail_pinjam_barang->kegiatan}}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="peminjaman_barang" class="table table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Merk Barang</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="lap_{{ $laporan->id }}">
                                    <td>
                                        <select id="barang" name="barang[]" class="form-control barang">
                                            @foreach ($barang as $val)
                                            <option value="{{ $val->id }}" onchange="{{ $val->nama_barang }}">
                                                {{ $laporan->idbarang_fk-1 }}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select id="merk_barang" name="merk_barang[]" class="form-control merk_barang"
                                            disabled="true">
                                        </select>
                                    </td>

                                    <td>
                                        {!! Form::text('jumlah[]', $laporan->jumlah, ['class' => 'form-control', 'id' =>
                                        'jumlah'])
                                        !!}
                                    </td>

                                    <td>
                                        {!! Form::select('satuan[]', $satuan, $laporan->idsatuan_fk-1, ['class' =>
                                        'form-control', 'id' =>
                                        'satuan'])!!}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
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

        $('.select2').select2();

        $('.js-example-basic-multiple').select2();

        $('#reservation').daterangepicker();

        $('.datepicker').datepicker({
            autoclose: true,
            // format: 'yyyy-mm-dd'
        });

        $('.timepicker').timepicker({
            showInputs: false
        });

        $('#tambah').click(function(event) {
            $('#inputan').append(`
                <tr>
                    <td>
                        <select id="barang" name="barang[]" class="form-control barang">
                            <option value="">Pilih Barang</option>
                            @foreach ($barang as $val)
                            <option value="{{ $val->id }}" onchange="{{ $val->barang }}">
                                {{$val->nama_barang}}</option>
                            @endforeach
                        </select>
                    </td>

                    <td class="merk">
                        <select id="merk_barang" name="merk_barang[]" class="form-control merk_barang select2" style="width: 100%;" disabled="true">
                        </select>
                    </td>

                    <td>
                        {!! Form::text('jumlah', null, ['class' => 'form-control angka', 'id' => 'jumlah'])
                        !!}
                    </td>

                    <td>
                        {!! Form::select('satuan[]', $satuan, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' =>
                        'satuan'])!!}
                    </td>

                    <td>
                        {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                    </td>
                </tr>
            `);

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
                // ruang = $(this).parents('tr').children('.ruang').children('#nama_ruang');
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

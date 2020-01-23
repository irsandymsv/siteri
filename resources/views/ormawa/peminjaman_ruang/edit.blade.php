@extends('perlengkapan.perlengkapan_view')

@section('page_title', 'Peminjaman Ruang')

@section('judul_header', 'Ubah Laporan Peminjaman Ruang')

@section('css_link')
<link href="/adminlte/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
<link href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet" />
<link href="/adminlte/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
<style type="text/css">
    .hidden {
        display: none important !;
    }

    .not-rounded-border {
        border-radius: 0;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Ubah Laporan Peminjaman Ruang</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => ['perlengkapan.peminjaman_ruang.update', $laporan->id], 'method' => 'PUT',
                'id'=>'form']) !!}
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
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    {!! Form::text('tanggal_mulai', $laporan->tanggal_mulai, ['class' => 'form-control datepicker not-rounded-border']) !!}
                                </td>

                                <td>
                                    {!! Form::text('tanggal_berakhir', $laporan->tanggal_berakhir, ['class' => 'form-control datepicker not-rounded-border']) !!}
                                </td>

                                <td>
                                    {{-- {!! Form::text('jam_mulai', null, ['class' => 'form-control timepicker']) !!} --}}
                                    {!! Form::time('jam_mulai', $laporan->jam_mulai, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {{-- {!! Form::text('jam_berakhir', null, ['class' => 'form-control timepicker']) !!} --}}
                                    {!! Form::time('jam_berakhir', $laporan->jam_berakhir, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::text('kegiatan', $laporan->kegiatan, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::text('jumlah_peserta', $laporan->jumlah_peserta, ['class' => 'form-control angka']) !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nama Ruang</th>
                                <th>🗙</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
                            {!! Form::hidden('laporan', true) !!}
                            @foreach($laporan->detail_pinjam_ruang as $item)
                            <tr>
                                <td>
                                    {!! Form::select('nama_ruang[]', $nama_ruang, $item->idruang_fk-1, ['class' =>
                                    'form-control'])!!}
                                </td>
                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h5>Total Data = <span class="data_count">0</span></h5>

                    <button id="tambah" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                    <br><br>
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
<script src="/adminlte/bower_components/select2/dist/js/select2.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    $(function(){

        $('.js-example-basic-multiple').select2();

        $('#reservation').daterangepicker();

        $('.datepicker').datepicker({
            autoclose: true,
            // format: 'yyyy-mm-dd'
        });

        $('.timepicker').timepicker({
            showInputs: false
        });

        opsiButton();
        tableCount();

        $('#tambah').click(function(event) {
            $('#inputan').append(`
                <tr>
                    <td>
                        {!! Form::select('nama_ruang[]', $nama_ruang, $item->idruang_fk-1, ['class' =>
                        'form-control'])!!}
                    </td>
                    <td>
                        {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                    </td>
                </tr>
            `);

            opsiButton();
            tableCount();
        });

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


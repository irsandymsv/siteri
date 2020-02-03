@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

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
                                <th>Tanggal/Jam</th>
                                <th>Kegiatan</th>
                                <th>Jumlah Peserta</th>
                                <th>Nama Ruang</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
                            {!! Form::hidden('laporan', true) !!}
                            <tr>
                                <td style="min-width:300px">
                                    {!! Form::text('tanggal', $tanggal, ['class' => 'form-control not-rounded-border', 'id' => 'reservationtime']) !!}
                                </td>

                                <td style="min-width:300px">
                                    {!! Form::text('kegiatan', $laporan->kegiatan, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::text('jumlah_peserta', $laporan->jumlah_peserta, ['class' => 'form-control jumlah
                                    angka']) !!}
                                </td>
                                <td class="ruang">
                                    <select id="nama_ruang" name="nama_ruang[]"
                                        class="form-control not-rounded-border js-example-basic-multiple"
                                        multiple="multiple">
                                        @foreach ($ruang as $val)
                                        <option value="{{ $val->id }}" {{ (in_array($val->id, $nama_ruang) ? 'selected' : '') }} >({{$val->kuota}}) {{$val->nama_ruang}}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>Jumlah Kuota : <span class="jumlah_kuota">0</span></label>
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
<script src="/adminlte/bower_components/select2/dist/js/select2.min.js"></script>
<script src="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    $(function(){

        $('.js-example-basic-multiple').select2();

        $('#reservation').daterangepicker();

        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
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

        $('#nama_ruang, .jumlah').on('change', function(){
            ruang = $("#nama_ruang").val();
            jumlah = $('.jumlah').val();
            console.log(jumlah);
            total = 0;

            data = $("#nama_ruang").select2('data');


            $(data).each(function(bla, nama_ruang){
                console.log(nama_ruang.text);
                nama_ruang = nama_ruang.text.split(" ");
                nama_ruang = nama_ruang[0];
                nama_ruang = nama_ruang.split("(")[1];
                nama_ruang = nama_ruang.split(")")[0];
                total += nama_ruang-0;
            });
            console.log(total);
                    console.log(data.length);

            if(total >= jumlah-0){
                $("#nama_ruang").select2({
                    maximumSelectionLength: data.length
                    // formatSelectionTooBig: function (limit) {

                    //     $('#box').show().text('Callback!');

                    //     return 'Too many selected elements (' + limit + ')';
                    // }
                });
            } else {
                $("#nama_ruang").select2({
                    maximumSelectionLength: 999
                });
            }

            $('.jumlah_kuota').text(total);
        });

    });

</script>
@endsection

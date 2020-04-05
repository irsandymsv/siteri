@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Buat Data Ruang')

@section('judul_header', 'Ruang')

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
            <div class="box-header with-border">
                <h3 class="box-title">Buat Data Ruang</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'perlengkapan.ruang.store', 'id'=>'form']) !!}
                <div id="isiForm" class="table-responsive">
                    {{-- Buat laporan baru --}}
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode Ruang</th>
                                <th>Nama Ruang</th>
                                <th>Kuota</th>
                                <th>🗙</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
                            <tr>
                                <td>
                                    {!! Form::text('kode_ruang[]', null, ['class' => 'form-control'])
                                    !!}
                                </td>
                                <td>
                                    {!! Form::text('nama_ruang[]', null, ['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    {!! Form::text('kuota[]', null, ['class' => 'form-control angka'])!!}
                                </td>
                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Kode Ruang</th>
                                <th>Nama Ruang</th>
                                <th>Kuota</th>
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

<script>
    $(function(){

        opsiButton();
        tableCount();

        $('#tambah').click(function(event) {
            $('#inputan').append(`
                <tr>
                    <td>
                        {!! Form::text('kode_ruang[]', null, ['class' => 'form-control'])
                        !!}
                    </td>
                    <td>
                        {!! Form::text('nama_ruang[]', null, ['class' => 'form-control']) !!}
                    </td>
                    <td>
                        {!! Form::text('kuota[]', null, ['class' => 'form-control angka'])!!}
                    </td>
                    <td>
                        {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                    </td>
                </tr>
            `);

            // inputReset();
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
@extends('perlengkapan.perlengkapan_view')

@section('page_title', 'Inventaris')

@section('judul_header', 'Buat Inventaris')

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
                <h3 class="box-title">Buat Data Inventaris</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => 'perlengkapan.inventaris.store', 'id'=>'form']) !!}
                <div id="isiForm" class="table-responsive">
                    {{-- Buat laporan baru --}}
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    {!! Form::text('kode_barang', old('kode_barang'), ['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    {!! Form::text('nama_barang', null, ['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    {!! Form::select('status', $status, null, ['class' =>
                                    'form-control'])!!}
                                    {{-- <select name="status[]" class="form-control status">
                                        @foreach ($status as $val)
                                        <option value="{{ $val->id }}">{{$val->status}}</option>
                                        @endforeach
                                    </select> --}}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Merk Barang</th>
                                <th>Ruang</th>
                                <th>🗙</th>
                            </tr>
                        </thead>

                        <tbody id="inputan">
                            <tr>
                                <td>
                                    {!! Form::date('tanggal[]', null, ['class' => 'form-control tanggal'])!!}
                                </td>
                                <td>
                                    {!! Form::text('merk_barang[]', null, ['class' => 'form-control merk_barang'])!!}
                                </td>

                                <td>
                                    {!! Form::select('nama_ruang[]', $nama_ruang, null, ['class' =>
                                    'form-control'])!!}
                                </td>

                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tanggal</th>
                                <th>Merk Barang</th>
                                <th>Ruang</th>
                                <th>Status</th>
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
                        {!! Form::date('tanggal[]', null, ['class' => 'form-control tanggal'])!!}
                    </td>
                    <td>
                        {!! Form::text('merk_barang[]', null, ['class' => 'form-control merk_barang'])!!}
                    </td>

                    <td>
                        {!! Form::select('nama_ruang[]', $nama_ruang, null, ['class' => 'form-control'])!!}
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

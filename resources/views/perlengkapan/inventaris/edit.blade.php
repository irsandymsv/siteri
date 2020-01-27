@extends('perlengkapan.perlengkapan_view')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Ubah Data Inventaris')

@section('judul_header', 'Ubah Data Inventaris')

@section('content')
@php
// $laporan = ($status) ? $laporan[0] : $laporan ;
$laporan = $laporan[0];
// dd($laporan);
@endphp
{{-- @dump($laporan->inventaris) --}}
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Ubah Data Inventaris</h3>
            </div>

            <div class="box-body">
                {{-- @dump($barang) --}}
                {!! Form::open(['route' => ['perlengkapan.inventaris.update', $barang->id], 'method' => 'PUT',
                'id'=>'form'])!!}
                {{-- {{dd($barang)}} --}}
                <div id="isiForm" class="table-responsive">
                    {{-- Form Edit Laporan --}}
                    @if ($laporan)
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
                                    {!! Form::text('kode_barang', $barang->kode_barang, ['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    {!! Form::text('nama_barang', $barang->nama_barang, ['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    {!! Form::select('status', $status, $barang->idstatus_fk-1, ['class' =>
                                    'form-control'])!!}
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
                            {!! Form::hidden('barang', true) !!}
                            @foreach($barang->detail_data_barang as $item)
                            <tr>
                                <td>
                                    {!! Form::date('tanggal[]', $item->tanggal, ['class' => 'form-control tanggal'])!!}
                                </td>
                                <td>
                                    {!! Form::text('merk_barang[]', $item->merk_barang, ['class' => 'form-control
                                    merk_barang'])!!}
                                </td>

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
                        <tfoot>
                            <tr>
                                <th>Tanggal</th>
                                <th>Merk Barang</th>
                                <th>Ruang</th>
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
                                <td><b>Kode Barang</b></td>
                                <td>: {{$barang->data_barang->kode_barang}}</td>
                            </tr>
                            <tr>
                                <td><b>Nama Barang</b></td>
                                <td>: {{$barang->data_barang->nama_barang}}</td>
                            </tr>
                            <tr>
                                <td><b>Status</b></td>
                                <td>: {{$barang->data_barang->status_barang->status}}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="inventaris" class="table table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Merk Barang</th>
                                    <th>Ruang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="lap_{{ $barang->id }}">
                                    {!! Form::hidden("id", $barang->idbarang_fk) !!}
                                    <td>
                                        {!! Form::date('tanggal', $barang->tanggal, ['class' => 'form-control
                                        tanggal'])!!}
                                    </td>
                                    <td>
                                        {!! Form::text('merk_barang', $barang->merk_barang, ['class' => 'form-control
                                        merk_barang'])!!}
                                    </td>
                                    <td>
                                        {!! Form::select('nama_ruang', $nama_ruang, $barang->idruang_fk-1, ['class' =>
                                        'form-control'])!!}
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

@if ($status)
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
@endif

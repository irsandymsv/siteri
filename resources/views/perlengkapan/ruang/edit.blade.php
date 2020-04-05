@extends('layouts.template')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Ubah Data Ruang')

@section('judul_header', 'Ruang')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ubah Data Ruang</h3>
            </div>

            <div class="box-body">
                {{-- @dump($ruang) --}}
                {!! Form::open(['route' => ['perlengkapan.ruang.update', $ruang->id], 'method' => 'PUT',
                'id'=>'form'])!!}
                {{-- {{dd($barang)}} --}}
                <div id="isiForm" class="table-responsive">
                    {{-- Form Edit Laporan --}}
                    <table id="tbl-data" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Kode Ruang</th>
                                <th>Nama Ruang</th>
                                <th>Kuota</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>
                                    {!! Form::text('kode_ruang', $ruang->kode_ruang, ['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    {!! Form::text('nama_ruang', $ruang->nama_ruang, ['class' => 'form-control']) !!}
                                </td>
                                <td>
                                    {!! Form::text('kuota', $ruang->kuota, ['class' => 'form-control angka'])!!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
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

@endsection
@extends('perlengkapan.perlengkapan_view')

@section('side_menu')
@include('include.perlengkapan_menu')
@endsection

@section('page_title', 'Ubah Data Pengadaan')

@section('judul_header', 'Ubah Data Pengadaan')

@section('css_link')
<style type="text/css">
    .hidden {
        display: none important !;
    }
</style>
@endsection

@section('content')
@php
$laporan = $laporan[0];
// dd($laporan);
@endphp
{{-- @dump($laporan->pengadaan) --}}
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Ubah Laporan Pengadaan</h3>
            </div>

            <div class="box-body">
                {!! Form::open(['route' => ['perlengkapan.pengadaan.update', $laporan->id], 'method' => 'PUT' ,
                'id'=>'form'])!!}
                <div id="isiForm" class="table-responsive">
                    {{-- Form Edit Laporan --}}
                    @if ($status)
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
                            {!! Form::hidden('laporan', true) !!}
                            <span><strong>Peruntukan</strong></span>{!! Form::text('keterangan', $laporan->keterangan,
                            ['class' =>
                            'form-control']) !!}
                            @foreach ($laporan->pengadaan as $item)
                            <tr>
                                <td>
                                    {!! Form::text('nama_barang[]', $item->nama_barang, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::text('spesifikasi[]', $item->spesifikasi, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', $item->jumlah, ['class' => 'form-control jumlah
                                    angka'])!!}
                                </td>

                                <td>
                                    {!! Form::select('satuan[]', $satuan, $item->id_satuan-1, ['class' =>
                                    'form-control'])!!}
                                </td>

                                <td>
                                    {!! Form::text('harga[]', $item->harga, ['class' => 'form-control harga angka'])
                                    !!}
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
                    <button id="tambah" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                    <br><br>

                    {{-- Edit 1 Item --}}
                    @else
                    <div class="">
                        <table class="tabel-keterangan">
                            <tr>
                                <td><b>Tanggal Dibuat</b></td>
                                <td>: {{$laporan->laporan_pengadaan->created_at}}</td>
                            </tr>
                            <tr>
                                <td><b>Terakhir Diubah</b></td>
                                <td>: {{$laporan->laporan_pengadaan->updated_at}}</td>
                            </tr>
                            <tr>
                                <td><b>Peruntukan</b></td>
                                <td>: {{$laporan->laporan_pengadaan->keterangan}}</td>
                            </tr>
                            <tr>
                                <td><b>Status</b></td>
                                <td>:
                                    @switch($laporan->laporan_pengadaan->verif_wadek2)
                                    @case(1)
                                    <label class="label bg-red">Ditolak</label>
                                    @break
                                    @case(2)
                                    <label class="label bg-green">Disetujui</label>
                                    @break
                                    @default
                                    Belum Diverifikasi
                                    @endswitch
                                </td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="pengadaan" class="table table-bordered table-hovered">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Spesifikasi</th>
                                    <th>Jumlah</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                {!! Form::hidden("id", $laporan->laporan_pengadaan->id) !!}
                                <tr id="lap_{{ $laporan->id }}">
                                    <td>{!! Form::text('nama_barang', $laporan->nama_barang, ['class' =>
                                        'form-control']) !!}</td>
                                    <td>{!! Form::text('spesifikasi', $laporan->spesifikasi, ['class' =>
                                        'form-control']) !!}</td>
                                    <td>{!! Form::text('jumlah', $laporan->jumlah, ['class' => 'form-control']) !!}
                                    </td>
                                    <td>{!! Form::select('satuan', $satuan, $laporan->id_satuan-1, ['class' =>
                                        'form-control'])!!}</td>
                                    <td>{!! Form::text('harga', $laporan->harga, ['class' => 'form-control']) !!}</td>
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
        totaling();

        $('#tambah').click(function(event) {
                $('#inputan').append(`
                <tr>
                                <td>
                                    {!! Form::text('nama_barang[]', null, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::text('spesifikasi[]', null, ['class' => 'form-control']) !!}
                                </td>

                                <td>
                                    {!! Form::text('jumlah[]', null, ['class' => 'form-control jumlah angka'])!!}
                                </td>

                                <td>
                                    {!! Form::select('satuan[]', $satuan, null, ['class' => 'form-control'])!!}
                                </td>

                                <td>
                                    {!! Form::text('harga[]', null, ['class' => 'form-control harga angka']) !!}
                                </td>

                                <td>
                                    {!! Form::button(null , [ 'class'=>'fa fa-trash btn btn-danger']) !!}
                                </td>
                            </tr>
                `);

                opsiButton();
                tableCount();
                totaling();
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
                totaling();
            });
        }

        function totaling(){
            jumlah = [];
            harga = [];
            total = 0;
            $('.jumlah').each(function(){
                jumlah.push($(this).val() - 0);
            });
            $('.harga').each(function(){
                harga.push($(this).val() - 0);
            });
            $("#inputan tr").each(function(key){
                total += ((jumlah[key]) * (harga[key]));
                console.log("Total "+total);
            });
            $('.total').text(total);
            console.log(jumlah);
            console.log(harga);
            $('.jumlah, .harga').change(function(){
                jumlah = [];
                harga = [];
                total = 0;
                $('.jumlah').each(function(){
                    jumlah.push($(this).val() - 0);
                });
                $('.harga').each(function(){
                    harga.push($(this).val() - 0);
                });
                $("#inputan tr").each(function(key){
                    total += ((jumlah[key]) * (harga[key]));
                    console.log("Total "+total);
                });
                $('.total').text(total);
                console.log(jumlah);
                console.log(harga);
            });
        }
    });

</script>

@endsection
@endif

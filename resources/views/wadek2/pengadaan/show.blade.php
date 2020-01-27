@extends('wadek2.wadek2_view')

@section('side_menu')
@include('include.wadek2_menu')
@endsection

@section('page_title', 'Laporan Pengadaan')

@section('judul_header', 'Laporan Pengadaan')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div
            class="{{ ($laporan->verif_wadek2 == 0) ? "box box-primary" : (($laporan->verif_wadek2 == 1) ? "box box-danger" : "box box-success") }}">
            <div class="box-header">
                <h3 class="box-title">Data Pengadaan</h3>
            </div>

            <div class="box-body">
                <div class="">
                    <table class="tabel-keterangan">
                        <tr>
                            <td><b>Tanggal Dibuat</b></td>
                            <td>: {{$laporan->created_at}}</td>
                        </tr>
                        <tr>
                            <td><b>Terakhir Diubah</b></td>
                            <td>: {{$laporan->updated_at}}</td>
                        </tr>
                        <tr>
                            <td><b>Peruntukan</b></td>
                            <td>: {{$laporan->keterangan}}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>:
                                @switch($laporan->verif_wadek2)
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
                        @if ($laporan->verif_wadek2 == 1)
                        <tr>
                            <td><b>Pesan</b></td>
                            <td>: {{$laporan->pesan}}</td>
                        </tr>
                        @endif
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
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengadaan as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ $item->spesifikasi }}</td>
                                <td>{{ $item->jumlah }} {{ $item->satuan->satuan }}</td>
                                <td>{{ $item->harga }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box-footer">
                @if ($laporan->verif_wadek2 == 0)
                {!! Form::open(['route' => ['wadek2.pengadaan.update', $laporan->id], 'method' => 'PUT'])
                !!}
                {!! Form::hidden("verif_wadek2", 2) !!}
                <button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i>
                    Setujui</button>
                &ensp;
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tolak"><i
                        class="fa fa-close"></i> Tolak Laporan</button>
                </form>

                {{-- <a href="{{ route('wadek2.pengadaan.index') }}" class="btn btn-default
                pull-right">Kembali</a> --}}

                <div class="modal fade" id="modal-tolak">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-red">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Pesan Penolakan Laporan Pengadaan</h4>
                            </div>
                            {!! Form::open(['route' => ['wadek2.pengadaan.update', $laporan->id], 'method'
                            =>
                            'PUT'])
                            !!}
                            <div class="modal-body">
                                {!! Form::label("pesan_tolak", "Masukan Pesan Penolakan") !!}
                                {!! Form::textarea("pesan_tolak", old('pesan_tolak'), ['id' =>
                                'pesan_tolak',
                                'class' =>
                                'form-control', 'rows' => 2, 'required', 'style' => 'resize:none']) !!}
                                {!! Form::hidden("verif_wadek2", 1) !!}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">Batal</button>
                                {!! Form::submit('Tolak', ['class' => 'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection

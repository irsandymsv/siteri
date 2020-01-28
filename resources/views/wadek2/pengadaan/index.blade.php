@extends('layouts.template')

@section('side_menu')
@include('include.wadek2_menu')
@endsection

@section('page_title', 'Laporan Pengadaan')

@section('judul_header', 'Laporan Pengadaan')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Laporan Pengadaan</h3>

            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table id="pengadaan" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Dibuat</th>
                                <th>Terakhir Diubah</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th style="width:99.8px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($laporan as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{$no+=1}}</td>
                                <td>
                                    {{Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
                                </td>
                                <td>
                                    {{Carbon\Carbon::parse($item->updated_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
                                </td>
                                <td>{{$item->keterangan}}</td>
                                <td>
                                    @switch($item->verif_wadek2)
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
                                <td>
                                    <a href="{{ route('wadek2.pengadaan.show', $item->id) }}" class="btn btn-primary"
                                        title="Lihat Laporan"><i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(function(){
        $('#pengadaan').dataTable();
    })
</script>

@endsection

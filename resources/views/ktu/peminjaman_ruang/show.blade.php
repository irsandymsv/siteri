@extends('ktu.ktu_view')

@section('side_menu')
@include('include.ktu_menu')
@endsection

@section('page_title', 'Peminjaman Ruang')

@section('judul_header', 'Peminjaman Ruang')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Laporan Peminjaman Ruang</h3>
            </div>

            <div class="box-body">
                <div class="">
                    <table class="tabel-keterangan">
                        <tr>
                            <td><b>Tanggal Mulai</b></td>
                            <td>: {{$laporan->tanggal_mulai}}</td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Berakhir</b></td>
                            <td>: {{$laporan->tanggal_berakhir}}</td>
                        </tr>
                        <tr>
                            <td><b>Jam Mulai</b></td>
                            <td>: {{$laporan->jam_mulai}}</td>
                        </tr>
                        <tr>
                            <td><b>Jam Berakhir</b></td>
                            <td>: {{$laporan->jam_berakhir}}</td>
                        </tr>
                        <tr>
                            <td><b>Kegiatan</b></td>
                            <td>: {{$laporan->kegiatan}}</td>
                        </tr>
                        <tr>
                            <td><b>Jumlah Peserta</b></td>
                            <td>: {{$laporan->jumlah_peserta}}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>: @if($laporan->verif_baper == 0)
                                Belum Disetujui
                                @elseif($laporan->verif_ktu == 0)
                                Belum Diverifikasi
                                @else
                                <label class="label bg-green">Sudah Diverifikasi</label>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <br>
                <div class="table-responsive">
                    <table id="inventaris" class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruang</th>
                                <th>Kuota</th>
                                <th style="width:99.8px">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0 @endphp
                            @foreach($detail_laporan as $item)
                            <tr id="lap_{{ $item->id }}">
                                <td>{{$no+=1}}</td>
                                <td>{{$item->data_ruang->nama_ruang}}</td>
                                <td>{{$item->data_ruang->kuota}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br><br>
                @if($laporan->verif_ktu == 0)
                {!! Form::open(['route' => ['ktu.peminjaman_barang.verif', $laporan->id], 'method' =>
                'PUT'])!!}
                {!! Form::hidden("verif_ktu", 1) !!}
                <div class="form-group" style="float: right;">
                    {!! Form::submit('Setujui', [ 'class'=>'btn btn-success', 'id' => 'submit']) !!}
                </div>
                {!! Form::close() !!}
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(function(){

        $('#peminjaman_ruang').DataTable();

        $('a.btn.btn-danger').click(function(){
            event.preventDefault();
				var id = $(this).attr('id');
                console.log(id);

				var url_del = "{{route('ktu.peminjaman_ruang.destroy', "id")}}";
                url_del = url_del.replace('id', id);
				console.log(url_del);

				$('div.modal-footer').off().on('click', '#hapusBtn', function(event) {
					$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});

					$.ajax({
						url: url_del,
						type: 'POST',
						data: {_method: 'DELETE'},
					})
					.done(function(hasil) {
						console.log("success");
						$("tr#lap_"+id).remove();
					})
					.fail(function() {
						console.log("error");
						$("tr#lap_"+id).remove();
					});
				});
        });
    });

</script>
@endsection

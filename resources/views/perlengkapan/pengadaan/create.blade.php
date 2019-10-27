@extends('perlengkapan.perlengkapan_view')

@section('page_title', 'Buat Pengadaan')

@section('css_link')
<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
@endsection

@section('judul_header', 'Buat Pengadaan')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <form action="{{ route('perlengkapan.pengadaan.store') }}" method="POST">
                <div class="box-header">
                    <h3 class="box-title">Buat Laporan Pengadaan</h3>
                </div>

                <div class="box-body">
                    @csrf
                    <div class="table-responsive">
                        <h5>Total Data = <span class="data_count"></span></h5>
                        <table id="tbl-data" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Spesifikasi</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr id="1">
                                    <td>
                                        <select id="kategori" name="kategori[]" class="form-control kategori">
                                            @foreach($kategori as $val)
                                            <option value="{{$val->id}}" onchange="setHarga({{$val->kategori}})">
                                                {{$val->kategori}}</option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <select id="barang" name="barang[]" class="form-control barang" disabled="true">
                                        </select>
                                    </td>

                                    <td>
                                        <input id="jumlah" type="text" name="jumlah[] jumlah" class="form-control"
                                            disabled="true">
                                    </td>

                                    <td>
                                        <label id="harga" for="harga" class="form-control harga"></label>
                                    </td>

                                    <td>
                                        <label id="total" for="total" class="form-control total"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>Total Data = <span class="data_count"></span></h5>
                    </div>

                    <button id="addRow" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                    <br><br>
                    <div class="form-group" style="float: right;">
                        <button type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan Kirim</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    var dataAjax = null;
        $(function () {

            $('.kategori').on('change', function(){
                var id = $(this).val();
                if(id) {

                    $.ajax({
                    url: "/perlengkapan/pengadaan/barang/" + id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        dataAjax = data;
                        $('.barang').empty();
                        $('.barang').prop('disabled', false);
                        $('.jumlah').prop('disabled', false);
                        $.each(data, function(key, value) {
                            if(key == 0){
                                $('.harga').append("Rp " + value.harga_satuan + ",-");
                            }
                            $('.barang').append('<option value="'+ value.id +'" onClick="setHarga("' + value.harga_satuan + '")">' + value.spesifikasi_barang + '</option>');
                        });

                        $('.barang').on('change', function(){
                            id = $(this).val();
                            $('.harga').empty();
                            if(id) {
                                $.each(dataAjax, function(key, value){
                                    if(value.id == id){
                                        $('.harga').append("Rp " + value.harga_satuan + ",-");
                                    }
                                });
                            } else {
                                $('.harga').append("Error Not Found");
                            }
                            $('.jumlah').on('change', function(){
                                var jum = $('.jumlah').val();
                                var harga = $('.harga').val();

                            })
                        });

                    }
                });
                } else {
                    $('.barang').empty();
                }
            });

        data_count();

        function data_count() {
            var count = $("tbody tr").length;
            $(".data_count").text(count);
        }
    });


</script>
@endsection

@extends('perlengkapan.perlengkapan_view')

@section('page_title', 'Buat Pengadaan')

@section('judul_header', 'Buat Pengadaan')

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <form method="POST">
                <div class="box-header">
                    <h3 class="box-title">Buat Laporan Inventaris</h3>
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
                                </tr>
                            </thead>

                            <tbody>
                                <tr>

                                    <td>
                                        <input id="nama_barang" type="text" name="nama_barang" class="form-control">
                                    </td>

                                    <td>
                                        <input id="spesifikasi" type="text" name="spesifikasi" class="form-control">
                                    </td>

                                    <td>
                                        <input id="jumlah" type="text" name="jumlah" class="form-control">
                                    </td>

                                    <td>
                                        <input id="harga" type="text" class="form-control harga">
                                    </td>

                                    <td>
                                        <label id="total" for="total" class="form-control total"></label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h5>Total Data = <span class="data_count"></span></h5>
                    </div>

                    <button id="tambah" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                    <br><br>
                    <div class="form-group" style="float: right;">
                        <button id="submit" type="submit" name="simpan_kirim" class="btn btn-success">Simpan dan
                            Kirim</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>



<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="table-responsive">
                <table id="inventaris" class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Spesifikasi</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Total</th>
                            <th style="width:99.8px">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(function(){

        $('#jumlah, #harga').on('input', function(){
            $('#total').empty();
            jumlah = $('#jumlah').val();
            harga = $('#harga').val();
            $('#total').append('Rp ' + jumlah * harga);
        });

        $('#tambah').click(function(event) {
            nama = $('#nama_barang').val();
            spesifikasi = $('#spesifikasi').val();
            jumlah = $('#jumlah').val();
            harga = $('#harga').val();
            total = $('#total').html();
            data = $('#tbody tr').length;
            $('#tbody').append(`
                <tr>
                    <td>
                        ` + ++data + `
                    </td>

                    <td>
                        ` + nama + `
                    </td>

                    <td>
                        ` + spesifikasi + `
                    </td>

                    <td>
                        ` + jumlah + `
                    </td>

                    <td>
                        ` + harga + `
                    </td>

                    <td>
                        ` + total + `
                    </td>
                </tr>
            `);

            $('#nama_barang').val('');
            $('#spesifikasi').val('');
            $('#jumlah').val('');
            $('#harga').val('');
            $('#total').html('');

        });

        $('#submit').click(function(event){
            event.preventDefault();
            table = $('#tbody tr');
            data = [];
            data.push({
                "_token": $('meta[name="csrf-token"]').attr('content')
            });
            $.each(table, function(index, val){
                // val = val + '';
                vall = $(val).text().split(/\s+/);
                vall.shift();
                vall.shift();
                vall.pop();
                data.push(vall);
            });
            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('{{ route("perlengkapan.inventaris.store") }}', $.param(data));
        });
    });

</script>

@endsection

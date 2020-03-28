@extends('admin.admin_view')
@section('page_title','Admin Dashboard')
@section('content')
<section class="content-header">
    <h1>
        <b>DATA PEGAWAI</b>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <!-- alert create pegawai -->

            <!-- alert create pegawai -->

            <!-- alert create pegawai -->
            <div class="row">
                <div class="col-sm-8">
                <a class="btn btn-primary" href="{{route('admin.pegawai.create')}}">Tambah Pegawai</a>
                </div>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('success')}}
            </div>
        @endif
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-sm-6"></div>
                <div class="col-sm-6"></div>
            </div>

            <form method="POST" action="{{ route('admin.search') }}">
                {{ csrf_field() }}
               @component('layouts.admin.search', ['title' => 'Pencarian'])
                 @component('layouts.admin.two-cols-search-row', ['items' => ['Nama', 'Jabatan'],
                 'oldVals' => [isset($searchingVals) ? $searchingVals['nama'] : '', isset($searchingVals) ? $searchingVals['pangkat'] : '']])
                 @endcomponent
               @endcomponent
             </form>

            <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="example2" class="table table-bordered table-hover dataTable" role="grid"
                            aria-describedby="example2_info">
                            <thead>
                                <tr role="row">
                                    <th width="2%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">
                                        <center>No</center>
                                    </th>
                                    <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">
                                        <center>Nama Pegawai</center>
                                    </th>
                                    <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">
                                        <center>NIP</center>
                                    </th>
                                    <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">
                                        <center>Jabatan Fungsional</center>
                                    </th>
                                    <th width="15%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">
                                        <center>Jabatan</center>
                                    </th>
                                    <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">
                                        <center>Pangkat</center>
                                    </th>
                                    <th width="10%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">
                                        <center>Golongan</center>
                                    </th>
                                    {{-- <th width="3%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"><center>Tingkat</center></th> --}}
                                    <th width="35%" tabindex="0" aria-controls="example2" rowspan="1" colspan="2">
                                        <center>Aksi</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if ($data->currentPage() == 1) {
                                    $skipped = 0;
                                }
                                else {
                                    $skipped = $data->currentPage() * $data->perPage();
                                }
                                ?>
                                @foreach ($data as $user)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{$skipped + $no}}</td>
                                    <td class="hidden-xs">{{$user->nama}}</td>
                                    <td class="hidden-xs">{{$user->no_pegawai}}</td>
                                    <td class="hidden-xs">{{$user->fungsionalnya['jab_fungsional']}}</td>
                                    <td class="hidden-xs">{{$user->jabatannya['jabatan']}}</td>
                                    <td class="hidden-xs">{{$user->pangkatnya['pangkat']}}</td>
                                    <td class="hidden-xs">{{$user->golongannya['golongan']}}</td>
                                    <td style="display: inline-block">
                                        <form class="row" method="POST" action="{{route('admin.pegawai.destroy', $user->username)}}"
                                            onsubmit="return confirm('Apakah anda yakin menghapus user ini?')">
                                            @method('DELETE')
                                            @csrf
                                            <a href="
                                                {{route('admin.pegawai.edit', $user->username)}}"
                                                class="btn btn-warning btn-margin btn-sm"
                                                style="margin-left: 10px;">
                                                Edit
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-margin btn-sm"
                                                style="margin-left: 5px;">
                                                Hapus
                                            </button>
                                        <a id="resetsubmit{{$no}}" class="btn btn-warning btn-margin btn-sm"
                                                style="margin-left: 10px;">
                                                Reset
                                            </a>
                                        </form>

                                        <form id="resetpass{{$no}}" class="row" method="POST" action="{{route('admin.pegawai.reset', $user->username)}}"
                                                onsubmit="return confirm('Apakah anda yakin reset password user ini?')">
                                                @method('DELETE')
                                                @csrf

                                            </form>

                                    </td>
                                    @php
                                    $no++;
                                    @endphp
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to
                            {{count($data)}} of {{count($data)}} entries</div>
                    </div>
                    <div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</section>
<!-- /.content -->
@endsection
@section('script')

<script>
$(document).ready(function() {
    @foreach ($data as $item => $index)
    $('#resetsubmit{{$item+1}}').click(function() {
        $('#resetpass{{$item+1}}').submit();
    });
    @endforeach
});
</script>
@endsection

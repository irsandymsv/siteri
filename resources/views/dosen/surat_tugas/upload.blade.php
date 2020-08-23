@extends('layouts.template')

@section('side_menu')
  @if (Auth::user()->jabatan->jabatan == "Dekan")
    @include('include.dekan_menu')
  @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 1")
    @include('include.wadek1_menu')
  @elseif(Auth::user()->jabatan->jabatan == "Wakil Dekan 2")
    @include('include.wadek2_menu')
  @elseif(Auth::user()->jabatan->jabatan == "Dosen")
    @include('include.dosen_menu')
  @endif
@endsection

@section('page_title','Uplaod Bukti Perjalanan')
@section('judul_header','Upload Bukti Perjalanan')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Belum Upload</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="table_data1" class="table table-bordered table-hover dataTable">
            <thead>
              <tr>
                <th>
                  <center>No</center>
                </th>
                <th>
                  <center>Jenis Surat</center>
                </th>
                <th>
                  <center>Nama yang Bertugas</center>
                </th>
                <th>
                  <center>Tanggal</center>
                </th>
                <th>
                  <center>Keterangan</center>
                </th>
                <th>
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>

            <tbody>
              @foreach ($surat_tugas as $index =>$sk)

              <tr role="row">
                <td>{{$index+1}}</td>
                <td>
                  @foreach ($jenis as $item)
                      @if ($item->id == $sk->jenis_surat)
                          {{$item->jenis}}
                      @endif
                  @endforeach</td>
                <td>
                  {{Auth::user()->nama}}
                </td>
                <td>{{ \Carbon\Carbon::parse($sk->started_at)->format('d/m/Y')}} -
                  {{ \Carbon\Carbon::parse($sk->end_at)->format('d/m/Y')}}</td>
                <td>{{$sk->keterangan}}</td>
                <td>
                  <a href="{{route($jabatan_user.'.dosen_upload_preview', $sk->id_spd)}}" class="btn btn-primary btn-sm" style="margin-left: 17px;">Upload</a>
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Sudah Upload</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="table_data2" class="table table-bordered table-hover dataTable" >
            <thead>
              <tr>
                <th>
                  <center>No</center>
                </th>
                <th>
                  <center>Jenis Surat</center>
                </th>
                <th>
                  <center>Nama yang Bertugas</center>
                </th>
                <th>
                  <center>Tanggal</center>
                </th>
                <th>
                  <center>Keterangan</center>
                </th>
                <th>
                  <center>Aksi</center>
                </th>
              </tr>
            </thead>

            <tbody>
              @foreach ($surat_tugas2 as $index =>$sk2)

              <tr role="row">
                <td>{{$index+1}}</td>
                <td>
                  @foreach ($jenis as $item)
                      @if ($item->id == $sk2->jenis_surat)
                          {{$item->jenis}}
                      @endif
                  @endforeach</td>
                <td>
                  {{Auth::user()->nama}}
                </td>
                <td>{{ \Carbon\Carbon::parse($sk2->started_at)->format('d/m/Y')}} -
                  {{ \Carbon\Carbon::parse($sk2->end_at)->format('d/m/Y')}}</td>
                <td>{{$sk2->keterangan}}</td>
                <td>
                  <a href="{{route($jabatan_user.'.edit.upload', $sk2->id_spd)}}" class="btn btn-primary btn-sm" style="margin-left: 17px;">Upload</a>
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
@endsection

@section('script')
<script type="text/javascript">
  $('#table_data2').DataTable();
</script>
@endsection
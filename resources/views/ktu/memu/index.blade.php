@extends('ktu.ktu_view')  
@section('page_title','Daftar Memo')
@section('judul_header','Daftar Memo')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Memo Perlu Disetujui</h3>
    </div>

    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="table_data1" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
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
              @foreach ($memu as $index =>$sk)
              <tr role="row">
                <td>{{$index+1}}</td>
                <td>{{$sk->jenis_sk->jenis}}</td>
                <td>
                  @foreach ($dosen_sk as $dosen)
                  @if ($dosen->id_sk == $sk->id)
                  <p>{{$dosen->user['nama']}}</p>
                  @endif
                  @endforeach
                  @foreach ($pemateri as $pematerii)
                      @if ($pematerii['id_sk'] == $sk->id)
                      <p>{{$pematerii['nama']}}</p>   
                      @endif
                  @endforeach
                </td>
                <td>{{ \Carbon\Carbon::parse($sk->started_at)->format('d/m/Y')}} -
                  {{ \Carbon\Carbon::parse($sk->end_at)->format('d/m/Y')}}</td>
                <td>{{$sk->keterangan}}</td>
                <td>
                  
                  @if($sk->status == 1)
                  <a href="{{route('ktu.memu.approve', $sk->id)}}" class="btn btn-primary" style="margin-left: 17px;">Setujui</a>
                  @else
                  
                  @endif
                  
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
      <h3 class="box-title">Memo Sudah Disetujui</h3>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-sm-12">
          <table id="table_data2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
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
                {{-- <th>
                  <center>Status</center>
                </th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach ($memus as $index =>$sks)
              <tr role="row">
                <td>{{$index+1}}</td>
                <td>{{$sks->jenis_sk->jenis}}</td>
                 <td>
                  @foreach ($dosen_sk as $dozen)
                  @if ($dozen->id_sk == $sks->id)
                  <p>{{$dozen->user['nama']}}</p>
                  @endif
                  @endforeach
                  @foreach ($pemateri as $pematery)
                      @if ($pematery['id_sk'] == $sks->id)
                      <p>{{$pematery['nama']}}</p>   
                      @endif
                  @endforeach
                </td>
                <td>{{ \Carbon\Carbon::parse($sks->started_at)->format('d/m/Y')}} -
                  {{ \Carbon\Carbon::parse($sks->end_at)->format('d/m/Y')}}</td>
                <td>{{$sks->keterangan}}</td>
                {{-- <td>
                  @if($sks->status == 1)
                  <a href="{{route('ktu.memu.approve', $sk->id)}}" class="btn btn-primary" style="margin-left: 17px;">Setujui</a>
                  @else
                  <button href="#"  class="btn btn-primary" style="margin-left: 17px;" disabled>Disetujui</button>
                  @endif
                </td> --}}
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
  $.fn.dataTable.moment('D MMMM Y', 'id');
    $('#table_data2').DataTable({
  })
</script>
@endsection
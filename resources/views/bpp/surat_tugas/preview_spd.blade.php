@extends('bpp.bpp_view')
@section('page_title')
	Bukti Perjalanan
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold;
      }
	</style>	
@endsection

@section('judul_header')
	Surat Tugas 
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
           <h3 class="box-title">Detail Surat Tugas</h3>
        </div>
        
        <div class="box-body">
         	<div class="table-responsive">
            @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
            @endif
            
            <table class="table table-striped table-bordered">
              <tr>
                <td>No Surat</td>
                <td>{{ $surat_tugas->nomor_surat}}/UN25.1.15/KP/{{ \Carbon\Carbon::parse($surat_tugas->created_at)->year }}</td>
              </tr>

              <tr>
                <td>Yang Bertugas</td>
                <td>
                    @foreach ($dosen_tugas as $bertugas)
                   <p>{{ $bertugas->user['nama'] }} - {{ $bertugas->user['no_pegawai'] }}</p>
                   @endforeach
                </td>
              </tr>
              <tr>
                <td>Tanggal Bertugas</td>
                <td>{{ Carbon\Carbon::parse($surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y') }} - {{ Carbon\Carbon::parse($surat_tugas->end_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
              </tr>
              <tr>
                <td>Keterangan</td>
                <td>{{$surat_tugas->keterangan}}</td>
              </tr>
              <tr>
                <td>Status</td>
                @foreach ($status as $stts)
                @if ($stts->id == $surat_tugas->status)
                <td>{{$stts->status}}</td>
                @endif
                @endforeach
               
              </tr>
            </table>    
          </div>

          <div class="table-responsive">
            <h3><b>Bukti Perjalanan</b></h3>
            <table class="table table-striped table-bordered">
              <tr>
                <td>Lampiran Bukti Perjalanan</td>
                <td>
                  @if (!is_null($bukti[0]->transportasi))
                    @for ( $i=0;$i< count($bukti[0]->transportasi);$i++)
                       <a href="{{route('bpp.spd.download',[ 'id' => $bukti[0]->id, 'index' => $i, 'jenis_bukti' => 1 ])}}"><i class="fa fa-file"></i>   {{$bukti[0]->transportasi[$i][0]}}</a><br>
                    @endfor
                  @else
                    -
                  @endif
                </td>
              </tr>
              <tr>
                <td>Lampiran Bukti Pendaftaran</td>
                <td>
                  @if (!is_null($bukti[0]->pendaftaran))
                    @for ( $i=0;$i< count($bukti[0]->pendaftaran);$i++)
                      <a href="{{route('bpp.spd.download',[ 'id' => $bukti[0]->id, 'index' => $i, 'jenis_bukti' => 2 ])}}"><i class="fa fa-file"></i>   {{$bukti[0]->pendaftaran[$i][0]}}</a><br>
                    @endfor
                  @else
                    -
                  @endif
                </td>
              </tr>
              <tr>
                <td>Lampiran Bukti Penginapan</td>
                <td>
                  @if (!is_null($bukti[0]->penginapan))
                    @for ( $i=0;$i< count($bukti[0]->penginapan);$i++)
                       <a href="{{route('bpp.spd.download',[ 'id' => $bukti[0]->id, 'index' => $i, 'jenis_bukti' => 3 ])}}"><i class="fa fa-file"></i>   {{$bukti[0]->penginapan[$i][0]}}</a><br>
                    @endfor
                  @else
                  -
                  @endif
                </td>
              </tr>
            </table>    
          </div>
        </div>

        <div  class="box-footer">
        <a href="{{route('bpp.spd.index')}}" class="btn btn-default">Kembali</a>
        @if ($surat_tugas->status == 10)
        <a href="{{route('bpp.spd.selesai', $surat_tugas->id)}}" class="btn btn-primary">Selesai</a>
        @endif
        </div>
            
   		</div>
   	</div>
	</div>
@endsection

@section('script')

@endsection
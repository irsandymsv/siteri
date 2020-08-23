@extends('bpp.bpp_view')
@section('page_title')
	Preview Surat
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{asset("/css/custom_style.css")}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('/css/surat_tugas_kepegawaian.css') }}">
  <style type="text/css">
		.table-responsive{
         width: 90%;
         margin: auto;
         font-size: 15px;
      }

      table tr td:first-child{
         width: 25%;
         font-weight: bold;: 
      }
	</style>	
@endsection

@section('judul_header')
	Preview Surat Tugas 
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
          <h3 class="box-title">Detail Surat Tugas {{$surat_tugas->jenis_sk->jenis}}</h3>
        </div>

        <div class="box-body">
       		<div class="table-responsive">
            @if (session()->has('success'))
              <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                {{ session()->get('success')}}
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
                   @foreach ($pemateri as $pematerii)
                   <p>{{ $pematerii->nama}}</p>
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
                <td>{{$surat_tugas->status_sk->status}}</td>
              </tr>
            </table>    
          </div>

          <div class="table-responsive">
            <h3><b>Rincian Biaya</b></h3>
            <table class="table table-striped table-bordered">
              @if ($spd != null)
                <tr>
                  <td>Lama Perjalanan</td>
                    @php
                    $to = \Carbon\Carbon::createFromFormat('Y-m-d', $surat_tugas->started_at);
                    $from = \Carbon\Carbon::createFromFormat('Y-m-d', $surat_tugas->end_at);
                    $lama = $to->diffInDays($from);
                    $lama = $lama+1;
                    if ($spd->biaya_penginapan == null) {
                        $spd->biaya_penginapan = 0;
                    }

                    else if ($spd->biaya_pendaftaran == null) {
                        $spd->biaya_pendaftaran = 0;
                    }
                    $harian = $lama * $spd->uang_harian;
                    $menginap = $lama * $spd->biaya_penginapan;
                    $pendaftaran = $spd->biaya_pendaftaran_acara;
                    $total = ($harian + $menginap + $pendaftaran);
                    @endphp   
                  <td>{{ $lama }} Hari</td>
                </tr>

                <tr>
                  <td>Biaya Harian</td>
                  <td>Rp. {{ $spd->uang_harian }}</td>
                </tr>
             
                <tr>
                  <td>Biaya Penginapan per Hari</td>
                  @if ($spd->id_penginapan == 1)
                  <td>
                    Rp. {{$spd->biaya_penginapan}}
                  </td>
                  @else
                  <td>-</td>
                </tr>
                  @endif

                <tr>
                  <td>Biaya Pendaftaran</td>
                  @if ($spd->id_pendaftaran == 1)
                  <td>Rp. {{$spd->biaya_pendaftaran_acara}}</td>
                  @else
                  <td>-</td>
                </tr>
                  @endif

                <tr>
                  <td>Jumlah Dosen</td>
                  <td>{{ count($dosen_tugas) }}</td>
                </tr>

                 <tr>
                  <td>Total Biaya per Orang</td>
                  <td>Rp. {{ $total}}</td>
                </tr>
                 
                @elseif($surat_tugas->surat_in_out == 2)
                 <!-- Pemateri -->
                
                @foreach ($pemateri as $key => $pematerii)
                     
                <tr>
                  <td>Nama Pemateri {{$key+1}}</td>
                 <td>{{ $pematerii->nama}} - {{ $pematerii->instansi}}</td>
                </tr>
             
                <tr>
                  <td>Biaya</td>
                  <td>
                      Rp. {{$pematerii->biaya}}
                  </td>
                </tr>
                @endforeach

                @endif
            </table>    
          </div>
        </div>

        <br>
        <!-- Jenis Surat -->
        @if ($surat_tugas->jenis_surat == 1)
        @include('kepegawaian.surat_tugas.jenis.peserta')
        @elseif ($surat_tugas->jenis_surat == 2)
        @include('kepegawaian.surat_tugas.jenis.panitia')
        @else
        @include('kepegawaian.surat_tugas.jenis.pemateri')
        @endif

        <div  class="box-footer">
          <a href="{{route('bpp.surat.index')}}" class="btn btn-default">Kembali</a>
          @if ($surat_tugas->status == 8)
            <a href="{{route('bpp.surat.approve', $surat_tugas->id)}}" class="btn btn-primary">Setujui</a>
          @endif
        </div>
            
   		</div>
   	</div>
	</div>
@endsection

@section('script')
   <script type="text/javascript">
      var status = @json($surat_tugas->id_status_surat_tugas);
      for (var i = status; i > 0; i--) {
         // $("#progres_"+i).children('i').removeClass('bg-grey').addClass('bg-green fa-check');
         $("#progres_"+i).addClass('verified');
         $("#progres_"+i).find('i').addClass('fa fa-check');
      }
   </script>
@endsection
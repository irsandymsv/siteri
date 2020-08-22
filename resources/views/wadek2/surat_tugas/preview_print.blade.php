@extends('wadek2.wadek2_view')
@section('page_title')
	Preview Surat
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/custom_style.css')}}">
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
                  <td>Tanggal Dibuat</td>   
                  <td>{{ Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
               </tr>

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
                     @if ($pematerii['id_sk'] == $surat_tugas->id)
                     <p>{{$pematerii['nama']}}</p>   
                     @endif
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

            <br>
            <a href="{{ route('wadek2.surat.index') }}" class="btn btn-default">Kembali</a>
            @if ($surat_tugas->status == 7)
              <a style="margin-left: 3px;" href="{{ route('wadek2.surat.approve', $surat_tugas->id) }}" class="btn btn-primary"> Setujui </a>
            @endif
          </div>

          @if ($self_check && $surat_tugas->status >= 9)
          	@if ($surat_tugas->surat_in_out == 1)
          	  @if ($surat_tugas->jenis_surat == 1)
          	  <a href="{{route($jabatan_user.'.surat.cetak1', $surat_tugas->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-print"></i> Surat Tugas</a>
          	  @elseif($surat_tugas->jenis_surat == 2)
          	  <a href="{{route($jabatan_user.'.surat.cetak2', $surat_tugas->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-print"></i> Surat Tugas</a>
          	  @elseif($surat_tugas->jenis_surat == 3)
          	  <a href="{{route($jabatan_user.'.surat.cetak1', $surat_tugas->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-print"></i> Surat Tugas</a>
          	  @endif
          	@endif
          	@if ($surat_tugas->perjalanan == 1)
          		<a href="{{route($jabatan_user.'.surat.cetak_spd', $surat_tugas->id)}}" class="btn btn-success btn-sm" ><i class="fa fa-print"></i> SPD</a>
          	@endif
          @endif
        </div>

        <br><br>
        <!-- Jenis Surat -->
        @if ($surat_tugas->jenis_surat == 1)
        @include('kepegawaian.surat_tugas.jenis.peserta')
        @elseif ($surat_tugas->jenis_surat == 2)
        @include('kepegawaian.surat_tugas.jenis.panitia')
        @else
        @include('kepegawaian.surat_tugas.jenis.pemateri')
        @endif
            
        <div  class="box-footer">
          
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
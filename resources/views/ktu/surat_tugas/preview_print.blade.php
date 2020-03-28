@extends('ktu.ktu_view')
@section('page_title')
	Preview Surat
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
         width: 10%;
         font-weight: bold;: 
      }

      /*Surat PDF Preview*/
      
		.box-body.surat{
		   margin: auto;
		   font-family: 'Times New Roman';
		   font-size: 11pt;
		   margin-top: 0;
         margin-bottom: 1cm;
         margin-left: 4cm;
         margin-right: 4cm;
         padding: 2cm;    
		}

		#kop_surat{
		   border-bottom: 3px solid black;
		   /*padding: 5px;*/
		   /*overflow: hidden;*/
		}

		#logo{
		   float: left;
		   width: 11%;
		}

		#logo img{
		   width: 100%;
		   height: auto;
         margin-top: 10pt;
		}

		#keterangan_kop{
		   text-align: center;
         margin-left: 70px;
         padding-bottom: 5pt;
		   /*width: 90%;*/
		   /* float: left; */
		}

		#body_surat{
         margin-left: 1cm;
         margin-right: 1cm; 
		   text-align: justify;
		}

		.top-title{
		   margin-top: 10px;
		   text-align: center;
		}

		.judul_surat{
		   font-size: 13pt;
		   text-decoration: underline;
		   font-weight: bold;
         letter-spacing: 1.5pt;
		}

      /* 
Generic Styling, for Desktops/Laptops 
*/
table { 
 margin-top: 20px;
margin-bottom: 20px;
  width: 90%; 
  border-collapse: collapse; 
}
/* Zebra striping */
tr:nth-of-type(odd) { 
}
th { 
   text-align: center;
  color: #000000; 
  font-weight: bold;
}
td, th { 

  padding: 6px; 
  border: 1px solid #ccc;  
}
		.header_14{
		   font-size: 14pt;
		}

		.underline{
		   text-decoration: underline;
		}

		.ttd-right{
		   float: right;
           margin-top: 100px;
		}

      .space_row{
         padding-top: 2pt;
         padding-bottom: 2pt;
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
                  <table class="table table-striped table-bordered">
                     <tr>
                        <td>Tanggal Dibuat</td>   
                        <td>{{ Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                     </tr>

                     <tr>
                        <td>No Surat</td>
                        <td>{{$surat_tugas->nomor_surat}}</td>
                     </tr>

                     <tr>
                        <td>Yang Bertugas</td>
                        <td>
                           @foreach ($dosen_tugas as $dosen)
                    @if ($dosen->id_sk == $surat_tugas->id)
                    <p>{{$dosen->user['nama']}}</p>
                    @endif
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
               </div>
            </div>
            <!-- Jenis Surat -->
            @if ($surat_tugas->jenis_surat == 1)
            @include('ktu.surat_tugas.jenis.peserta')
            @elseif ($surat_tugas->jenis_surat == 2)
            @include('ktu.surat_tugas.jenis.panitia')
            @else
            @include('ktu.surat_tugas.jenis.pemateri')
            @endif

            <div  class="box-footer">
               <a href="{{ route('ktu.surat.index') }}" class="btn btn-default">Kembali</a>
               <a href="{{ route('ktu.surat.approve', $surat_tugas->id) }}" class="btn btn-primary">Setujui</a>
               {{-- @if ($surat_tugas->jenis_surat == 1)
               <a href="{{route('kepegawaian.surat.cetak1', $surat_tugas->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-print"></i> Cetak</a>
               @elseif($surat_tugas->jenis_surat == 2)
               <a href="{{route('kepegawaian.surat.cetak1', $surat_tugas->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-print"></i> Cetak</a>
               @elseif($surat_tugas->jenis_surat == 3)
               <a href="{{route('kepegawaian.surat.cetak1', $surat_tugas->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-print"></i> Cetak</a>
               @elseif($surat_tugas->jenis_surat == 4)
               <a href="{{route('kepegawaian.surat.cetak1', $surat_tugas->id)}}" class="btn btn-warning btn-sm" ><i class="fa fa-print"></i> Cetak</a>
               @endif --}}
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
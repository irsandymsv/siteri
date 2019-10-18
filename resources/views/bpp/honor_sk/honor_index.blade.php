@extends('bpp.bpp_view')

@section('page_title')
      Daftar Honorarium {{ ($tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}
@endsection

@section('css_link')
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('judul_header')
      Honorarium {{ ($tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}
@endsection

@section('content')     
   <div class="row">
      <div class="col-xs-12">
         <div class="box box-success">
            <div class="box-header">
               <h3 class="box-title">Daftar Honorarium {{ ($tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}</h3>
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  <table id="table_data1" class="table table-bordered table-hovered">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Tanggal Dibuat</th>
                           <th>Status</th>
                           <th>Verif BPP</th>
                           <th>Verif KTU</th>
                           <th>Verif Wadek 2</th>
                           <th>Verif Dekan</th>
                           <th>Opsi</th>
                        </tr>
                     </thead>

                     <tbody>
                        @php $no=0; @endphp
                        @foreach ($sk_honor as $item)
                           <tr id="sk_{{ $item->id }}">
                              <td>{{ $no+=1 }}</td>
                              <td>
                                 {{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
                              </td>
                              <td>{{ $item->status_sk_honor->status }}</td>
                              <td>
                                 @if($item->verif_kebag_keuangan == 0) 
                                    Belum Diverifikasi
                                 @elseif($item->verif_kebag_keuangan == 2) 
                                    <label class="label bg-red">Butuh Revisi</label> 
                                 @else
                                    <label class="label bg-green">Sudah Diverifikasi</label>
                                 @endif
                              </td>
                              <td>
                                 @if($item->verif_ktu == 0) 
                                    Belum Diverifikasi
                                 @elseif($item->verif_ktu == 2) 
                                    <label class="label bg-red">Butuh Revisi</label> 
                                 @else
                                    <label class="label bg-green">Sudah Diverifikasi</label>
                                 @endif
                              </td>
                              <td>
                                 @if($item->verif_wadek2 == 0) 
                                    Belum Diverifikasi
                                 @elseif($item->verif_wadek2 == 2) 
                                    <label class="label bg-red">Butuh Revisi</label> 
                                 @else
                                    <label class="label bg-green">Sudah Diverifikasi</label>
                                 @endif
                              </td>
                              <td>
                                 @if($item->verif_dekan == 0) 
                                    Belum Diverifikasi
                                 @elseif($item->verif_dekan == 2) 
                                    <label class="label bg-red">Butuh Revisi</label> 
                                 @else
                                    <label class="label bg-green">Sudah Diverifikasi</label>
                                 @endif
                              </td>
                              <td>
                                 @if ($item->tipe_sk->tipe == "SK Skripsi")
                                    <a href="#" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                 @else
                                    <a href="#" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
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
   </div>
@endsection

@section('script')
   <script type="text/javascript">
      
   </script>
@endsection  
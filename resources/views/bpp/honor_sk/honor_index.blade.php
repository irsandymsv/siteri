@extends('layouts.template')

@section('side_menu')
   @include('include.bpp_menu')
@endsection

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

               @if(session()->has('verif_bpp'))
                  <div class="alert alert-info alert-dismissible" style="width: 35%; margin: auto;">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h4><i class="icon fa fa-info"></i> Berhasil</h4>
                     {{session('verif_bpp')}}
                  </div>
               @endif 

               @php
                  Session::forget('verif_bpp'); 
               @endphp
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  <table id="table_data1" class="table table-bordered table-hovered">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>SK Sempro</th>
                           <th>Tanggal Dibuat</th>
                           <th>Status</th>
                           <th>Verif BPP</th>
                           <th>Verif KTU</th>
                           <th>Verif Wadek 2</th>
                           <th>Pilihan</th>
                        </tr>
                     </thead>

                     <tbody>
                        @foreach ($sk_honor as $item)
                           <tr id="sk_{{ $item->id }}">
                              <td>{{ $loop->index + 1 }}</td>
                              <td>{{ $item->sk_sempro->no_surat }}</td>
                              <td>
                                 {{ Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
                              </td>
                              <td>{{ $item->status_sk_honor->status }}</td>
                              <td>
                                 @if($item->verif_bpp == 0) 
                                    Belum Diverifikasi
                                 @elseif($item->verif_bpp == 2) 
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
                                 @if ($item->tipe_sk->tipe == "SK Skripsi")
                                    <a href="{{ route('bpp.honor-skripsi.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
                                 @else
                                    <a href="{{ route('bpp.honor-sempro.show', $item->id) }}" class="btn btn-primary" title="Lihat Detail"><i class="fa fa-eye"></i></a>
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
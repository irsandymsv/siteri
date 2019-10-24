@extends('dekan.dekan_view')

@section('page_title')
	Daftar Honorarium SK {{ ($sk_honor->tipe_sk->tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}
@endsection

@section('css_link')
   <link rel="stylesheet" type="text/css" href="/css/custom_style.css">
   <style type="text/css">
      table{
         font-size: 16px;
      }

      table th{
         text-align: center;
      }

      .revisi_wrap{
        margin-top: 5px;
      }
   </style>
@endsection

@section('judul_header')
	Honorarium SK {{ ($sk_honor->tipe_sk->tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}
@endsection

@section('content')
   <button id="back_top" class="btn bg-black" title="Kembali ke Atas"><i class="fa fa-arrow-up"></i></button>
   <input type="hidden" name="status">
   <div class="row">
      <div class="col-xs-12" id="top_title">
            <div class="box box-success">
               <div class="box-header">
                  <h3 class="box-title">Honorarium SK {{ ($sk_honor->tipe_sk->tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}</h3>

                  <div class="box-tools pull-right">
                   <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                   </button>
                 </div>
               </div>

               <div class="box-body">
                  <p>Tanggal SK : {{Carbon\Carbon::parse($sk_honor->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</p>
                  <p>Sesuai : SK Dekan No...</p>
                    
                  @if($sk_honor->verif_dekan == 0)
                  <b>Belum Diverifikasi</b>
                  @elseif($sk_honor->verif_dekan == 2) 
                    <label class="label bg-red">Butuh Revisi</label>
                  @else
                    <label class="label bg-green">Sudah Diverifikasi</label>
                  @endif

                  @if($sk_honor->verif_dekan != 1)
                     <div class="form-group" style="float: right;">
                        <form method="post" action="{{ ( $sk_honor->tipe_sk->tipe == "SK Skripsi"? route('dekan.honor-skripsi.verif', $sk_honor->id) : route('dekan.honor-sempro.verif', $sk_honor->id) ) }}">
                           @csrf
                           @method('put')
                           <input type="hidden" name="verif_dekan" value="{{$sk_honor->verif_dekan}}">

                           @if ($sk_honor->verif_dekan != 1)
                              <button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>
                           @endif
                           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik</button>
                        </form>
                     </div>
                  @endif
               </div>
            </div>
      </div>
   </div>

   <div class="row">
      <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-header">
               <h3 class="box-title">Daftar Honor Pembimbing {{ ($sk_honor->tipe_sk->tipe == "SK Skripsi"? "Skripsi" : "Sempro") }}</h3>

               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
               </div>
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  <table id="dataTable1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Pembimbing I/II</th>
                           <th>NPWP</th>
                           <th>Nama Mahasiswa/NIM</th>
                           <th>Gol</th>
                           <th>Honorarium</th>
                           <th>PPH psl 5%-15%</th>
                           <th>Penerimaan</th>
                        </tr>
                     </thead>

                     <tbody id="tbl_pembimbing">
                        @php $no = 0; @endphp  
                        @foreach($sk_honor->detail_sk as $item)
                           <tr id="{{$no+=1}}">
                              <td>{{$no}}</td>
                              <td>{{$item->pembimbing_utama->nama}}</td>
                              <td>{{$item->pembimbing_utama->npwp}}</td>
                              <td rowspan="2">
                                 <p>{{$item->nama_mhs}}</p>
                                 <p>NIM: {{$item->nim}}</p>
                              </td>
                              <td>{{$item->pembimbing_utama->golongan->golongan}}</td>
                              <td id="pembimbing_{{$no}}" class="pembimbingHonor">Rp &ensp; 
                                 <span>{{ $sk_honor->honor_pembimbing }}</span>
                              </td>
                              <td class="pph" id="pph_{{$no}}">Rp &ensp; 
                                 <span>
                                    @php
                                       $pph = ($item->pembimbing_utama->golongan->pph * $sk_honor->honor_pembimbing)/100;
                                    @endphp
                                    {{ $pph }}
                                 </span>
                              </td>
                              <td class="penerimaan" id="penerimaan_{{$no}}">Rp &ensp; 
                                 <span>{{ $sk_honor->honor_pembimbing - $pph }}</span>
                              </td>
                           </tr>

                           <tr id="{{$no+=1}}">
                              <td>{{$no}}</td>
                               <td>{{$item->pembimbing_pendamping->nama}}</td>
                              <td>{{$item->pembimbing_pendamping->npwp}}</td>
                              <td>{{$item->pembimbing_pendamping->golongan->golongan}}</td>
                              <td id="pembimbing_{{$no}}" class="pembimbingHonor">Rp &ensp; <span>{{ $sk_honor->honor_pembimbing }}</span></td>
                              <td class="pph" id="pph_{{$no}}">Rp &ensp; 
                                 <span>
                                    @php
                                       $pph =( $item->pembimbing_pendamping->golongan->pph * $sk_honor->honor_pembimbing)/100;
                                    @endphp
                                    {{ $pph }}
                                 </span>
                              </td>
                              <td class="penerimaan" id="penerimaan_{{$no}}">Rp &ensp; 
                                 <span>{{ $sk_honor->honor_pembimbing - $pph }}</span>
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

   <div class="row">
   	<div class="col-xs-12">
   		<div class="box box-danger">
   			<div class="box-header">
   				<h3 class="box-title">Daftar Honor {{ ($sk_honor->tipe_sk->tipe == "SK Skripsi"? "Penguji Skripsi" : "Pembahas Sempro") }}</h3>

               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
               </div>
   			</div>

   			<div class="box-body">
              <div class="table-responsive">
                 <table id="dataTable2" class="table table-bordered table-striped">
                    <thead>
                       <tr>
                          <th>No</th>
                          <th>
                           {{ ($sk_honor->tipe_sk->tipe == "SK Skripsi"? "Penguji" : "Pembahas") }} I/II
                         </th>
                          <th>NPWP</th>
                          <th>Nama Mahasiswa/NIM</th>
                          <th>Gol</th>
                          <th>Honorarium</th>
                          <th>PPH psl 5%-15%</th>
                          <th>Penerimaan</th>
                       </tr>
                    </thead>

                    <tbody id="tbl_penguji">
                       @php $no = 0; @endphp
                       @foreach($sk_honor->detail_sk as $item)
                         <tr id="{{$no+=1}}">
                           <td>{{$no}}</td>
                           <td>{{$item->penguji_utama->nama}}</td>
                           <td>{{$item->penguji_utama->npwp}}</td>
                           <td rowspan="2">
                              <p>{{$item->nama_mhs}}</p>
                              <p>NIM: {{$item->nim}}</p>
                           </td>
                           <td>{{$item->penguji_utama->golongan->golongan}}</td>
                           <td id="penguji_{{$no}}" class="pengujiHonor">Rp &ensp; 
                              <span>{{ $sk_honor->honor_penguji }}</span></td>
                           <td class="pph" id="pph_{{$no}}">Rp &ensp; 
                              <span>
                                 @php
                                    $pph = ($item->penguji_utama->golongan->pph * $sk_honor->honor_penguji)/100;
                                 @endphp
                                 {{ $pph }}
                              </span>
                           </td>
                           <td class="penerimaan" id="penerimaan_{{$no}}">Rp &ensp; 
                              <span>{{ $sk_honor->honor_penguji - $pph }}</span>
                           </td>
                         </tr>

                          <tr id="{{$no+=1}}">
                             <td>{{$no}}</td>
                              <td>{{$item->penguji_pendamping->nama}}</td>
                             <td>{{$item->penguji_pendamping->npwp}}</td>
                             <td>{{$item->penguji_pendamping->golongan->golongan}}</td>
                             <td id="penguji_{{$no}}" class="pengujiHonor">Rp &ensp; 
                                <span>{{ $sk_honor->honor_penguji }}</span></td>
                             <td class="pph" id="pph_{{$no}}">Rp &ensp; 
                                <span>
                                   @php
                                      $pph = ($item->penguji_pendamping->golongan->pph * $sk_honor->honor_penguji)/100;
                                   @endphp
                                   {{ $pph }}
                                </span>
                             </td>
                             <td class="penerimaan" id="penerimaan_{{$no}}">Rp &ensp; 
                                <span>{{ $sk_honor->honor_penguji - $pph }}</span>
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

   <div class="row">
      <div class="col-xs-12">
         @if($sk_honor->verif_dekan != 1)
            <div class="form-group" style="float: right;">
               <form method="post" action="{{ ( $sk_honor->tipe_sk->tipe == "SK Skripsi"? route('dekan.honor-skripsi.verif', $sk_honor->id) : route('dekan.honor-sempro.verif', $sk_honor->id) ) }}">
                  @csrf
                  @method('put')
                  <input type="hidden" name="verif_dekan" value="{{$sk_honor->verif_dekan}}">
                  
                  @if ($sk_honor->verif_dekan != 1)
                     <button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>
                  @endif
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik</button>
               </form>
            </div>
         @endif
      </div>
   </div>

   <div class="modal fade" id="modal-tarik-sk">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header bg-red">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title">Pesan Penarikan Honorarium</h4>
            </div>
            <form method="post" action="{{ ( $sk_honor->tipe_sk->tipe == "SK Skripsi"? route('dekan.honor-skripsi.verif', $sk_honor->id) : route('dekan.honor-sempro.verif', $sk_honor->id) ) }}">
               @csrf
               @method('PUT')

               <div class="modal-body">
                  <label for="pesan_revisi">Masukkan Pesan Revisi</label>
                  <textarea name="pesan_revisi" id="pesan_revisi" class="form-control">{{old('pesan_revisi')}}</textarea>
                  <input type="hidden" name="verif_dekan" value="{{$sk_honor->verif_dekan}}">

                  @error('pesan_revisi')
                     <p style="color: red;">{{ $message }}</p>
                  @enderror
               </div>

               <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>           
                  <button type="submit" name="tarik_btn" class="btn btn-danger">Tarik</button>
               </div>
            </form>
         </div>
         <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
   </div>
@endsection

@section('script')
   <script src="/js/btn_backTop.js"></script>
   <script type="text/javascript">
    @error('pesan_revisi')
      $("#modal-tarik-sk").modal("show");
    @enderror
    
    $("button[name='setuju_btn']").click(function(event) {
       event.preventDefault();
       $("input[name='verif_dekan']").val(1);
       $(this).parents("form").trigger('submit');
    });

    $("button[name='tarik_btn']").click(function(event) {
       event.preventDefault();
       $("input[name='verif_dekan']").val(2);
       $(this).parents("form").trigger('submit');
    });
   </script>
@endsection
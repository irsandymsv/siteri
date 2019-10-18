@extends('keuangan.keuangan_view')

@section('page_title')
	Pilih SK Akademik
@endsection

@section('judul_header')
	Honorarium SK Skripsi
@endsection

@section('content')
   <div class="row">
      <div class="col-xs-12">
	      <div class="box box-primary">
            <div class="box-header">
               <h3 class="box-title">Pilih SK Akademik</h3>
               @if(is_null($sk_akademik))
               <p>Pilih SK {{ ($sk_akademik[0]->tipe_sk->tipe == 'SK Skripsi'? "Skripsi" : "Sempro") }} di bawah ini yang ingin dibuatkan daftar honorarium</p>
               @else
               <p>Pilih SK yang ada di bawah ini yang ingin dibuatkan daftar honorarium</p>
               @endif
            </div>

            <div class="box-body">
               <div class="table-responsive">
                  @if (is_null($sk_akademik))
                     <table id="table_data1" class="table table-bordered table-hovered">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Tanggal Dibuat</th>
                              <th>Daftar Honor</th>
                              <th>Opsi</th>
                           </tr>
                        </thead>

                        <tbody>
                           @php $no = 0; @endphp
                           @foreach($sk_akademik as $item)
                              <tr>
                                 <td>{{$no+=1}}</td>
                                 <td>
                                 	{{Carbon\Carbon::parse($item->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
                                 </td>
                                 <td>
                              	   @if(is_null($item->detail_sk[0]->id_sk_honor))
                              		   Tidak Ada
                              	   @else
                              		   Ada
                              	   @endif
                                 </td>
                                 <td>
                              	   @if(is_null($item->detail_sk[0]->id_sk_honor))
                                    <a href="{{route('keuangan.honor-skripsi.create', $item->id)}}" class="btn btn-success" title="Lihat daftar honor yang berdasarkan SK ini">Buat Daftar Honor</a>
                              	   @else
                                    <a href="{{ route('keuangan.honor-skripsi.show', $item->detail_sk[0]->id_sk_honor) }}" class="btn btn-primary" title="Lihat daftar honor yang berdasarkan SK ini">Lihat Daftar Honor</a>
                              	   @endif
                                 </td>
                              </tr>
                           @endforeach
                        </tbody>
                     </table> 
                  @else
                     <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Maaf</h4>
                           Data SK Skripsi Tidak Ditemukan
                     </div>
                  @endif
               </div>
            </div>
	      </div>
      </div>
   </div>
@endsection
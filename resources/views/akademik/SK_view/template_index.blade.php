@extends('layouts.template')

@section('side_menu')
   @include('include.akademik_menu')
@endsection

@section('page_title')
	Daftar Template SK Akademik
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
@endsection

@section('judul_header')
	Template SK Akademik
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-success">
   			<div class="box-header">
              <h3 class="box-title">Daftar Template SK Akademik</h3>

              <div style="float: right;">
            	<a href="{{ route('akademik.template-sk.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Buat Template SK</a>
              </div>
            </div>

            <div class="box-body">
            	<div class="table-responsive">
            		<table id="table_data1" class="table table-bordered table-hovered">
	            		<thead>
		            		<tr>
		            			<th>No</th>
                           <th>Tipe Template</th>
		            			<th>Tanggal Dibuat</th>
		            			<th>Pilihan</th>
		            		</tr>
		            	</thead>
		            	<tbody>
                        @foreach ($nama_template as $item)
<<<<<<< HEAD
                           <tr>
                               @if($item->template_terbaru!=null)
                              <td>1</td>
                              <td>{{$item->nama}}</td>
                              <td>{{Carbon\Carbon::parse($item->template_terbaru->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</td>
                              <td>
                                 <a href="{{ route('akademik.template-sk.edit', $item->template_terbaru->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                              </td>
                              @else
                              @endif
                           </tr>
=======
                           @if (!is_null($item->template_terbaru))
                             <tr>
                                <td>1</td>
                                <td>{{$item->nama}}</td>
                                <td>{{Carbon\Carbon::parse($item->template_terbaru->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</td>
                                <td>
                                   <a href="{{ route('akademik.template-sk.edit', $item->template_terbaru->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                </td>
                             </tr>
                           @endif
>>>>>>> 3ae2fe7b2a7e4a4efa498f1f0de0f29a80abe9f6
                        @endforeach

                       {{-- @if (!is_null($template_sempro))
                           <tr>
                              <td>1</td>
                              <td>{{$template_sempro->nama_template->nama}}</td>
                              <td>{{Carbon\Carbon::parse($template_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}</td>
                              <td>
                                 <a href="{{ route('akademik.template-sk.edit', $template_sempro->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                              </td>
                           </tr>
                       @endif

                       @if (!is_null($template_skripsi))
                          <tr>
                             <td>2</td>
                             <td>{{$template_skripsi->nama_template->nama}}</td>
                             <td>{{ Carbon\Carbon::parse($template_skripsi->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
                             <td>
                                 <a href="{{ route('akademik.template-sk.edit', $template_skripsi->id) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                              </td>
                          </tr>
                       @endif --}}
		            	</tbody>
		            </table>
            	</div>
            </div>
   		</div>
   	</div>
	</div>

	<div id="success_delete" class="pop_up_info">
        <h4><i class="icon fa fa-check"></i>  <span></span></h4>
    </div>

	<div class="modal modal-danger fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Konfirmasi Penghapusan</h4>
          </div>
          <div class="modal-body">
            <p>Apakah anda yakin ingin menghapus surat template ini?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Batal</button>
			<button type="button" id="hapusBtn" data-dismiss="modal" class="btn btn-outline">Hapus</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
	<script type="text/javascript">

	</script>
@endsection

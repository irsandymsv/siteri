@extends('ktu.ktu_view')

@section('page_title')
	Detail Surat Tugas Pembimbing Skripsi
@endsection

@section('css_link')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="/css/custom_style.css">
	<style type="text/css">
      .box-body{
         width: 70%;
         margin: auto;
         margin-bottom: 20px;
         margin-top: 20px;
         font-family: 'Times New Roman';
         font-size: 16px;
         padding: 20px 50px;
         border: 1px solid black;
      }

      #kop_surat{
         padding: 5px;
         overflow: hidden;
         border-bottom: 3px solid black;
      }

      #logo{
         float: left;
         width: 15%;
      }

      #logo img{
         width: 100%;
         height: auto;
         margin-top: 10pt;

      }

      #keterangan_kop{
         width: 85%;
         float: left;
         text-align: center;
      }

      #body_surat{
         text-align: justify-all;
      }

      .top-title{
         margin-top: 10px;
         text-align: center;
      }

      .judul_surat{
         font-size: 18px;
         text-decoration: underline;
         font-weight: bold;
      }

      #detail_table tr td:first-child{
         /*padding-right: 55px;*/
         width: 150px;
         vertical-align: top;
      }

      .header_18{
         font-size: 18px;
      }

      .underline{
         text-decoration: underline;
      }

      .ttd-right{
         float: right;
      }
	</style>
@endsection

@section('judul_header')
	Surat Tugas Pembimbing Skripsi
@endsection

@section('content')
	<div class="row">
   	<div class="col-xs-12">
   		<div class="box box-primary">
   			<div class="box-header">
               <h3 class="box-title">Detail Surat Tugas Pembimbing Skripsi</h3><br>
               Status:
               @if ($surat_tugas->verif_ktu == 0)
                  Belum Diverifikasi
               @elseif($surat_tugas->verif_ktu == 2)
                  <label class="label bg-red">Butuh Revisi</label>
               @else
                  <label class="label bg-green">Sudah Diverifikasi</label>
               @endif

               @if(session()->has('verif_ktu'))
                  <br><br>
                  <div class="alert alert-success alert-dismissible" style="margin: auto;">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     <h4><i class="icon fa fa-check"></i> Berhasil</h4>
                     {{session('verif_ktu')}}
                  </div>
               @endif

               @php
                  Session::forget('verif_ktu');
               @endphp
            </div>

            <div class="box-body">
         		<div id="kop_surat">

                  <div id="logo">
                     <img src="{{ asset('/image/logo-unej.png') }}">
                  </div>

                  <div id="keterangan_kop">
                     <span class="header_18">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</span><br>
                     <span class="header_18">UNIVERSITAS JEMBER</span><br>
                     <span class="header_18">FAKULTAS ILMU KOMPUTER</span>

                     <br>

                     <span>Jalan Kalimantan No. 37 Kampus Tegal Boto Jember 68121</span><br>
                     <span>Telepon 0331 326935, Faximile 0331 326911</span><br>
                     <span>Website : <i class="underline">www.ilkom.unej.ac.id</i></span>
                  </div>
               </div>

               <div id="body_surat">
                  <p class="top-title">
                     <span class="judul_surat">SURAT TUGAS</span><br>
                     <span>Nomor: {{ $surat_tugas->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($surat_tugas->created_at)->year }}</span>
                  </p>

                  <p>
                     Berdasarkan Hasil Evaluasi Komisi Bimbingan Program Studi Sistem Informasi, maka dengan ini Dekan Fakultas Ilmu Komputer menugaskan kepada nama dosen yang tersebut di bawah ini:
                  </p>

                  <table id="detail_table">
                     <tr>
                        <td>Nama</td>
                        <td>: {{ $surat_tugas->dosen1->nama }}</td>
                     </tr>
                     <tr>
                        <td>NIP</td>
                        <td>: {{ $surat_tugas->id_dosen1 }}</td>
                     </tr>
                     <tr>
                        <td>Jabatan</td>
                        <td>: {{ $surat_tugas->dosen1->fungsional->jab_fungsional }}</td>
                     </tr>
                     <tr>
                        <td>Sebagai</td>
                        <td>: <b>Pembimbing Utama</b></td>
                     </tr>

                     <tr><td colspan="2"><br></td></tr>

                     <tr>
                        <td>Nama</td>
                        <td>: {{ $surat_tugas->dosen2->nama }}</td>
                     </tr>
                     <tr>
                        <td>NIP</td>
                        <td>: {{ $surat_tugas->id_dosen2 }}</td>
                     </tr>
                     <tr>
                        <td>Jabatan</td>
                        <td>: {{ $surat_tugas->dosen2->fungsional->jab_fungsional }}</td>
                     </tr>
                     <tr>
                        <td>Sebagai</td>
                        <td>: <b>Pembimbing Pendamping</b></td>
                     </tr>

                     <tr><td><br></td></tr>
                     <tr><td colspan="2">untuk membimbing skripsi mahasiswa:</td></tr>
                     <tr>
                        <td>Nama</td>
                        <td>: {{ $surat_tugas->detail_skripsi->skripsi->mahasiswa->nama }}</td>
                     </tr>
                     <tr>
                        <td>NIM</td>
                        <td>: {{ $surat_tugas->detail_skripsi->skripsi->nim }}</td>
                     </tr>
                     <tr>
                        <td>Program Studi</td>
                        <td>: {{ $surat_tugas->detail_skripsi->skripsi->mahasiswa->bagian->bagian }}</td>
                     </tr>
                     <tr>
                        <td>Dengan Judul</td>
                        <td>: {{ $surat_tugas->detail_skripsi->judul }}</td>
                     </tr>
                  </table>

                  <br>
                  <p>Demikian surat tugas ini ditetapkan untuk dilaksanakan sebaik-baiknya.</p>
                  <br>

                  <div class="ttd-right">
                     Jember, {{ Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }} <br>
                     Dekan,
                     <br><br><br><br>
                     <span style="text-transform: uppercase;">{{ $dekan->nama }}</span><br>
                     <span>NIP. {{ $dekan->no_pegawai }}</span>
                  </div>

                  <p style="clear: both;">Tembusan: </p>
                  <ol>
                     <li>Dosen Pembimbing</li>
                     <li>Mahasiswa yang bersangkutan</li>
                  </ol>
               </div>
            </div>

            <div class="box-footer">
               @if ($surat_tugas->verif_ktu != 1)
                  <form action="{{ route('ktu.sutgas-pembimbing.verif', $surat_tugas->id) }}" method="post">
                     @csrf
                     @method('put')
                     <input type="hidden" name="verif_ktu" value="{{$surat_tugas->verif_ktu}}">
                     <button type="submit" name="setuju_btn" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button> &ensp;
                     <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-tarik-sk"><i class="fa fa-close"></i> Tarik Surat</button>
                  </form>
               @endif
            </div>

   		</div>
   	</div>
	</div>

   <div class="modal fade" id="modal-tarik-sk">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-red">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Pesan Penarikan Surat Tugas</h4>
          </div>
          <form method="post" action="{{ route('ktu.sutgas-pembimbing.verif', $surat_tugas->id) }}">
            @csrf
            @method('PUT')
             <div class="modal-body">
               <label for="pesan_revisi">Masukkan Pesan Revisi</label>
               <textarea name="pesan_revisi" id="pesan_revisi" class="form-control">{{old('pesan_revisi')}}</textarea>
               <input type="hidden" name="verif_ktu" value="{{$surat_tugas->verif_ktu}}">
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
   <script type="text/javascript">
      $("button[name='setuju_btn']").click(function(event) {
         event.preventDefault();
         $("input[name='verif_ktu']").val(1);
         $(this).parents("form").trigger('submit');
      });

      $("button[name='tarik_btn']").click(function(event) {
         event.preventDefault();
         $("input[name='verif_ktu']").val(2);
         $(this).parents("form").trigger('submit');
      });
   </script>
@endsection

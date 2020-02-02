<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
         /*html{
            font-size: 9pt;
         }

         .font-sm{
            font-size: 65%;
         }

         .table-bordered{
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
         }

         .table-bordered td,tr,th{
            border-collapse: collapse;
            border: 1px solid black;
         }

         .table-bordered tbody tr td:first-child{
            text-align: center;
         }*/

         .page-break {
            page-break-after: always;
         }

         .box-body{
            /*margin: auto;*/
            font-family: 'Times New Roman';
            font-size: 11pt;
            margin-top: 0;
            margin-bottom: 0.5pt;
            margin-left: 0.8cm;
            margin-right: 0.1cm;
         }

         .landscape{
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 0.5cm;
            margin-right: 0.5cm;
            font-size: 12pt;
         }

         #kop_surat{
            border-bottom: 3px solid black;
            /*padding: 5px;*/
            /*overflow: hidden;*/
         }

         #logo{
            float: left;
            width: 14%;
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
            margin-left: 0.3cm;
            margin-right: 0.3cm;
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

         #tabel_keterangan{
            margin-top: 0;
         }

         #detail_table{
            margin-top: 15px;
            width: 100%;
            border-collapse: collapse;
         }

         #detail_table th{
            text-align: center;
         }

         #detail_table td, th{
            border: 1px solid black;
            padding: 5px;
         }

         /*#detail_table td:last-child{
            padding: 0;
         }*/

         #isi_template_surat{
            width: 100%;
         }

         #isi_template_surat table:nth-child(2) tr:nth-child(6){
            page-break-after: always;
         }

         .ttd-right{
              float: right;
           }

         .right-margin{
            margin-right: 60px;
         }

         thead th{
            text-align: center;
         }

         .to_center{
            text-align: center;
         }

         .nomor{
            width: 20px;
         }

         .nim{
            width: 50px;
         }

         .prodi{
            width: 70px;
         }

         /*.judul{
            width: 200px;
         }*/

         /*.dosen{
            width: 180px;
         }*/
    </style>
</head>

<body>
   <div class="box-body">
      <p style="margin-bottom: 0;">Lampiran Dekan Fakultas Ilmu Komputer Universitas Jember</p>
      <table id="tabel_keterangan">
         <tr>
            <td>Nomor   </td>
            <td>: {{ $sk->no_surat }}//UN25.1.15/SP/{{ Carbon\Carbon::parse($sk->created_at)->year }}</td>
         </tr>
         <tr>
            <td>Tanggal </td>
            <td>: {{ Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
         </tr>
         <tr>
            <td>Tentang    </td>
            <td>: Penetapan Dosen Pembahas Seminar Porposal Skripsi Mahasiswa Fakultas Ilmu Komputer Jember Tahun Akademik {{ $tahun_akademik['tahun_awal'].'/'.$tahun_akademik['tahun_akhir'] }}</td>
         </tr>
      </table>
      <table id="detail_table">
         <thead>
            <tr>
               <th>No</th>
               <th>NIM</th>
               <th>Nama Mahasiswa</th>
               <th>Program Studi</th>
               <th>Judul Skripsi</th>
               <th>Dosen Pembahas</th>
            </tr>
         </thead>
         <tbody>
            @foreach($detail_skripsi as $item)
            <tr>
               <td class="to_center nomor" rowspan="2">{{ $loop->index + 1 }}</td>
               <td class="nim" rowspan="2">{{$item->skripsi->nim}}</td>
               <td rowspan="2">{{$item->skripsi->mahasiswa->nama}}</td>
               <td class="prodi" rowspan="2">{{$item->skripsi->mahasiswa->prodi->nama}}</td>
               <td class="judul" rowspan="2">{{$item->judul}}</td>
               <td class="dosen">
                  {{ $item->surat_tugas[0]->dosen1->nama }}
                  {{-- <div class="tbl_row">
                     {{ $item->surat_tugas[0]->dosen1->nama }}
                  </div>
                  <div>
                     {{ $item->surat_tugas[0]->dosen2->nama }}
                  </div> --}}
               </td>
            </tr>
            <tr>
               <td class="dosen">
                  {{ $item->surat_tugas[0]->dosen2->nama }}
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
      <br><br>
      <div class="ttd-right right-margin">
         {{-- <br> --}}
         Dekan,
         <br><br><br><br>
         <span><b>{{ $dekan->nama }}</b></span><br>
         <span>NIP. {{ $dekan->no_pegawai }}</span>
      </div>
   </div>
</body>
</html>





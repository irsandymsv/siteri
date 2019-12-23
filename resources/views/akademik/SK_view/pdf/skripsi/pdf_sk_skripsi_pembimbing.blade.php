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
            margin: auto;
            font-family: 'Times New Roman';
            font-size: 12pt;
            margin-top: 0;
            margin-bottom: 0.5pt;
            margin-left: 0.8cm;
            margin-right: 0.8cm;
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

         #detail_table td:last-child{
            padding: 0;
         }

         #isi_template_surat{
            width: 100%;
            margin-top: 0;
         }

         #isi_template_surat ol{
            margin-top: 0;
            margin-bottom: 0;
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
    </style>
</head>

<body>
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
            <span class="judul_surat">KEPUTUSAN</span><br>
            <span>DEKAN FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</span><br>
            <span>Nomor: {{ $sk->no_surat_pembimbing }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($sk->created_at)->year }}</span><br>
            <small><b>tentang</b></small><br>
            <span>PENETAPAN DOSEN PEMBIMBING SKRIPSI MAHASISWA</span><br>
            <span>FAKULTAS ILMU KOMPUTER UNIVERSITAS JEMBER</span><br>
            <span>TAHUN AKADEMIK {{ $tahun_akademik['tahun_awal'].'/'.$tahun_akademik['tahun_akhir'] }}</span><br>
         </p>

         <div id="isi_template_surat">
            {!! $sk->template_pembimbing->isi !!}
         </div>
         <br>
         <div class="ttd-right">
            {{-- <br> --}}
            <table>
               <tr>
                  <td>Ditetapkan di </td>
                  <td>: </td>
                  <td>Jember</td>
               </tr>
               <tr>
                  <td>Pada tanggal </td>
                  <td>: </td>
                  <td>{{ Carbon\Carbon::parse($sk->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</td>
               </tr>
            </table>
            <br><br>
            
            Dekan,
            <br><br><br><br>
            <span style="text-transform: uppercase;"><b>{{ $dekan->nama }}</b></span><br>
            <span>NIP. {{ $dekan->no_pegawai }}</span>
         </div>

         <p style="clear: both;">Tembusan: </p>
         <ol>
            <li>Penjabat Wakil Dekan I, II;</li>
            <li>Kasubag. Tata Usaha;</li>
         </ol>
         <span>Fakultas Ilmu Komputer Universitas Jember.</span>
      </div>
   </div>
</body>
</html>





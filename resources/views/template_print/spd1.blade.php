<!DOCTYPE html>
<html>
<head>
	<title></title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        .html{
            display: inline-block;
        }

		.box-body{
		   margin: auto;
		   font-family: 'Times New Roman';
		   font-size: 11pt;
		   margin-top: 0;
         margin-bottom: 0.5pt;
         margin-left: 0.8cm;
         margin-right: 0.8cm; 
		}

		#kop_surat{

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
		   text-align: left;
         padding-bottom: 5pt;
		   /*width: 90%;*/
		   /* float: left; */
		}

		#body_surat{
         margin-left: 0.3cm;
         margin-right: 0.3cm; 
		   text-align: left;
		}

		.top-title{
		   margin-top: 10px;
		   text-align: center;
		}

		.judul_surat{
		   font-size: 12pt;
		   font-weight: bold;
         letter-spacing: 1pt;
		}
      div.garis{
         border-bottom: 3px solid black;
      }

      /* 
Generic Styling, for Desktops/Laptops 
*/
table { 
 margin-top: 20px;
margin-bottom: 20px;
  width: 100%; 
  border-collapse: collapse; 
}
/* Zebra striping */
th { 
  color: #000000; 
  font-weight: bold;
  text-align: left;
}
td, th { 
   text-align: left;
  padding: 6px; 
  border: 2px solid #000000;  
}
		.header_14{
		   font-size: 12pt;
		}

		.underline{
		   text-decoration: underline;
		}

		.ttd-right{
		   float: right;
		}

      .space_row{
         padding-top: 2pt;
         padding-bottom: 2pt;
      }
      .kop_kanan{
         float: right;
         margin-top: -60px;
         text-transform: uppercase;
      }
      ol {
    list-style-type: decimal;
    margin-block-start: 0;
    margin-block-end: 0;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 15px;
      }
    .tabel-no{
       width: 10%;
    }
    .tabel-1{
       width: 35%;
    }
    .tabel-2{
       width: 75%;
    }
    ul {
  list-style-type: none;
  margin-left: -10px;
}
.page_break { page-break-before: always; }
	</style>
</head>
<body>
   <div class="box-body">
		<div id="kop_surat">

         <div style="margin-bottom: 10px;" id="keterangan_kop">
            <span class="header_14">KEMENTERIAN : PENDIDIKAN DAN KEBUDAYAAN</span> <br>
            <span class="header_14">DIREKTORAT JENDERAL : PENDIDIKAN TINGGI</span><br>
            <span class="header_14">FAKULTAS ILMU KOMPUTER</span>
         </div>
         <div style="margin-bottom: 35px;" class="kop_kanan">
            <span>LEMBAR KE : </span><br>
         <span>NOMOR / KODE : {{$surat_tugas->nomor_surat}}</span><br>
         </div>
      </div>

      <div style="margin-bottom: 10px;" id="body_surat" class="margin-body">
         <p class="top-title">
            <span class="judul_surat">SURAT PERJALANAN DINAS (SPD)</span>
         </p>
         {{-- <div class="garis"></div> --}}

         <table>
	<tbody>
	<tr>
		<td class="tabel-no" style="text-align: center;" width="20">1</td>
		<td class="tabel-1" width="40%">Pejabat Pembuat Komitmen</td>
		<td class="tabel-2" colspan=2>Dekan Fakultas Ilmu Komputer Universitas Jember</td>
   </tr>
   
</tbody>
	<tbody>
      <tr>
          <td style="text-align: center">2</td>
          <td><span>Nama / NIP pegawai yang melaksanakan perjalanan dinas</span><br/></td>
          <td colspan=2><span>{{Auth::user()->nama}}</span><br>
            <span>NIP. {{Auth::user()->no_pegawai}}</span></td>
      </tr>
      <tr>
         <td style="text-align: center" width="20">3</td>
         <td style="left: 0;" width="40%">
            <ol type="a">
            <li> Pangkat dan Golongan</li>
            <li> Jabatan</li>
            <li> Gaji Pokok</li>
            <li> Tingkat menurut Peraturan Perjalanan Dinas</li>
         </ol>
      </td>
         <td style="left: 0;" width="40%" colspan=2> 
            <ul>
            <li>1. {{Auth::user()->pangkatnya->pangkat}} - {{Auth::user()->golongannya->golongan}}</li> 
            <li>2. {{Auth::user()->jabatannya->jabatan}}</li>
            <li>3. </li>
            <li>4. </li>
         </ul></td>
      </tr>
      <tr>
         <td style="text-align: center" width="20">4</td>
         <td style="left: 0;" width="40%">
         Maksud Perjalanan Dinas
      </td>
   <td colspan=2>{{$surat_tugas->keterangan}}</td>
      </tr>
      <tr>
         <td style="text-align: center" width="20">5</td>
         <td style="left: 0;" width="40%">
         Alat Angkut yang dipergunakan
      </td>
   <td colspan=2>{{$spd->jenis_kendaraan['nama']}}</td>
      </tr>
      <tr>
         <td style="text-align: center" width="20">6</td>
         <td style="left: 0;" width="40%">
            <ol type="a">
               <li> Tempat Berangkat</li>
               <li> Tempat Tujuan</li>
            </ol>
      </td>
         <td colspan=2> <ol type="a">
            <li> {{$spd->asal}}</li>
            <li> {{$spd->tujuan}}</li>
         </ol></td>
      </tr>
      <tr>
         <td class="td-modal" style="text-align: center" width="20">7</td>
         <td style="left: 0;" width="40%">
            <ol type="a">
               <li> Lamanya Perjalanan Dinas</li>
               <li> Tanggal Berangkat</li>
               <li> Tanggal Kembali</li>
            </ol>
      </td>
         <td colspan=2><ol type="a">
            @php
                $to = \Carbon\Carbon::createFromFormat('Y-m-d', $surat_tugas->started_at);
                $from = \Carbon\Carbon::createFromFormat('Y-m-d', $surat_tugas->end_at);
                $lama = $to->diffInDays($from)+1;
            @endphp
            <li> {{ $lama }} Hari</li>
            <li>{{ Carbon\Carbon::parse($surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</li>
            <li>{{ Carbon\Carbon::parse($surat_tugas->end_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</li>
         </ol></td>
      </tr>
      <tr>
         <td class="td-modal" style="text-align: center" width="20">8</td>
         <td style="left: 0;" width="40%">
           Nama Pengikut
      </td>
         <td>Tanggal Lahir</td>
         <td>Keterangan</td>
      </tr>
      <tr>
         <td class="td-modal" style="text-align: center" width="20"></td>
         <td style="left: 0;" width="40%">
            <ol>
               <li>..............................................................</li>
               <li>..............................................................</li>
               <li>..............................................................</li>
            </ol>
      </td>
         <td></td>
         <td></td>
      </tr>
      <tr>
         <td class="td-modal" style="text-align: center" width="20">9</td>
         <td style="left: 0;" width="40%">
            Pemberian Anggaran :
            <ol type="a">
               <li> Instansi</li>
               <li> Mata Anggaran</li>      
            </ol>
      </td>
         <td style="left: 0;" width="40%" colspan=2>
            <ul >
               <li> Fakultas Ilmu Komputer UNEJ</li>
               <li> 5742.994.001.054.C.524111</li>      
            </ul> 
         </td>
      </tr>
      <tr>
         <td class="td-modal" style="text-align: center" width="20">10</td>
         <td style="left: 0;" width="40%">
            Keterangan lain-lain
      </td>
         <td colspan="2"></td>
      </tr>
	</tbody>
</table>

<br/>
<br/>
         <div class="ttd-right">
            <span>Dikeluarkan di Jember</span><br/>
            Pada Tanggal : {{ $terbit->format('d F Y') }} <br><br><br>
            Universitas Jember <br>
            Fakultas Ilmu Komputer <br>
            Dekan,
            <br><br><br><br><br>
            <span ><b>{{ $dekan->nama }}</b></span><br>
            <span>NIP. {{ $dekan->no_pegawai }}</span>
         </div>
         <p style="clear: both; font-size: 9pt">Tembusan: </p>
         <ol>
            <li style="font-size: 9pt">Kepala Bagian Keuangan Univ. Jember;</li>
            <li style="font-size: 9pt">Pegawai yang Bersangkutan</li>
         </ol>
      </div>
   </div>

   <div class="page_break"></div>
   <!-- SPD 2 -->
   <div class="box-body">
		<div id="kop_surat">

         <div id="keterangan_kop">
            <span class="header_14">Berangkat dari (tempat kedudukan) </span> <br>
            <span class="header_14">Pada Tanggal</span><br>
            <span class="header_14">Tujuan</span>
         </div>
         <div class="kop_kanan">
            <span>: {{$spd->asal}}</span><br>
            <span>: {{ Carbon\Carbon::parse($surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y') }}</span><br>
            <span>: {{$spd->tujuan}}</span><br>
         </div>
         <hr style="margin-top: 60px; >
      </div>

      <div style="margin-top: 30px;" id="body_surat" class="margin-body">
         <p class="top-title">
            <span class="">Universitas Jember</span><br>
            <span class="">Fakultas Ilmu Komputer</span><br>
            <span class="">Dekan,</span><br><br><br><br>
            <span class="">({{ $dekan->nama }})</span><br>
            <span class="">NIP. {{ $dekan->no_pegawai }}</span>
         </p>
         <table id="tabel">
	<tbody>
	<tr>
		<td style="text-align: center; width:5%;">I</td>
      <td style="width:45%;"><span style="display:inline-block; width: 150px;">Tiba di</span>: {{$spd->tujuan}}<br>
         <span style="display:inline-block; width: 150px;">Pada tanggal</span>: <br>
         <span style="display:inline-block; width: 150px;">Kepala</span><br><br><br><br>
         <span style="margin-left: 150px;">(....................................................)</span><br>
         <span style="margin-left: 150px;">NIP.</span>
      </td>
		<td style="width:50%;" colspan=2><span style="display:inline-block; width: 150px;">Berangkat dari</span>: {{$spd->tujuan}}<br>
         <span style="display:inline-block; width: 150px;">Ke </span>: {{$spd->asal}}<br>
         <span style="display:inline-block; width: 150px;">Pada tanggal </span>: <br>
         <span style="display:inline-block; width: 150px;">Kepala</span><br><br><br><br>
         <span style="margin-left: 100px;">(....................................................)</span><br>
         <span style="margin-left: 150px;">NIP.</span></td>
   </tr>
   
</tbody>
	<tbody>
      <tr>
         <td style="text-align: center; width:5%;">II</td>
         <td style="width:45%;"><span style="display:inline-block; width: 150px;">Tiba di</span>: <br>
            <span style="display:inline-block; width: 150px;">Pada tanggal</span>: <br>
            <span style="display:inline-block; width: 150px;">Kepala</span><br><br><br><br>
            <span style="margin-left: 150px;">(....................................................)</span><br>
            <span style="margin-left: 150px;">NIP.</span>
         </td>
         <td style="width:50%;" colspan=2><span style="display:inline-block; width: 150px;">Berangkat dari</span>: <br>
            <span style="display:inline-block; width: 150px;">Ke </span>: <br>
            <span style="display:inline-block; width: 150px;">Pada tanggal </span>: <br>
            <span style="display:inline-block; width: 150px;">Kepala</span><br><br><br><br>
            <span style="margin-left: 100px;">(....................................................)</span><br>
            <span style="margin-left: 150px;">NIP.</span></td>
      </tr>
      <tr>
         <td style="text-align: center; width:5%;">III</td>
         <td style="width:45%;"><span style="display:inline-block; width: 150px;">Tiba di</span>: <br>
            <span style="display:inline-block; width: 150px;">Pada tanggal</span>: <br>
            <span style="display:inline-block; width: 150px;">Kepala</span><br><br><br><br>
            <span style="margin-left: 150px;">(....................................................)</span><br>
            <span style="margin-left: 150px;">NIP.</span>
         </td>
         <td style="width:50%;" colspan=2><span style="display:inline-block; width: 150px;">Berangkat dari</span>: <br>
            <span style="display:inline-block; width: 150px;">Ke </span>: <br>
            <span style="display:inline-block; width: 150px;">Pada tanggal </span>: <br>
            <span style="display:inline-block; width: 150px;">Kepala</span><br><br><br><br>
            <span style="margin-left: 100px;">(....................................................)</span><br>
            <span style="margin-left: 150px;">NIP.</span></td>
      </tr>
      <tr>
         <td style="text-align: center; width:5%;">IV</td>
         <td style="width:45%;"><span style="display:inline-block; width: 150px;">Tiba di</span>: <br>
            <span style="display:inline-block; width: 150px; ">Pada tanggal</span>: <br><br><br>
            <span class="">Universitas Jember</span><br>
            <span class="">Fakultas Ilmu Komputer</span><br>
            <span class="">Dekan,</span><br><br><br><br><br>
            <span class="">({{ $dekan->nama }})</span><br>
            <span class="">NIP. {{ $dekan->no_pegawai }}</span>
         </td>
         <td colspan=2><span>Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya</span><br><br>
            <span>Universitas Jember</span><br>
            <span>Fakultas Ilmu Komputer</span><br>
            <span>Dekan,</span><br><br><br><br><br>
            <span>({{ $dekan->nama }})</span><br>
            <span>NIP. {{ $dekan->no_pegawai }}</span>
      </tr>
      <tr>
         <td>V</td>
         <td>Catatan lain-lain</td>
         <td colspan="2">P</td>
      </tr>
      <tr>
         <td style="border: none;">VI</td>
         <td style="border: none;" colspan="3">
            PERHATIAN :
            <p>PPK yang berwenang menerbitkan SPD pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat / tiba serta Bendahara pengeluaran bertanggung jawab berdasarkan Peraturan-peraturan keuangan negara apabila negara menderita rugi akibat kesalahan dan kealpaannya.</p>
         </td>
      </tr>
	</tbody>
</table>

<br/>
<br/>
   </div>
</body>
</html>

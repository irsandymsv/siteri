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
           margin-top: 150px;
		}

      .space_row{
         padding-top: 2pt;
         padding-bottom: 2pt;
      }
	</style>
</head>
<body>
   <div class="box-body">
		<div id="kop_surat">
         <div id="logo">
            <img src={{ public_path("image/logo-unej.png") }}>
         </div>

         <div id="keterangan_kop">
            <span class="header_14">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</span><br>
            <span class="header_14">UNIVERSITAS JEMBER</span><br>
            <span class="header_14">FAKULTAS ILMU KOMPUTER</span>
            <br>
            <span>Jalan Kalimantan No. 37 Kampus Tegal Boto Jember 68121</span><br>
            <span>Telepon 0331 326935, Faximile 0331 326911</span><br>
            <span>Website : <i class="underline">www.ilkom.unej.ac.id</i></span>
         </div>
      </div>

      <div id="body_surat" class="margin-body">
         <p class="top-title">
            <span class="judul_surat">SURAT TUGAS</span><br>
            <span>Nomor: {{  $surat_tugas->nomor_surat}}/UN25.1.15/KP/{{ Carbon\Carbon::parse($surat_tugas->created_at)->year }}</span>
         </p>

         <p style="margin-bottom: 0pt;">
            Wakil Dekan II Fakultas Ilmu Komputer Universitas Jember, dengan ini menugaskan kepada :
         </p>

         <table>
	<thead>
	<tr>
		<th width="20" style="text-align: center;">No</th>
		<th style="text-align: center" width="60%">Nama</th>
		<th style="text-align: center">Jabatan</th>
	</tr>
	</thead>
	<tbody>
        @foreach ($dosen_tugas as $key => $dosen)
        <tr>
            <td style="text-align: center">{{$key+1}}</td>
            <td><span>{{$dosen->user['nama']}}</span><br/><span>{{$dosen->user['no_pegawai']}}</span></td>
            <td >{{$dosen->user->jabatannya['jabatan']}}</td>
        </tr>
        @endforeach


	</tbody>
</table>
<div class="deskripsi">
Sebagai Panitia Kegiatan Workshop {{$surat_tugas->keterangan}} yang akan dilaksanakan pada tanggal {{ Carbon\Carbon::parse($surat_tugas->started_at)->locale('id_ID')->isoFormat('D MMMM Y') }} - {{ Carbon\Carbon::parse($surat_tugas->end_at)->locale('id_ID')->isoFormat('D MMMM Y') }}
</div>
<div style="margin-top: 30px;">
    Demikian surat tugas ini dikeluarkan untuk dilaksanakan dengan penuh rasa tanggung jawab.
</div>
         <div class="ttd-right">
            Jember, {{ Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }} <br>
            Wakil Dekan II,
            <br><br><br>
            <span><b>Windi Eka Yulia Retnani, S. Kom., MT</b></span><br>
            <span>NIP. 198403052010122002</span>
         </div>

         
      </div>
   </div>
</body>
</html>

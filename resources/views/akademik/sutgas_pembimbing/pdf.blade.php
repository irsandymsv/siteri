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
		   font-size: 12pt;
		   margin-top: 0;
         margin-bottom: 1pt;
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
		   font-size: 14pt;
		   text-decoration: underline;
		   font-weight: bold;
         letter-spacing: 1.5pt;
		}

		#detail_table tr td:first-child{
		   padding-right: 15px;
         vertical-align: top;
		}

		.header_14{
		   font-size: 14pt;
		}

		.underline{
		   text-decoration: underline;
		}

		.ttd-right{
		   float: right;
		}

      .space_row{
         padding-top: 7pt;
         padding-bottom: 7pt;
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
            <span>Nomor: {{ $surat_tugas->no_surat }}/UN25.1.15/SP/{{ Carbon\Carbon::parse($surat_tugas->created_at)->year }}</span>
         </p>

         <p style="margin-bottom: 0pt;">
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

            <tr><td class="space_row" colspan="2"></td></tr>

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

            {{-- <tr><td colspan="2"><br></td></tr> --}}
            <tr><td class="space_row" colspan="2">untuk membimbing skripsi mahasiswa:</td></tr>
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
               <td>: {{ $surat_tugas->detail_skripsi->skripsi->mahasiswa->prodi->nama }}</td>
            </tr>
            <tr>
               <td>Dengan Judul</td>
               <td>: {{ $surat_tugas->detail_skripsi->judul }}</td>
            </tr>
            <tr>
               <td class="space_row" colspan="2">Demikian surat tugas ini ditetapkan untuk dilaksanakan sebaik-baiknya.</td>
            </tr>
         </table>

         <div class="ttd-right">
            Jember, {{ Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }} <br>
            Dekan,
            <br><br><br><br>
            <span>{{ $dekan->nama }}</span><br>
            <span>NIP. {{ $dekan->no_pegawai }}</span>
         </div>

         <p style="clear: both;">Tembusan: </p>
         <ol>
            <li>Dosen Pembimbing</li>
            <li>Mahasiswa yang bersangkutan</li>
         </ol>
      </div>
   </div>
</body>
</html>

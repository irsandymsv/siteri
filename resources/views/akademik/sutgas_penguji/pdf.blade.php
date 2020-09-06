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

      #detail_table{
         margin-top: 0;
         padding-top: 0;
      }

		#detail_table tr td:first-child{
		   padding-right: 3px;
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
            <span class="header_14">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</span><br>
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
            Berdasarkan usulan Komisi Bimbingan Tugas Akhir, maka Wakil Dekan 1 Fakultas Ilmu Komputer Universitas Jember dengan ini menugaskan kepada nama Dosen yang tersebut di bawah ini sebagai Penguji pada Ujian Tugas Akhir Mahasiswa :
         </p>

         <table id="detail_table">
            <tr>
               <td>Nama</td>
               <td>: {{ ucwords(strtolower($surat_tugas->detail_skripsi->skripsi->mahasiswa->nama)) }}</td>
            </tr>
            <tr>
               <td>NIM</td>
               <td>: {{ $surat_tugas->detail_skripsi->skripsi->nim }}</td>
            </tr>
            <tr>
               <td>Progaram Studi</td>
               <td>: {{ $surat_tugas->detail_skripsi->skripsi->mahasiswa->prodi->nama }}</td>
            </tr>

            <!-- <tr><td><br></td></tr> -->
            <tr>
               <td class="space_row" colspan="2">Dengan Judul Tugas Akhir:<br></td>
            </tr>

            <tr>
               <td>Bhs Indonesia</td>
               <td>: {{ $surat_tugas->detail_skripsi->judul }}</td>
            </tr>
            <tr>
               <td>Bhs Inggris</td>
               <td>: <i>{{ $surat_tugas->detail_skripsi->judul_inggris }}</i></td>
            </tr>

            <tr>
               <td class="space_row" colspan="2">Yang dilaksanakan pada :</td>   
            </tr>

            <tr>
               <td>Hari/Tanggal</td>
               <td>: {{ Carbon\Carbon::parse($surat_tugas->tanggal)->locale('id_ID')->isoFormat('dddd, D MMMM Y') }}</td>
            </tr>
            <tr>
               <td>Jam Pelaksanaan</td>
               <td>: {{ Carbon\Carbon::parse($surat_tugas->tanggal)->format('H.i') }} WIB - selesai</td>
            </tr>
            <tr>
               <td>Tempat</td>
               <td>: {{ $surat_tugas->data_ruang->nama_ruang }}</td>
            </tr>

            {{-- <tr><td><br></td></tr> --}}
            <tr>
               <td class="space_row" colspan="2">Adapun nama-nama tersebut adalah :</td>
            </tr>

            <tr>
               <td colspan="2"><b>Penguji I</b></td>
            </tr>
            <tr>
               <td>Nama</td>
               <td>: {{ $surat_tugas->dosen1->nama }}</td>
            </tr>
            <tr>
               <td>NIP / NRP</td>
               <td>: {{ $surat_tugas->id_dosen1 }}</td>
            </tr>
            <tr>
               <td>Jabatan</td>
               <td>: {{ $surat_tugas->dosen1->fungsional->jab_fungsional }}</td>
            </tr>

            <tr>
               <td colspan="2"><b>Penguji II</b></td>
            </tr>
            <tr>
               <td>Nama</td>
               <td>: {{ $surat_tugas->dosen2->nama }}</td>
            </tr>
            <tr>
               <td>NIP / NRP</td>
               <td>: {{ $surat_tugas->id_dosen2 }}</td>
            </tr>
            <tr>
               <td>Jabatan</td>
               <td>: {{ $surat_tugas->dosen2->fungsional->jab_fungsional }}</td>
            </tr>

            <tr>
               <td colspan="2"><b>Dosen Pembimbing Utama</b></td>
            </tr>
            <tr>
               <td>Nama</td>
               <td>: {{ $sutgas_pembimbing->dosen1->nama }}</td>
            </tr>
            <tr>
               <td>NIP / NRP</td>
               <td>: {{ $sutgas_pembimbing->id_dosen1 }}</td>
            </tr>
            <tr>
               <td>Jabatan</td>
               <td>: {{ $sutgas_pembimbing->dosen1->fungsional->jab_fungsional }}</td>
            </tr>

            <tr>
               <td colspan="2"><b>Dosen Pembimbing Pendamping</b></td>
            </tr>
            <tr>
               <td>Nama</td>
               <td>: {{ $sutgas_pembimbing->dosen2->nama }}</td>
            </tr>
            <tr>
               <td>NIP / NRP</td>
               <td>: {{ $sutgas_pembimbing->id_dosen2 }}</td>
            </tr>
            <tr>
               <td>Jabatan</td>
               <td>: {{ $sutgas_pembimbing->dosen2->fungsional->jab_fungsional }}</td>
            </tr>

            <tr>
               <td colspan="2">Demikian surat tugas ini ditetapkan untuk dilaksanakan sebaik-baiknya.</td>
            </tr>
         </table>

         <div class="ttd-right">
            Jember, {{ Carbon\Carbon::parse($surat_tugas->created_at)->locale('id_ID')->isoFormat('D MMMM Y') }} <br>
            Wakil Dekan 1,
            <br><br><br><br>
            <span><b>{{ $wadek1->nama }}</b></span><br>
            <span>NIP. {{ $wadek1->no_pegawai }}</span>
         </div>

         <p style="clear: both;">Tembusan: </p>
         <ol>
            <li>Dosen Penguji;</li>
            <li>Mahasiswa yang bersangkutan;</li>
            <li>Arsip</li>
         </ol>
      </div>
   </div>
</body>
</html>

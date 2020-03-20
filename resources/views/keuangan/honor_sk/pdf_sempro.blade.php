<!DOCTYPE html>
<html>
<head>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">

         html{
            font-size: 8pt;
         }

         .page-break {
            page-break-after: always;
         }

         .font-sm{
            font-size: 65%;
         }

         .main_table{
            margin-left: -0.9cm;
            margin-right: -0.9cm;
         }

         .tabel_keterangan td:first-child{
           padding-right: 10px;
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

         .table-bordered td{
             padding: 2px;
         }

         thead th{
            text-align: center;
         }

         .nama_dosen{
            width: 200px;
         }

         .first_td{
            text-align: center;
            width: 20px;
         }

         .jml_total td{
           font-weight: bold;
           background-color: white;
         }

         .jml_total td:first-child{
           text-align: center;
         }

         .to_center{
            text-align: center;
         }

         .to_left{
            float: left;
            margin-left: 25px;
         }

         .to_right{
            float: right;
            margin-right: 175px;
         }

         .ttd_row{
            clear: both;
            width: 100%;
         }

         .ttd_row div{
            width: 30%;
            float: left;
            margin-left: 25px;
         }

         .width-narrow {
            width: 5%;
         }

         .golongan{
            width: 20px;
         }

         .nama_mhs{
            width: 130px;
         }

    </style>
</head>

<body>
   <div>
      <table cellpadding="0" cellspacing="0">
         <tr>
            <td valign="top">DAFTAR</td>
            <td valign="top">: </td>
            <td valign="top">
               Honorarium Dosen Pembahas Seminar Proposal Skripsi Mahasiswa Fak. Ilmu Komputer Universitas Jember T.A {{ $tahun_akademik['tahun_awal'] }}/{{ $tahun_akademik['tahun_akhir'] }} Di Lingkungan Fakultas Ilmu Komputer Universitas Jember
            </td>
         </tr>
         <tr>
            <td valign="top">SESUAI</td>
            <td valign="top">: </td>
            <td valign="top">
               SK Dekan Fak. Ilmu Komputer UNEJ  No. {{ $sk_honor->sk_sempro->no_surat }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->year}} Tanggal {{Carbon\Carbon::parse($sk_honor->sk_sempro->created_at)->locale('id_ID')->isoFormat('D MMMM Y')}}
            </td>
         </tr>
      </table>
      <br>
      <div class="main_table">
         <table class="table table-bordered" style="margin-top:5px">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Tim Pembahas I/II</th>
                  <th>NPWP</th>
                  <th>Nama Mahasiswa/NIM</th>
                  <th>Gol</th>
                  <th>Honorarium</th>
                  <th>PPH psl 21 5%-15%</th>
                  <th class="width-narrow">Penerimaan</th>
                  <th>Tanda Tangan</th>
               </tr>
            </thead>

            <tbody id="tbl_pembahas">
               @php $no=0; $a = 1; $b = 1; $total_honor=0; $total_pph=0; $total_penerimaan=0; @endphp

               @foreach($detail_skripsi as $item)
                  //Dosen1
                  @php
                     $gol = "";
                     if (is_null($item->surat_tugas[0]->dosen1->golongan)) {
                        $gol = "-";
                     }
                     else{
                        $gol = $item->surat_tugas[0]->dosen1->golongan->golongan;
                        $gol = substr($gol,0,(strlen($gol)-2 ));
                     }
                     $pph = ($item->surat_tugas[0]->dosen1->pph * $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor)/100;
                     $penerimaan = $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor - $pph;
                  @endphp
                  @if ($no+1 == 4*$a-1)
                     @php $a+=1; @endphp
                     <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                  @else
                     <tr id="{{ $no+=1 }}">
                  @endif
                     <td class="first_td">{{ $no }}</td>
                     <td class="nama_dosen">{{ $item->surat_tugas[0]->dosen1->nama }}</td>
                     <td class="to_center">{{ $item->surat_tugas[0]->dosen1->npwp }}</td>
                     <td rowspan="2" class="nama_mhs">
                        <p>{{ $item->skripsi->mahasiswa->nama }}</p>
                        <p>NIM: {{ $item->skripsi->nim }}</p>
                     </td>
                     <td class="to_center golongan">{{ $gol }}</td>
                     <td id="penguji_{{$no}}">Rp
                        {{ number_format($sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor, 0, ",", ".") }}
                     </td>
                     <td>Rp
                        {{ number_format($pph, 0, ",", ".") }}
                     </td>
                     <td class="width-narrow">Rp
                        {{ number_format($penerimaan, 0, ",", ".") }}
                     </td>
                     <td>{{ $no }}.</td>

                     @php
                        $total_honor+=$sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor;
                        $total_pph+=$pph;
                        $total_penerimaan+=$penerimaan;
                     @endphp
                  </tr>

                  //Dosen2
                  @php
                     $gol = "";
                     if (is_null($item->surat_tugas[0]->dosen2->golongan)) {
                        $gol = "-";
                     }
                     else{
                        $gol = $item->surat_tugas[0]->dosen2->golongan->golongan;
                        $gol = substr($gol,0,(strlen($gol)-2 ));
                     }
                     $pph = ($item->surat_tugas[0]->dosen2->pph * $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor)/100;
                     $penerimaan = $sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor - $pph;
                  @endphp
                  @if ($no+1 == 4*$b)
                     @php $b+=1; @endphp
                     <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                  @else
                     <tr id="{{ $no+=1 }}">
                  @endif
                     <td class="first_td">{{ $no }}</td>
                     <td class="nama_dosen">{{ $item->surat_tugas[0]->dosen2->nama }}</td>
                     <td class="to_center">{{ $item->surat_tugas[0]->dosen2->npwp }}</td>
                     <td class="to_center golongan">{{ $gol }}</td>
                     <td id="penguji_{{$no}}">Rp
                        {{ number_format($sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor, 0, ",", ".") }}
                     </td>
                     <td>Rp
                        {{ number_format($pph, 0, ",", ".") }}
                     </td>
                     <td class="width-narrow">Rp
                        {{ number_format($penerimaan, 0, ",", ".") }}
                     </td>
                     <td class="ttd_dosen">{{ $no }}.</td>

                     @php
                        $total_honor+=$sk_honor->detail_honor[0]->histori_besaran_honor->jumlah_honor;
                        $total_pph+=$pph;
                        $total_penerimaan+=$penerimaan;
                     @endphp
                  </tr>
               @endforeach

               <tr class="jml_total">
                  <td colspan="5">Jumlah</td>
                  <td>Rp {{ number_format($total_honor, 0, ",", ".") }}</td>
                  <td>Rp {{ number_format($total_pph, 0, ",", ".") }}</td>
                  <td>Rp {{ number_format($total_penerimaan, 0, ",", ".") }}</td>
                  <td></td>
               </tr>
                @php
                    function penyebut($nilai) {
                        $nilai = abs($nilai);
                        $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
                        $temp = "";
                        if ($nilai < 12) {
                            $temp = " ". $huruf[$nilai];
                        } else if ($nilai <20) {
                            $temp = penyebut($nilai - 10). " Belas";
                        } else if ($nilai < 100) {
                            $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
                        } else if ($nilai < 200) {
                            $temp = " Seratus" . penyebut($nilai - 100);
                        } else if ($nilai < 1000) {
                            $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
                        } else if ($nilai < 2000) {
                            $temp = " Seribu" . penyebut($nilai - 1000);
                        } else if ($nilai < 1000000) {
                            $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
                        } else if ($nilai < 1000000000) {
                            $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
                        } else if ($nilai < 1000000000000) {
                            $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
                        } else if ($nilai < 1000000000000000) {
                            $temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
                        }
                        return $temp;
                    }
                    function terbilang($nilai) {
                        if($nilai<0) {
                            $hasil = "minus ". trim(penyebut($nilai));
                        } else {
                            $hasil = trim(penyebut($nilai));
                        }
                        return $hasil;
                    }
                @endphp
               <tr class="jml_total">
                  <td colspan="9">Terbilang:
                        @php
                            echo(terbilang($total_honor).' Rupiah');
                        @endphp
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
      <br>
      <span class="to_left">Mengetahui</span>
      <span class="to_right">Jember</span><br>
      <div class="ttd_row">
         <div>
            PPK,
            <br><br><br><br>
            <span><b>{{ $dekan->nama }}</b></span><br>
            <span>NIP. {{ $dekan->no_pegawai }}</span>
         </div>

         <div>
           Kasubag TU,
           <br><br><br><br>
           <span><b>{{ $ktu->nama }}</b></span><br>
           <span>NIP. {{ $ktu->no_pegawai }}</span>
         </div>

         <div>
           BPP Fakultas Ilmu Komputer,
           <br><br><br><br>
           <span><b>{{ $bpp->nama }}</b></span><br>
           <span>NIP. {{ $bpp->no_pegawai }}</span>
         </div>
      </div>
   </div>
</body>
</html>

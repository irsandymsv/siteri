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

         .span_uang{
            /*margin-left: 20px;*/
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

         .golongan{
            width: 20px;
         }

         .width-narrow {
            width: 5%;
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
               Honorarium Dosen Pembimbing Skripsi Mahasiswa Fak. Ilmu Komputer Universitas Jember T.A {{ $tahun_akademik['tahun_awal'] }}/{{ $tahun_akademik['tahun_akhir'] }} Di Lingkungan Fakultas Ilmu Komputer Universitas Jember
            </td>
         </tr>
         <tr>
            <td valign="top">SESUAI</td>
            <td valign="top">: </td>
            <td valign="top">
               SK Dekan Fak. Ilmu Komputer UNEJ  No. {{ $sk_honor->sk_skripsi->no_surat_pembimbing }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($sk_honor->sk_skripsi->tgl_sk_pembimbing)->year}} Tanggal {{Carbon\Carbon::parse($sk_honor->sk_skripsi->tgl_sk_pembimbing)->locale('id_ID')->isoFormat('D MMMM Y')}}
            </td>
         </tr>
      </table>
      <br>
      <div class="main_table">
         <table class="table table-bordered" style="margin-top:5px">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Tim Pembimbing I/II</th>
                  <th>NPWP</th>
                  <th>Nama Mahasiswa/NIM</th>
                  <th>Gol</th>
                  <th>Honorarium</th>
                  <th>PPH psl 21 5%-15%</th>
                  <th>Penerimaan</th>
                  <th>Tanda Tangan</th>
               </tr>
            </thead>

            <tbody id="tbl_pembimbing">
               @php $no=0; $a = 1; $b = 1; $total_honor=0; $total_pph=0; $total_penerimaan=0; @endphp

               @foreach($detail_skripsi as $item)
                  {{-- dosen1 --}}

                  @php
                     $gol = "";
                     if (is_null($item->sutgas_pembimbing_terbaru->dosen1->golongan)) {
                        $gol = "-";
                     }
                     else{
                        $gol = $item->sutgas_pembimbing_terbaru->dosen1->golongan->golongan;
                        $gol = substr($gol,0,(strlen($gol)-2));
                     }
                  @endphp

                  @if ($no+1 == 4*$a-1)
                     @php $a+=1; @endphp
                     <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                  @else
                     <tr id="{{ $no+=1 }}">
                  @endif
                     <td class="first_td">{{ $no }}</td>
                     
                     @php
                        if (isset($item->sutgas_pembimbing_terbaru->dosen1->honorarium_putj)) {
                           $honorarium = $item->sutgas_pembimbing_terbaru->dosen1->honorarium_putj;
                           $pph = $item->sutgas_pembimbing_terbaru->dosen1->pph_putj;
                        }
                        else{
                           $honorarium = $item->sutgas_pembimbing_terbaru->dosen1->honorarium_pudj;
                           $pph = $item->sutgas_pembimbing_terbaru->dosen1->pph_pudj;
                        }
                        $penerimaan = $honorarium - $pph;
                     @endphp
                     <td class="nama_dosen">{{ $item->sutgas_pembimbing_terbaru->dosen1->nama }}</td>
                     <td class="to_center">{{ $item->sutgas_pembimbing_terbaru->dosen1->npwp }}</td>
                     <td rowspan="2" class="nama_mhs">
                        <p>{{ $item->skripsi->mahasiswa->nama }}</p>
                        <p>NIM: {{ $item->skripsi->nim }}</p>
                     </td>
                     <td class="to_center golongan">{{ $gol }}</td>
                     <td>Rp {{ number_format($honorarium, 0, ",", ".") }}</td>
                     <td class="width-narrow">Rp
                        <span class="span_uang">{{ number_format($pph, 0, ",", ".") }}</span>
                     </td>
                     <td class="width-narrow">Rp
                        <span class="span_uang">{{ number_format($penerimaan, 0, ",", ".") }}</span>
                     </td>
                     <td>{{ $no }}.</td>

                     @php
                        $total_honor+=$honorarium;
                        $total_pph+=$pph;
                        $total_penerimaan+=$penerimaan;
                     @endphp
                  </tr>

                  {{-- dosen2 --}}
                  @php
                     $gol = "";
                     if (is_null($item->sutgas_pembimbing_terbaru->dosen2->golongan)) {
                        $gol = "-";
                     }
                     else{
                        $gol = $item->sutgas_pembimbing_terbaru->dosen2->golongan->golongan;
                        $gol = substr($gol,0,(strlen($gol)-2));
                     }
                  @endphp
                  @if ($no+1 == 4*$b)
                     @php $b+=1; @endphp
                     <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                  @else
                     <tr id="{{ $no+=1 }}">
                  @endif
                     <td class="first_td">{{ $no }}</td>
                     
                     @php
                        if (isset($item->sutgas_pembimbing_terbaru->dosen2->honorarium_pptj)) {
                           $honorarium = $item->sutgas_pembimbing_terbaru->dosen2->honorarium_pptj;
                           $pph = $item->sutgas_pembimbing_terbaru->dosen2->pph_pptj;
                        }
                        else{
                           $honorarium = $item->sutgas_pembimbing_terbaru->dosen2->honorarium_ppdj;
                           $pph = $item->sutgas_pembimbing_terbaru->dosen2->pph_ppdj;
                        }
                        $penerimaan = $honorarium - $pph;
                     @endphp
                     <td class="nama_dosen">{{ $item->sutgas_pembimbing_terbaru->dosen2->nama }}</td>
                     <td class="to_center">{{ $item->sutgas_pembimbing_terbaru->dosen2->npwp }}</td>
                     <td class="to_center golongan">{{ $gol }}</td>
                     <td>Rp {{ number_format($honorarium, 0, ",", ".") }}</td>
                     <td class="width-narrow">Rp
                        <span class="span_uang">{{ number_format($pph, 0, ",", ".") }}</span>
                     </td>
                     <td class="width-narrow">Rp
                        <span class="span_uang">{{ number_format($penerimaan, 0, ",", ".") }}</span>
                     </td>
                     <td>{{ $no }}.</td>

                     @php
                        $total_honor+=$honorarium;
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

   <div class="page-break"></div>

   <div>
      <table cellpadding="0" cellspacing="0">
         <tr>
            <td valign="top">DAFTAR</td>
            <td valign="top">: </td>
            <td valign="top">
               Honorarium Dosen Penguji Skripsi Mahasiswa Fak. Ilmu Komputer Universitas Jember T.A {{ $tahun_akademik['tahun_awal'] }}/{{ $tahun_akademik['tahun_akhir'] }} Di Lingkungan Fakultas Ilmu Komputer Universitas Jember
            </td>
         </tr>
         <tr>
            <td valign="top">SESUAI</td>
            <td valign="top">: </td>
            <td valign="top">
               SK Dekan Fak. Ilmu Komputer UNEJ  No. {{ $sk_honor->sk_skripsi->no_surat_penguji }}/UN 25.1.15/SP/{{Carbon\Carbon::parse($sk_honor->sk_skripsi->tgl_sk_penguji)->year}} Tanggal {{Carbon\Carbon::parse($sk_honor->sk_skripsi->tgl_sk_penguji)->locale('id_ID')->isoFormat('D MMMM Y')}}
            </td>
         </tr>
      </table>
      <br>
      <div class="main_table">
         <table class="table table-bordered" style="margin-top:5px">
            <thead>
               <tr>
                  <th>No</th>
                  <th>Tim Penguji I/II</th>
                  <th>NPWP</th>
                  <th>Nama Mahasiswa/NIM</th>
                  <th>Gol</th>
                  <th>Honorarium</th>
                  <th>PPH psl 21 5%-15%</th>
                  <th>Penerimaan</th>
                  <th>Tanda Tangan</th>
               </tr>
            </thead>

            <tbody id="tbl_penguji">
               @php $no=0; $a = 1; $b = 1; $total_honor=0; $total_pph=0; $total_penerimaan=0; @endphp

               @foreach($detail_skripsi as $item)
                  {{-- dosen1 --}}
                  @php
                     $gol = "";
                     if (is_null($item->sutgas_penguji_terbaru->dosen1->golongan)) {
                        $gol = "-";
                     }
                     else{
                        $gol = $item->sutgas_penguji_terbaru->dosen1->golongan->golongan;
                        $gol = substr($gol,0,(strlen($gol)-2));
                     }
                  @endphp
                  @if ($no+1 == 4*$a-1)
                     @php $a+=1; @endphp
                     <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                  @else
                     <tr id="{{ $no+=1 }}">
                  @endif
                     <td class="first_td">{{ $no }}</td>
                     
                     @php
                        $honorarium = $item->sutgas_penguji_terbaru->dosen1->honorarium_pus;
                        $pph = $item->sutgas_penguji_terbaru->dosen1->pph_pus;
                        $penerimaan = $honorarium - $pph;
                     @endphp
                     <td class="nama_dosen">{{ $item->sutgas_penguji_terbaru->dosen1->nama }}</td>
                     <td class="to_center">{{ $item->sutgas_penguji_terbaru->dosen1->npwp }}</td>
                     <td rowspan="2" class="nama_mhs">
                        <p>{{ $item->skripsi->mahasiswa->nama }}</p>
                        <p>NIM: {{ $item->skripsi->nim }}</p>
                     </td>
                     <td class="to_center golongan">{{ $gol }}</td>
                     <td>Rp {{ number_format($honorarium, 0, ",", ".") }}</td>
                     <td class="width-narrow">Rp
                        <span class="span_uang">{{ number_format($pph, 0, ",", ".") }}</span>
                     </td>
                     <td class="width-narrow">Rp
                        <span class="span_uang">{{ number_format($penerimaan, 0, ",", ".") }}</span>
                     </td>
                     <td>{{ $no }}.</td>

                     @php
                        $total_honor+=$honorarium;
                        $total_pph+=$pph;
                        $total_penerimaan+=$penerimaan;
                     @endphp
                  </tr>

                  {{-- dosen2 --}}
                  @php
                     $gol = "";
                     if (is_null($item->sutgas_penguji_terbaru->dosen2->golongan)) {
                        $gol = "-";
                     }
                     else{
                        $gol = $item->sutgas_penguji_terbaru->dosen2->golongan->golongan;
                        $gol = substr($gol,0,(strlen($gol)-2));
                     }
                  @endphp
                  @if ($no+1 == 4*$b)
                     @php $b+=1; @endphp
                     <tr id="{{ $no+=1 }}" style="background-color: #bbb;">
                  @else
                     <tr id="{{ $no+=1 }}">
                  @endif
                     <td class="first_td">{{ $no }}</td>
                     
                     @php
                        $honorarium = $item->sutgas_penguji_terbaru->dosen2->honorarium_pps;
                        $pph = $item->sutgas_penguji_terbaru->dosen2->pph_pps;
                        $penerimaan = $honorarium - $pph;
                     @endphp
                     <td class="nama_dosen">{{ $item->sutgas_penguji_terbaru->dosen2->nama }}</td>
                     <td class="to_center">{{ $item->sutgas_penguji_terbaru->dosen2->npwp }}</td>
                     <td class="to_center golongan">{{ $gol }}</td>
                     <td>Rp {{ number_format($honorarium, 0, ",", ".") }}</td>
                     <td class="width-narrow">Rp
                        <span class="span_uang">{{ number_format($pph, 0, ",", ".") }}</span>
                     </td>
                     <td class="width-narrow">Rp
                        <span class="span_uang">{{ number_format($penerimaan, 0, ",", ".") }}</span>
                     </td>
                     <td>{{ $no }}.</td>

                     @php
                        $total_honor+=$honorarium;
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

<!DOCTYPE html>
<html>
<head>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        html{
            font-size: 9pt;
        }

        .page-break {
            page-break-after: always;
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

        .table-bordered td{
            padding: 3px;
        }

        .table-bordered tbody tr td:first-child{
            text-align: center;
        }
        
        thead th{
            text-align: center;
        }

        .jml_total td{
           font-weight: bold;
           background-color: white;
        }

        td span {
           margin-left: 5px;
        }
        
    </style>
</head>

<body>
    <div>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td valign="top">
                    DAFTAR 
                </td>
                <td valign="top">
                    : Honorarium Dosen Pembimbing Skripsi Mahasiswa Fak.Ilmu Komputer Universitas<br>&nbsp;
                    Jember T.A {{$tahun}}/{{$tahun2}} Di Lingkungan Fakultas Ilmu Komputer Universitas Jember
                </td>
            </tr>
            <tr>
                <td valign="top">
                    SESUAI
                </td>
                <td valign="top">
                : SK Dekan Fak. Ilmu Komputer UNEJ {{$sk_honor->detail_sk[0]->sk_akademik->no_surat}}/UN 25.1.15/SP/{{$thn_asli}}<br>&nbsp;
                    Tanggal ...............
                </td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered" style="margin-top:5px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pembimbing I/II</th>
                    <th>NPWP</th>
                    <th>Nama Mahasiswa/NIM</th>
                    <th>Gol</th>
                    <th>Honorarium</th>
                    <th>PPH psl 5%-15%</th>
                    <th>Penerimaan</th>
                    <th>Tanda Tangan</th>
                </tr>
            </thead>
            <tbody id="tbl_pembimbing">
                @php 
                    $no = 0; $a = 1;$b = 1; $total_honor=0; $total_pph=0; $total_penerimaan=0; 
                @endphp  

                @foreach($sk_honor->detail_sk as $item)
                @if ($no+1 == 4*$a-1)
                @php $a+=1; @endphp 
                <tr id="{{$no+=1}}" style="background-color: #bbb;">
                @else
                <tr id="{{$no+=1}}">   
                @endif
                    <td>{{$no}}</td>
                    <td>{{$item->pembimbing_utama->nama}}</td>
                    <td class="font-sm">{{$item->pembimbing_utama->npwp}}</td>
                    <td rowspan="2">
                        <p>{{$item->nama_mhs}}</p>
                        <p>NIM: {{$item->nim}}</p>
                    </td>
                    <td>{{$item->pembimbing_utama->golongan->golongan}}</td>
                    <td id="pembimbing_{{$no}}" class="pembimbingHonor">Rp <span>{{ number_format($sk_honor->honor_pembimbing1, 0, ",", ".") }}</span>
                    </td>
                    <td class="pph" id="pph_{{$no}}">Rp 
                        <span>
                            @php
                            $pph = ($item->pembimbing_utama->golongan->pph * $sk_honor->honor_pembimbing1)/100;
                            @endphp
                            {{ number_format($pph, 0, ",", ".") }}
                        </span>
                    </td>
                    <td class="penerimaan" id="penerimaan_{{$no}}">Rp
                        @php
                            $penerimaan = $sk_honor->honor_pembimbing1 - $pph;
                        @endphp
                        <span>{{ number_format($penerimaan, 0, ",", ".") }}</span>
                    </td>
                    <td>
                        {{$no}}.
                    </td>

                    @php
                       $total_honor+=$sk_honor->honor_pembimbing1;
                       $total_pph+=$pph;
                       $total_penerimaan+=$penerimaan;
                    @endphp
                </tr>
                
                @if ($no+1 == 4*$b)
                @php $b+=1; @endphp 
                <tr id="{{$no+=1}}" style="background-color: #bbb;">
                @else
                <tr id="{{$no+=1}}">   
                @endif
                    <td>{{$no}}</td>
                    <td>{{$item->pembimbing_pendamping->nama}}</td>
                    <td class="font-sm">{{$item->pembimbing_pendamping->npwp}}</td>
                    <td>{{$item->pembimbing_pendamping->golongan->golongan}}</td>
                    <td id="pembimbing_{{$no}}" class="pembimbingHonor">Rp <span>{{ number_format($sk_honor->honor_pembimbing2, 0, ",", ".") }}</span></td>
                    <td class="pph" id="pph_{{$no}}">Rp
                        <span>
                            @php
                            $pph =( $item->pembimbing_pendamping->golongan->pph * $sk_honor->honor_pembimbing2)/100;
                            @endphp
                            {{ number_format($pph, 0, ",", ".") }}
                        </span>
                    </td>
                    <td class="penerimaan" id="penerimaan_{{$no}}">Rp 
                        @php
                            $penerimaan = $sk_honor->honor_pembimbing2 - $pph;
                        @endphp
                        <span>{{ number_format($penerimaan, 0, ",", ".") }}</span>
                    </td>
                    <td>
                        {{$no}}.
                    </td>

                    @php
                       $total_honor+=$sk_honor->honor_pembimbing2;
                       $total_pph+=$pph;
                       $total_penerimaan+=$penerimaan;
                    @endphp
                </tr>
                @endforeach

                <tr class="jml_total">
                   <td colspan="5" style="text-align: center;">Jumlah</td>
                   <td>Rp <span>{{ number_format($total_honor, 0, ",", ".") }}</span></td>
                   <td>Rp <span>{{ number_format($total_pph, 0, ",", ".") }}</span></td>
                   <td>Rp <span>{{ number_format($total_penerimaan, 0, ",", ".") }}</span></td>
                   <td></td>
                </tr>
            </tbody>
        </table>

        <div class="page-break"></div>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td valign="top">
                    DAFTAR 
                </td>
                <td valign="top">
                    : Honorarium Dosen 
                    @if ($sk_honor->tipe_sk->tipe == "SK Skripsi")
                        Penguji Skripsi 
                    @else
                        Pembahas Seminar Proposal
                    @endif
                    Mahasiswa Fak.Ilmu Komputer Universitas<br>&nbsp;
                    Jember T.A {{$tahun}}/{{$tahun2}} Di Lingkungan Fakultas Ilmu Komputer Universitas Jember
                </td>
            </tr>
            <tr>
                <td valign="top">
                    SESUAI
                </td>
                <td valign="top">
                    : SK Dekan Fak. Ilmu Komputer UNEJ {{$sk_honor->detail_sk[0]->sk_akademik->no_surat}}/UN 25.1.15/SP/{{$thn_asli}}<br>&nbsp;
                    Tanggal ...............
                </td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered" style="margin-top:5px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>
                        @if ($sk_honor->tipe_sk->tipe == "SK Skripsi")
                            Penguji 
                        @else
                            Pembahas 
                        @endif
                        I/II
                    </th>
                    <th>NPWP</th>
                    <th>Nama Mahasiswa/NIM</th>
                    <th>Gol</th>
                    <th>Honorarium</th>
                    <th>PPH psl 5%-15%</th>
                    <th>Penerimaan</th>
                    <th>Tanda Tangan</th>
                </tr>
            </thead>
            <tbody id="tbl_penguji">
                @php 
                    $no = 0; $a = 1;$b = 1; $total_honor=0; $total_pph=0; $total_penerimaan=0;
                @endphp  
                @foreach($sk_honor->detail_sk as $item)
                @if ($no+1 == 4*$a-1)
                @php $a+=1; @endphp 
                <tr id="{{$no+=1}}" style="background-color: #bbb;">
                @else
                <tr id="{{$no+=1}}">   
                @endif
                    <td>{{$no}}</td>
                    <td>{{$item->penguji_utama->nama}}</td>
                    <td class="font-sm">{{$item->penguji_utama->npwp}}</td>
                    <td rowspan="2">
                        <p>{{$item->nama_mhs}}</p>
                        <p>NIM: {{$item->nim}}</p>
                    </td>
                    <td>{{$item->penguji_utama->golongan->golongan}}</td>
                    <td id="penguji_{{$no}}" class="pengujiHonor">Rp
                        <span>{{ number_format($sk_honor->honor_penguji, 0, ",", ".") }}</span>
                    </td>
                    <td class="pph" id="pph_{{$no}}">Rp 
                        <span>
                            @php
                            $pph = ($item->penguji_utama->golongan->pph * $sk_honor->honor_penguji)/100;
                            @endphp
                            {{ number_format($pph, 0, ",", ".") }}
                        </span>
                    </td>
                    <td class="penerimaan" id="penerimaan_{{$no}}">Rp
                        @php
                            $penerimaan = $sk_honor->honor_penguji - $pph;
                        @endphp
                        <span>{{ number_format($penerimaan, 0, ",", ".") }}</span>
                    </td>
                    <td>
                        {{$no}}.
                    </td>

                    @php
                       $total_honor+=$sk_honor->honor_penguji;
                       $total_pph+=$pph;
                       $total_penerimaan+=$penerimaan;
                    @endphp
                </tr>
                
                @if ($no+1 == 4*$b)
                @php $b+=1; @endphp 
                <tr id="{{$no+=1}}" style="background-color: #bbb;">
                @else
                <tr id="{{$no+=1}}">   
                @endif
                    <td>{{$no}}</td>
                    <td>{{$item->penguji_pendamping->nama}}</td>
                    <td class="font-sm">{{$item->penguji_pendamping->npwp}}</td>
                    <td>{{$item->penguji_pendamping->golongan->golongan}}</td>
                    <td id="penguji_{{$no}}" class="pengujiHonor">Rp <span>{{ number_format($sk_honor->honor_penguji, 0, ",", ".") }}</span></td>
                    <td class="pph" id="pph_{{$no}}">Rp
                        <span>
                            @php
                            $pph =( $item->penguji_pendamping->golongan->pph * $sk_honor->honor_penguji)/100;
                            @endphp
                            {{ number_format($pph, 0, ",", ".") }}
                        </span>
                    </td>
                    <td class="penerimaan" id="penerimaan_{{$no}}">Rp 
                        @php
                            $penerimaan = $sk_honor->honor_penguji - $pph;
                        @endphp
                        <span>{{ number_format($penerimaan, 0, ",", ".") }}</span>
                    </td>
                    <td>
                        {{$no}}.
                    </td>

                    @php
                       $total_honor+=$sk_honor->honor_penguji;
                       $total_pph+=$pph;
                       $total_penerimaan+=$penerimaan;
                    @endphp
                </tr>
                @endforeach

                <tr class="jml_total">
                   <td colspan="5" style="text-align: center;">Jumlah</td>
                   <td>Rp <span>{{ number_format($total_honor, 0, ",", ".") }}</span></td>
                   <td>Rp <span>{{ number_format($total_pph, 0, ",", ".") }}</span></td>
                   <td>Rp <span>{{ number_format($total_penerimaan, 0, ",", ".") }}</span></td>
                   <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        
    </body>
    </html>
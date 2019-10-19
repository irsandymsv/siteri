<!DOCTYPE html>
<html>
<head>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">
        html{
            font-size: 9pt;
        }

        .font-sm{
            font-size: 60%;
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
                    Jember T.A ......... Di Lingkungan Fakultas Ilmu Komputer Universitas Jember
                </td>
            </tr>
            <tr>
                <td valign="top">
                    SESUAI
                </td>
                <td valign="top">
                    : SK Dekan Fak. Ilmu Komputer UNEJ ..............................<br>&nbsp;
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
                @php $no = 0; $a = 1;$b = 1; @endphp  
                @foreach($sk_honor->detail_sk as $item)
                @if ($no+1 == 4*$a-1)
                @php $a+=1; @endphp 
                <tr id="{{$no+=1}}"  style="background-color: #bbb;">
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
                    <td id="pembimbing_{{$no}}" class="pembimbingHonor">Rp &nbsp;
                        <span>{{ $sk_honor->honor_pembimbing }}</span>
                    </td>
                    <td class="pph" id="pph_{{$no}}">Rp &nbsp; 
                        <span>
                            @php
                            $pph = ($item->pembimbing_utama->golongan->pph * $sk_honor->honor_pembimbing)/100;
                            @endphp
                            {{ $pph }}
                        </span>
                    </td>
                    <td class="penerimaan" id="penerimaan_{{$no}}">Rp &nbsp;
                        <span>{{ $sk_honor->honor_pembimbing - $pph }}</span>
                    </td>
                    <td>
                        {{$no}}.
                    </td>
                </tr>
                
                @if ($no+1 == 4*$b)
                @php $b+=1; @endphp 
                <tr id="{{$no+=1}}"  style="background-color: #bbb;">
                @else
                <tr id="{{$no+=1}}">   
                @endif
                    <td>{{$no}}</td>
                    <td>{{$item->pembimbing_pendamping->nama}}</td>
                    <td>{{$item->pembimbing_pendamping->npwp}}</td>
                    <td>{{$item->pembimbing_pendamping->golongan->golongan}}</td>
                    <td id="pembimbing_{{$no}}" class="pembimbingHonor">Rp &nbsp; <span>{{ $sk_honor->honor_pembimbing }}</span></td>
                    <td class="pph" id="pph_{{$no}}">Rp &nbsp;
                        <span>
                            @php
                            $pph =( $item->pembimbing_pendamping->golongan->pph * $sk_honor->honor_pembimbing)/100;
                            @endphp
                            {{ $pph }}
                        </span>
                    </td>
                    <td class="penerimaan" id="penerimaan_{{$no}}">Rp &nbsp; 
                        <span>{{ $sk_honor->honor_pembimbing - $pph }}</span>
                    </td>
                    <td>
                        {{$no}}.
                    </td>
                </tr>
                @endforeach
                <tr>   
                    <td>n</td>
                    <td>Dosen ke-n</td>
                    <td>123456789012345</td>
                    <td>4b</td>
                    <td>Rp &nbsp; <span>100000</span></td>
                    <td>Rp &nbsp; <span>1000</span></td>
                    <td>Rp &nbsp; <span>199000</span></td>
                    <td>
                        N.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        
    </body>
    </html>
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

        .table-bordered tbody tr td:first-child{
            text-align: center;
        }
        
        thead th{
            text-align: center;
        }
    </style>
</head>

<body>
    <div>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td valign="top">
                    Nomor 
                </td>
                <td valign="top">
                    : .........
                </td>
            </tr>
            <tr>
                <td valign="top">
                    Tanggal
                </td>
                <td valign="top">
                    : .........
                </td>
            </tr>
            <tr>
                <td valign="top">
                    Tentang
                </td>
                <td valign="top">
                    : Penetapan Dosen Pembimbing Skripsi Mahasiswa Fakultas Ilmu Komputer Universitas Jember Tahun Akademik ...../.....
                </td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered" style="margin-top:5px">
            <thead>
			    <tr>
                    <th>No</th>
			        <th>Nama Mahasiswa</th>
			        <th>NIM</th>
			        <th>Jurusan</th>
			        <th>Judul</th>
			        <th>Pembimbing I/II</th>
			    </tr>
			</thead>
		    <tbody>
                @php $no = 0; @endphp
		        @foreach($detail_sk as $item)
	            <tr>
                    <td>{{ $no+=1 }}</td>
	            	<td>{{$item->nama_mhs}}</td>
	            	<td>{{$item->nim}}</td>
	            	<td>{{$item->bagian->bagian}}</td>
	            	<td>{{$item->judul}}</td>
	            	<td >
	            		<div class="tbl_row">
            				1. {{$item->pembimbing_utama->nama}}
            			</div>
            			<div class="tbl_row">
            				2. {{$item->pembimbing_pendamping->nama}}
            			</div>	
	            	</td>
	            </tr>
                @endforeach
            </tbody>
        </table>

        <div class="page-break"></div>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td valign="top">
                    Nomor 
                </td>
                <td valign="top">
                    : .........
                </td>
            </tr>
            <tr>
                <td valign="top">
                    Tanggal
                </td>
                <td valign="top">
                    : .........
                </td>
            </tr>
            <tr>
                <td valign="top">
                    Tentang
                </td>
                <td valign="top">
                    : Penetapan Dosen  
                    @if($sk_akademik->tipe_sk->tipe == "SK Skripsi")
			            	Penguji Skripsi
			            @else
			            	Pembahas Seminar Proposal
			            @endif
                     Mahasiswa Fakultas Ilmu Komputer Universitas Jember Tahun Akademik ...../.....
                </td>
            </tr>
        </table>
        <br>
        <table class="table table-bordered" style="margin-top:5px">
            <thead>
			    <tr>
                    <th>No</th>
			        <th>Nama Mahasiswa</th>
			        <th>NIM</th>
			        <th>Jurusan</th>
			        <th>Judul</th>
			        <th>
			            @if($sk_akademik->tipe_sk->tipe == "SK Skripsi")
			            	Penguji I/II
			            @else
			            	Pembahas I/II
			            @endif
			        </th>
			    </tr>
			</thead>
		    <tbody>
                @php $no = 0; @endphp
		        @foreach($detail_sk as $item)
	            <tr>
                    <td>{{ $no+=1 }}</td>
	            	<td>{{$item->nama_mhs}}</td>
	            	<td>{{$item->nim}}</td>
	            	<td>{{$item->bagian->bagian}}</td>
	            	<td>{{$item->judul}}</td>
	                <td>
	            		<div class="tbl_row">
	            			1. {{$item->penguji_utama->nama}}	
	            		</div>
	            		<div class="tbl_row">
	            			2. {{$item->penguji_pendamping->nama}}	
	            		</div>
	            	</td>
	            </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        
    </body>
    </html>





@php
	// $count = $data->count();
	// $smax = $data->max('suhu');
	// $smin = $data->min('suhu');
	// $savg = $data->avg('suhu');

	// $kmax = $data->max('kelembapan');
	// $kmin = $data->min('kelembapan');
	// $kavg = $data->avg('kelembapan');

	// $gmax = $data->max('gas');
	// $gmin = $data->min('gas');
	// $gavg = $data->avg('gas');
    // $set = App\Models\PengaturanLaporan::find(1)->first();
    // $judul = App\Models\JudulLaporan::where('id','4')->first();
	$date = date("d M Y");
@endphp

<!DOCTYPE html>
<html>
<head>
	<title>Laporan Penawaran</title>
	<style>
		#customers {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
		}

		#customers td, #customers th {
		border: 1px solid #ddd;
		padding: 8px;
		}

		#customers tr:nth-child(even){background-color: #ddd;}

		#customers tr:hover {background-color: #ddd;}

		#customers thead {
		padding-top: 7px;
		padding-bottom: 7px;
		text-align: left;
		background-color: #8a8a8a;
		color: white;
		}

		*{
			font-family:sans-serif;
		}
		table {
			width: 100%;
			padding: 5px;
		}
		table, th, tr, td {
			border: 1px black;
            text-align: center;
        }
		#header,
		#footer {
		  position: fixed;
		  left: 0;
			right: 0;
			color: #aaa;
			font-size: 0.7em;
		}
		#header {
		  top: 0;
			border-bottom: 0.1pt solid #aaa;
		}
		#footer {
		  bottom: 0;
		  border-top: 0.1pt solid #aaa;
		}
		.page-number:before {
		  content: "Page " counter(page);
		}
	</style>
</head>
<body>
	{{-- <img src="{{ $set->icon }}" style="float: left;" width="50px" height="50px"> --}}
	<h3 style=" margin-top: 30px; margin-right:20px;">
		{{-- {{ $set->header }} --}}
	</h3>

	<div class="container">
	<style type="text/css">
		table tr td{
            text-align: center;
            font-size: 15px;
		}
		table tr th{
            text-align: center;
            font-size: 15px;
		}
		table {
		  border-collapse: collapse;
		  width: 100%;
		}

		th, td {
		  text-align: left;
		  padding: 8px;
        }
        img {
            height: 60px;
            width: auto;
        }
        .left {
            height: auto;
            width: 50px;
        }
        .text {
            padding: 1px !important;
            margin-left: 40px;
            text-align: center ;
            margin-top: 20px;
            height: auto;
        }
        table, td{
            background-color: #ffffff;
            /* padding: 2px; */
        }
        table td .text{
            background-color: #ffffff;
            padding: 2px;
        }

		tr:nth-child(even) {background-color: #f2f2f2;}
	</style>
        <table style="background-color: #ffffff;border:1px black solid;padding:10px;">
            {{-- <tr>
                <td style="height: auto;"></td>
            </tr> --}}
            <tr>
                {{-- <td rowspan="3" class="left"><img src="{{ $set->logo }}" alt=""></td> --}}
                {{-- <td class="text" style="font-size: 17px;">{{ $set->nama_perusahaan }}</td>
            </tr>
            <tr>
                <td class="text" style="font-size: 10px;">{{ $set->alamat }}</td>
            </tr>
            <tr>
                <td class="text" style="font-size: 10px;">{{ $set->tahun }}</td> --}}
            </tr>
            {{-- <tr>
                <td style="height: auto;"></td>
            </tr> --}}
        </table>
        <center>
            {{-- <h3>{{ $judul->judul }}</h3> --}}
        </center>
	<table style="margin-bottom:-10px;">
		<tr>
			<td rowspan="2" style="text-align:left; font-size:13px;">
				Sumber Data : {{ $sumber }}
			</td>
			<td rowspan="2" style="text-align:right; font-size:13px;">
				Waktu : {{$awal}} s.d. {{$akhir}}
			</td>
		</tr>
	</table>
    <table width="100%" style="margin-bottom: -10px; " id="customers">
		<thead>
			<tr>
                <th>No</th>
                <th>Kode Penawaran</th>
                <th>Kode Kebutuhan</th>
                <th>Jenis Mangga</th>
                <th>Role</th>
                <th>Status Pembayaran</th>
                <th>Status Penerimaan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($data as $p)
			<tr>
				<td>{{ $i++ }}</td>
                <td>{{$p->kode_penawaran}}</td>
                <td>{{$p->kebutuhan->kode_kebutuhan}}</td>
                <td>{{$p->mangga->jenis->nama}}</td>
                <td>
                    @if ($p->id_kelompok != null)
                    {{$p->kelompok->nama}}
                    @elseif ($p->id_retailer != null)
                    {{$p->retailer->nama}}
                    @endif
                </td>
                <td>
                    @if ($p->status_pembayaran == 0)
                        {{"Belum Di Bayar"}}
                    @elseif ($p->status_pembayaran == 1)
                        {{"Sudah Di Bayar"}}
                    @endif
                </td>
                <td>
                    @if ($p->status_penerimaan == 0)
                        {{"Belum diterima "}}
                    @elseif ($p->status_penerimaan == 1)
                        {{"Sudah diterima "}}
                    @endif
                </td>
			</tr>
			@endforeach
		</tbody>
	</table>
{{--
	<table style="text-align: left !important; margin-bottom: 50px;" id="customers">
		<tr>
			<td>Jumlah Data</td>
			<td style="text-align: right !important;">{{$count}}</td>
		</tr>
		<tr>
			<td>Suhu Tertinggi</td>
			<td style="text-align: right !important;">{{$smax}}</td>
		</tr>
		<tr>
			<td>Suhu Terendah</td>
			<td style="text-align: right !important;">{{$smin}}</td>
		</tr>
		<tr>
			<td>Suhu Rata Rata</td>
			<td style="text-align: right !important;">{{$savg}}</td>
		</tr>
		<tr>
			<td>Kelembapan Tertinggi</td>
			<td style="text-align: right !important;">{{$kmax}}</td>
		</tr>
		<tr>
			<td>Kelembapan Terendah</td>
			<td style="text-align: right !important;">{{$kmin}}</td>
		</tr>
		<tr>
			<td>Kelembapan Rata Rata</td>
			<td style="text-align: right !important;">{{$kavg}}</td>
		</tr>
		<tr>
			<td>Gas Tertinggi</td>
			<td style="text-align: right !important;">{{$gmax}}</td>
		</tr>
		<tr>
			<td>Gas Terendah</td>
			<td style="text-align: right !important;">{{$gmin}}</td>
		</tr>
		<tr>
			<td>Gas Rata Rata</td>
			<td style="text-align: right !important;">{{$gavg}}</td>
		</tr>
	</table> --}}

	<div style="float: right; margin-top:30px;">
		{{-- {{$set->kota}},  {{$date}}<br><br><br><br>
		{{Auth::user()->name}} --}}
	</div>
	<div id="footer">
	  <div class="page-number"></div>
	</div>

<script>

	const rero = ()=>{
        const alrm = document.querySelectorAll("#alertff");
    	const on = "ON";
    	const off = "OFF";
        alrm.forEach(r =>{
            if(r.innerHTML == 1){
                r.innerHTML = on;
            }else{
                r.innerHTML = off;
            }
        })
    }
    console.log('hai');
    rero();
</script>
</body>
</html>

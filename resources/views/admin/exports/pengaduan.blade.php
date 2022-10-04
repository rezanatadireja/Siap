<!DOCTYPE html>
<html>
<head>
	<title>contoh surat pengunguman</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	{{-- <style type="text/css">
		table {
			border-style: double;
			border-width: 3px;
			border-color: white;
		}
		table tr .text2 {
			text-align: right;
			font-size: 13px;
		}
		table tr .text {
			text-align: center;
			font-size: 13px;
		}
		table tr td {
            text-align: center;
			font-size: 13px;
		}

	</style> --}}
</head>
<body>
        {{-- {{$drawing}} --}}
        <table style="text-align-center">
            <tr style="text-align-center">
                <td colspan="6">
                    <h3>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h3>
                </td>
            </tr>
            <tr style="text-align-center">
                <td colspan="6">
                    <h3><b>KABUPATEN MAJALENGKA</b></h3>
                </td>
            </tr>
            <tr style="text-align-center">
                <td colspan="6">
                    <h4>Bidang Keahlian : Bisnis dan Menejemen - Teknologi informasi dan Komunikasi</h4><br>
                </td>
            </tr>
            <tr style="text-align-center">
                <td colspan="6">
                    <h5><i>Jl. K.H. Abdul Halim No. 483 Majalengka, Jawa Barat 45418</i></h5>
                </td>
            </tr>
            <tr>
                <td colspan="6"><hr></td>
            </tr>
        </table>

        <table>
            <thead>
            <tr style="text-align-center">
                <th><b>Tanggal Pelayanan</b></th>
                <th><b>NIK</b></th>
                <th><b>Name</b></th>
                <th><b>Bidang Pengaduan</b></th>
                <th><b>Jenis Pelayanan Pengaduan</b></th>
                <th><b>Status</b></th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->created_at->diffForHumans()}}</td>
                    <td>{{ $item->user->penduduk->nik }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->jenisPengaduan->subBidang->nama }}</td>
                    <td>{{ $item->jenisPengaduan->nama }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</body>


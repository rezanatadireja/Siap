<!DOCTYPE html>
<html>
<head>
	<title>Laporan Pelayanan Pengaduan</title>
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
			font-size: 12px;
		}

        .pengaduan {
            border-style: solid; 
        }

	</style> --}}
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
</head>
<body>
    <center>
        <table>
            <tr>
                <td><img src="/public/storage/mjl.jpg" width="90" height="90"></td>
                <td>
                <center>
                    <font size="4">LEMBAGA PERATIKUM 2019</font><br>
                    <font size="5"><b>SMK BAITUL HIKAH</b></font><br>
                    <font size="2">Bidang Keahlian : Bisnis dan Menejemen - Teknologi informasi dan Komunikasi</font><br>
                    <font size="2"><i>Jln Cut Nya'Dien No. 02 Kode Pos : 68173 Telp./Fax (0331)758005 Tempurejo Jember Jawa Timur</i></font>
                </center>
                </td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
        </table>

        <table class="table table-bordered">
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
                    <td>{{ $item->created_at->format('d-m-Y')}}</td>
                    <td>{{ $item->user->penduduk->nik }}</td>
                    <td>{{ucwords( $item->user->name )}}</td>
                    <td>{{ $item->jenisPengaduan->subBidang->nama }}</td>
                    <td>{{ $item->jenisPengaduan->nama }}</td>
                    <td>{{ucwords($item->status) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </center>
</body>


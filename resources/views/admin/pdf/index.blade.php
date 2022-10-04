<!DOCTYPE html>
<html>
<head>
	<title>contoh surat pengunguman</title>
	<style type="text/css">
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
			font-size: 13px;
		}

	</style>
</head>
<body>
    <center>
        <table>
            <tr>
                {{-- <td><img src="{{asset('/public/storage/mjl.jpg')}}" width="90" height="90"></td> --}}
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
            <table width="625">
                <tr>
                    <td class="text2">Jember, 16 mei 2019</td>
                </tr>
            </table>
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
                    <td>{{ $item->created_at}}</td>
                    <td>{{ $item->user->penduduk->nik }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->jenisPengaduan->subBidang->nama }}</td>
                    <td>{{ $item->jenisPengaduan->nama }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </center>
</body>


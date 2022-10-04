<div class="table-responsive">
    <table id="data-pengaduan" class="table table-stripped no-footer" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pelayanan</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Bidang Pengaduan</th>
                <th>Jenis Pelayanan Pengaduan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <td>{{$item->status}}</td>
            </tr>
            @empty
                <code>Tidak Ada Data, Silahkan Upload File Persyaratan disamping!</code>
            @endforeach
        </tbody>
    </table>
</div>
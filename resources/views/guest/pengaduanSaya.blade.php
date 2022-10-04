<div class="table-responsive">
    <table class="table table-striped mb-0">
        <thead>
            <tr class="text-center py-0 align-middle">
                <th>No</th>
                <th>Tanggal Pengaduan</th>
                <th>Nama Pengaduan</th>
                <th class="text-center py-0 align-middle">Status</th>
                <th class="text-center py-0 align-middle">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pengaduan as $item)
            <tr class="text-center py-0 align-middle">
                <td>{{$loop->iteration}}.</td>
                <td>
                    {{$item->created_at->format('d-m-Y')}}
                </td>
                <td>
                    {{ucwords($item->jenisPengaduan->nama)}}
                </td>
                <td class="text-center py-0 align-middle">
                    @if ($item->status == 'baru')
                    <div class="badge badge-warning"><i class="fas fa-exclamation-triangle"></i> Belum Validasi</div>
                    @else
                    <div class="badge badge-success"><i class="fas fa-check-circle"></i> Sudah Validasi</div>
                    @endif
                </td>
                <td class="text-center py-0 align-middle">
                    <a data-id="{{$item->id}}" href="{{ url('dashboard/pengaduan/show/'. $item->id)}}" class="btn btn-icon btn-sm btn-primary"><i class="far fa-edit"></i></a>
                    <button data-id="{{$item->id}}" class="btn btn-icon btn-sm btn-danger deleteBtn"><i class="fas fa-trash"></i></b>
                </td>
                </tr>
                @empty
                <tr>
                    <td>
                        <i><strong>Tidak Ada Data,</strong> Silahkan Upload File Persyaratan disamping!</i>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
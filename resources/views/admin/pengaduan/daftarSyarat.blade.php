<div class="table-responsive">
    <table class="table table-striped mb-0" id="dataSyarat">
        <thead>
            <tr >
                {{-- <th>No</th> --}}
                <th>Persyaratan</th>
                {{-- <th>Berkas</th> --}}
                <th class="text-center py-0 ">Status</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center py-0 align-middle">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($syarat as $item)
            <tr>
                <td>
                    {{ucwords($item->jenisSyarat->nama)}}
                </td>
                <td>
                    @switch($item->status)
                        @case($item->status == 'diterima')
                            <div class="badge badge-success"><i class="fas fa-check"></i> {{ ucwords($item->status) }}</div>
                            @break
                        @case($item->status == 'diperbaiki')
                            <div class="badge badge-danger"><i class="fas fa-exclamation-triangle"></i> {{ ucwords($item->status) }}</div>
                            @break
                        @case($item->status == 'baru')
                            <div class="badge badge-warning"><i class="fab fa-font-awesome-flag"></i> {{ ucwords($item->status) }}</div>
                            @break
                        @default
                    @endswitch
                </td>
                <td>
                    <i>{{$item->keterangan ?? 'Syarat belum dikonfirmasi'}}</i>
                </td>
                <td class="text-center align-middle">
                    <button data-id="{{$item->id}}" id="editBtn" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i></button>
                </td>
                </tr>
                @empty
                <tr>
                    <td>Tidak Ada Data!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/adminSyarat.js') }}"></script>
@endsection

<div class="table-responsive">
    <table class="table table-striped mb-0" style="width:100%" id="dataSyarat">
        <thead>
            <tr >
                {{-- <th>No</th> --}}
                <th>Nama Persyaratan</th>
                <th>Status</th>
                <th>Ketarangan</th>
                {{-- <th>{{ $cek }}</th> --}}
                <th>Aksi</th>
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
                    {{($item->keterangan ?? 'Syarat Belum Validasi')}}
                </td>
                <td>
                    @if($item->status == 'diterima')
                        <b style="color:coral;"><i>Persyaratan Tervalidasi.</i></b>
                    @else
                        <button data-id="{{$item->id}}" id="showBtn" class="btn btn-icon btn-sm btn-success"><i class="far fa-eye"></i></button>
                        <button data-id="{{$item->id}}" id="editbtn" class="btn btn-icon btn-sm btn-primary"><i class="far fa-edit"></i></button>
                        {{-- <button data-id="{{$item->id}}" class="btn btn-icon btn-sm btn-danger deleteBtn"><i class="fas fa-trash"></i></button> --}}
                    @endif
                </td>
                <span id="valueSyarat" hidden></span>
                </tr>
                @empty
                <tr>
                    <td>
                        <i><strong>Tidak Ada Data,</strong> Silahkan Upload File Persyaratan!</i>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- <p>{{ $cek }}</p>  --}}
    {{-- <ul>
        @foreach ($cek as $item)
        <li>{{ $item->jenisSyarat->nama }}</li>
        @endforeach
    </ul> --}}
    
@section('custom_script_footer')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="{{ asset('js/pengaturan/myPengaduan.js')}}"></script>
    <script src="{{ asset('js/summernote.js')}}"></script>
    <script>
        Fancybox.bind('[data-fancybox="gallery"]', {
            caption: function (fancybox, carousel, slide) {
                return (
                slide.caption
                );
            },
            });
    </script>
@endsection
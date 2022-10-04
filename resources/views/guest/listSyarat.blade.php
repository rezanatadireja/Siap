<div class="table-responsive">
    <table class="table table-striped mb-0" style="width:100%" id="dataSyarat">
        <thead>
            <tr >
                {{-- <th>No</th> --}}
                <th>Nama Persyaratan</th>
                {{-- <th>Berkas</th> --}}
                {{-- <th class="text-center py-0 align-middle">Status</th> --}}
                {{-- <th>{{ $cek }}</th> --}}
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
                    @if($item->status == 'diterima')
                        <b style="color:coral;"><i>Persyaratan Tervalidasi.</i></b>
                    @else
                        <button data-id="{{$item->id}}" id="showBtn" class="btn btn-icon btn-sm btn-success"><i class="far fa-eye"></i></button>
                        <button data-id="{{$item->id}}" id="editbtn" class="btn btn-icon btn-sm btn-primary"><i class="far fa-edit"></i></button>
                        <button data-id="{{$item->id}}" class="btn btn-icon btn-sm btn-danger deleteBtn"><i class="fas fa-trash"></i></button>
                    @endif
                </td>
                <span id="valueSyarat" hidden></span>
                </tr>
                @empty
                <tr>
                    <td>
                        <i><strong>Tidak Ada Data,</strong> Silahkan Upload File Persyaratan!</i>
                    </td>
                    <td>
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
    

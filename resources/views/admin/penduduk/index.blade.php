@extends('layouts.masterAdmin')

@section('title_name')
    Penduduk
@endsection

@section('custom_style')
    <link href="{{asset('admin\stisla\plugins\datatables\css\datatabels.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin\stisla\plugins\datatables\css\dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css\sweetalert2.min.css')}}" rel="stylesheet" /> 
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Penduduk</h1>
    </div>
    <div class="section-body">
        <div class="card">
    <div class="card-header">
        <h4>Daftar Penduduk</h4>
            <div class="card-header-action">
                <button data-target="#addPenduduk" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i>Tambah Penduduk</button>
            </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="list-penduduk" class="table table-striped" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>No KK</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach ($penduduks as $data)                        
                    <tr>
                        <td>{{ ucwords($data->nama) }}</td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->no_kk }}</td>
                        <td>{{ $data->user->email }}</td>
                        <td>{{ $data->no_hp }}</td>
                        <td>
                        <a class="btn btn-primary btn-action mr-1 btn-edit" href="#" data-id="{{ $data->id }}" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action swal-confirm" data-id="{{ $data->id }}"><i class="fas fa-trash"></i>
                            <form action="{{ route('penduduk.destroy', $data->id) }}" method="POST" id="delete{{ $data->id }}">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                        </td>
                    </tr>          
                    @endforeach  --}}
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</section>
@include('admin.penduduk.form-tambah')
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="editPenduduk">
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content"">
            <div class="modal-header">	
                <h5 class="modal-title">Edit Penduduk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <ul id="update-error"></ul>
                @include('admin.penduduk.form')
            </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-primary btn-update">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="{{asset('admin\stisla\plugins\datatables\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin\stisla\plugins\datatables\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js\sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('js/pengaturan/penduduk.js') }}"></script>
@endsection
    
@section('custom_script_footer')
    <script>
        $(document).ready(function(){
            $('#list-penduduk').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ordering: true, // Set true agar bisa di sorting
                order: [[1, 'asc']], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                aLengthMenu: [[5, 10, 50, -1], [5, 10, 50, 'Semua']],
                ajax: "{{ route('penduduk.index') }}",
                language: {
                    url: "{{asset('js/id.js')}}"
                },
                columns: [
                    {
                        "data": null,
                        "class": "align-top",
                        "orderable": false,
                        "searchable": false,
                        "render": function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { 'data': 'nik' },
                    { 'data': 'no_kk' },
                    { 'data': 'nama' },
                    { 'data': 'email' },
                    { 'data': 'no_hp' },
                    { 'data': 'aksi', 'sortable': false },
                ]
            });
        })
    </script>
@endsection

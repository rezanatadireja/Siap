@extends('layouts.masterAdmin')

@section('title_name')
    Pelayanan Pengaduan
@endsection

@section('custom_style')
    <link rel="stylesheet" href="{{asset('admin\stisla\plugins\datatables\css\datatabels.min.css')}}">   
    <link rel="stylesheet" href="{{asset('admin\stisla\plugins\datatables\css\dataTables.bootstrap4.min.css')}}">   
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pelayanan Pengaduan</h1>
    </div>
    <div class="section-body">
        <div class="card">
    <div class="card-header">
        <h4>Daftar Pelayanan Pengaduan</h4>
            <div class="card-header-action">
                <a href="#addPengaduanModal" class="btn btn-primary" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Pelayanan Pengaduan</a>
            </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="jenis_pengaduan" class="table table-striped no-footer mb-0">
                    <thead>
                    <tr class="text-center">
                        <th>Bidang</th>
                        <th>Sub Bidang</th>
                        <th>Layanan Pengaduan</th>
                        <th>Kuota Per/Hari</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pelayanan as $data)                        
                    <tr class="text-center">
                        <td>{{ $data->bidangPengaduan->name }}</td>
                        <td>{{ $data->subBidang->nama }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->kuota }}</td>
                        <td class="text-center ">
                        <a class="btn btn-primary btn-action mr-1 btn-edit" href="#" data-id="{{ $data->id }}" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                        <a class="btn btn-danger btn-action swal-confirm" data-toggle="tooltip" title="" data-original-title="Delete" data-id="{{ $data->id }}"><i class="fas fa-trash"></i>
                            <form action="{{ route( 'jenis-pengaduan.destroy', $data->id )}}" method="POST" id="delete{{ $data->id }}">
                                @csrf
                                @method('delete')
                            </form>
                        </a>
                        </td>
                    </tr>          
                    @endforeach 
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" tabindex="-1" role="dialog" id="addPengaduanModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Tambah Pelayanan Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('jenis-pengaduan.store')}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label @error('name') clas="text-danger"@enderror>Nama Bidang @error('name') | {{ $message}} @enderror</label>
                                {!! Form::select('bidang_pengaduan_id', \App\Models\BidangPengaduan::pluck('name', 'id'), null, ['class' => 'form-control select2', 'placeholder' => 'Pilih Bidang'])!!}
                            </div>
                            <div class="form-group">
                                <label @error('nama') clas="text-danger"@enderror>Nama Sub Bagian Bidang @error('nama') | {{ $message}} @enderror</label>
                                {!! Form::select('sub_bidang_id', \App\Models\SubBidang::pluck('nama', 'id'), null, ['class' => 'form-control select2', 'placeholder' => 'Pilih Sub Bidang'])!!}
                            </div>
                            <div class="form-group">
                                <label @error('nama') clas="text-danger"@enderror>Nama Pelayanan Pengaduan @error('nama') | {{ $message}} @enderror</label>
                                <input type="text" name="nama" value="{{ old('nama')}}" class="form-control" placeholder="Masukkan Nama Pelayanan">
                            </div>
                            <div class="form-group">
                                <label @error('kuota') clas="text-danger"@enderror>Kuota Pelayanan Per/Hari @error('kuota') | {{ $message}} @enderror</label>
                                <input type="text" name="kuota" value="{{ old('kuota')}}" class="form-control" placeholder="Masukkan Kuota Pelayanan">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('modal')
    <div class="modal fade" id="editPengaduanModal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">	
                <h5 class="modal-title">Edit Pelayanan Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                @include('admin.jenisPengaduan.form-ubah')
            </div>
            <div class="modal-footer bg-whitesmoke">
                <button type="button" class="btn btn-primary btn-update">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="{{asset('admin\stisla\plugins\datatables\js\datatables.min.js')}}"></script>
    <script src="{{asset('admin\stisla\plugins\datatables\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('js/pengaturan/jenis-pengaduan.js') }}"></script>
@endsection

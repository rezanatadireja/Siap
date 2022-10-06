@extends('layouts.masterGuest')

@section('title_name')
    Pelayanan Pengaduan Syarat
@endsection

@section('custom_style')
<style>
    a[data-fancybox] img {
  cursor: zoom-in;
}

.custom{
    border: 2px dashed #6777ef;
    min-height: 150px;
    text-align: center;
}

.fancybox__caption {
  text-align: center;
}
</style>
        <link href="{{asset('admin\stisla\plugins\datatables\css\datatabels.min.css')}}" rel="stylesheet" />
        <link href="{{asset('admin\stisla\plugins\datatables\css\dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
		{{-- <link rel="stylesheet" href="{{asset('css/summernote.css')}}" /> --}}
        <link href="{{asset('css\sweetalert2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Syarat Pelayanan Pengaduan</h1>
        <div class="section-header-breadcrumb">
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#"><b>NO : {{$pengaduan->no_pengaduan}}</b></a></div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Pengaduan</h2>
        <p class="section-lead">
        Silahkan lengkapi persyaratan pengaduan dibawah.
        </p>
        <div class="row">        
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card author-box card-primary">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="far fa-user"></i>
                            </div>
                            <h3>{{ucwords($pengaduan->user->penduduk->nama)}}</h3>
                            <div class="card-description">Nomor Induk Penduduk : {{$pengaduan->user->penduduk->nik}}</div>
                        </div>
                            <div class="card-body p-0">
                                <div class="table-responsive table-invoice">
                                    <table class="table table-striped">
                                            <tbody class="text-center">
                                                <tr>
                                                    <th>No Kartu Keluarga</th>
                                                    <th>Kecamatan</th>
                                                    <th>Email</th>
                                                    <th>No. HP</th>
                                                    <th>Jenis Pelayanan Pengaduan</th>
                                                    <th>Status</th>
                                                </tr>
                                                <tr>
                                                    <td>{{$pengaduan->user->penduduk->no_kk}}</td>
                                                    <td>{{ $pengaduan->user->email }}</td>
                                                    <td>{{$pengaduan->user->penduduk->no_hp}}</td>
                                                    <td>
                                                        <i>{{ $pengaduan->jenisPengaduan->nama}}</i>
                                                    </td>
                                                    <td><div class="badge badge-warning"><i class="fab fa-font-awesome-flag"></i> {{ ucwords($pengaduan->status) }}</div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    <div class="row">        
        <div class="col-12 col-md-12 col-lg-4" id="view">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Upload Persyaratan</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-primary alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                            <div class="alert-body" style="font-size:14px;">
                            <div class="alert-title" style="font-size: 15px;">Catatan :</div>
                            * Berkas File Minimal 2 Mb
                            <br>* Berkas File Format Jpg, Jpeg, Png
                        </div>
                    </div>
                    <form method="POST" action="{{ route('pengaduan.simpan')}}" enctype="multipart/form-data" id="form">
                        @csrf
                        <input type="text" value="{{ $pengaduan->id }}" name="pengaduan_id" hidden>
                        <div class="form-group">
                            <label>Syarat Pelayanan Pengaduan</label>
                                <select class="form-control select2" name="jenis_syarat_id">
                                    <option value="">Pilih Syarat Pelayanan Pengaduan</option>
                                    @foreach($pengaduan->jenisPengaduan->jenisSyarat as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            <div class="invalid-feedback">
                            Please fill in the first name
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Upload Berkas File</label>
                            <input type="file" name="file" class="form-control">
                            <span class="text-danger error-text file_error"></span>
                        </div>
                    </div>
                        <div class="card-footer bg-whitesmoke text-right">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Upload</button>
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8 p-0">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Tabel Persyaratan Pengaduan</h5>
                            <div class="card-header-action">
                                <button class="btn btn-primary" type="button" disabled id="loading" hidden>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0" id="list-syarat">
                            {{-- <div id="myWeather" class="ml-4 pb-3 pt-2">Loading. . .</div> --}}
                        </div>
                    </div>
                </div>
            </div>
</section>

@include('guest.editSyarat')
@include('guest.showSyarat')

@endsection



@section('custom_script_footer')
    <script src="{{ asset('admin\stisla\plugins\datatables\js\jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin\stisla\plugins\datatables\js\dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('js/pengaturan/syarat.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    {{-- <script src="{{ asset('js/pengaturan/adminSyarat.js')}}"></script> --}}
    {{-- <script src="{{ asset('js/summernote.js')}}"></script> --}}
    <script src="{{ asset('js\sweetalert2.all.min.js')}}"></script>
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


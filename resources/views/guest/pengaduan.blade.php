@extends('layouts.masterGuest')

@section('title_name')
    Pengaduan
@endsection

@section('custom_style')
    <link href="{{asset('css\sweetalert2.min.css')}}" rel="stylesheet" /> 
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pelayanan Pengaduan</h1>
        <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Pengaduan</a></div>
        <div class="breadcrumb-item">Penduduk</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">Selamat Datang, {{ucwords(Auth::user()->username)}}!</h2>
        <p class="section-lead">
        Silahkan lengkapi persyaratan pengaduan disamping.
        </p>
        <div class="row">        
        <div class="col-12 col-md-12 col-lg-4">
            <div class="card author-box card-primary">
                    <div class="card card-hero">
                        <div class="card-header">
                        <div class="card-icon">
                            <i class="far fa-user"></i>
                        </div>
                        <h3>{{ucwords($penduduk->nama)}}</h3>
                        <div class="card-description">Nomor Induk Penduduk : {{ $penduduk->nik}}</div>
                        </div>
                        <div class="card-body p-0">
                        <div class="tickets-list">
                            <a href="#" class="ticket-item">
                            <div class="ticket-title">
                                <h4>Nomor Kartu Keluarga</h4>
                            </div>
                            <div class="ticket-info">
                                <div>{{ $penduduk->no_kk }}</div>
                                {{-- <div class="bullet"></div> --}}
                                {{-- <div class="text-primary">1 min ago</div> --}}
                            </div>
                            </a>
                            <a href="#" class="ticket-item">
                            <div class="ticket-title">
                                <h4>Email</h4>
                            </div>
                            <div class="ticket-info">
                                <div>{{ Auth::user()->email }}</div>
                            </div>
                            </a>
                            <a href="#" class="ticket-item">
                            <div class="ticket-title">
                                <h4>No Handphone</h4>
                            </div>
                            <div class="ticket-info">
                                <div>{{ $penduduk->no_hp }}</div>
                            </div>
                            </a>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Formulir Pelayanan Pengaduan</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                    @csrf
                    <div class="row">                            
                        <input class="form-control" type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id}}">                         
                        <input class="form-control" type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->penduduk->nama }}">                         
                        <div class="form-group col-md-6 col-12">
                            <label>Pelayanan Pengaduan</label>
                                <select class="form-control select2" id="subBidang" name="sub_bidang">
                                    <option value="">Pilih Pelayanan Pengaduan</option>
                                    @foreach ($sub_bidang as $key => $value)
                                        <option value="{{$value->id}}">{{$value->nama}}</option>
                                    @endforeach
                                </select>
                            <div class="invalid-feedback">
                            Please fill in the first name
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                            <label>Jenis Pelayanan Pengaduan</label>
                                <select class="form-control select2" id="jenis_pelayanan" name="jenis_pelayanan">
                                    <option value=" "></option>
                                </select>
                            <div class="invalid-feedback">
                            Please fill in the last name
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke text-right">
                                <button class="btn btn-secondary">Kembali</button>
                                <button type="button" class="btn btn-icon icon-left btn-primary addPengaduan">Lanjutkan Pengaduan <i class="fas fa-paper-plane"></i> </button>
                            </div>
                        </form>
                    <hr>
                    <div class="row">
                    <div class="col-md-12">
                        <div class="section-title"><bold>Syarat Jenis Pelayanan</bold></div>
                        <div class="alert alert-light alert-has-icon">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-body">
                                <div class="alert-title" style="font-size:15px;">Catatan :</div>
                                Berkas disarankan di-scan maksimal 2 MB dengan format jpg, jpeg, atau png.
                            </div>
                        </div>
                        <ul id="jenis_syarat" class="list-group list-group-flush">
                            <li value="" class="list-group-item"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
</section>
@endsection

@section('custom_script')
    <script src="{{ asset('js\sweetalert2.all.min.js')}}"></script>
@endsection

@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/pengaduan.js') }}"></script>
@endsection


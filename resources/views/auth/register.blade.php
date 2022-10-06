@extends('layouts.masterGuest')

@section('title_name')
    Registrasi Penduduk
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{ url('/')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Registrasi Penduduk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Registrasi Penduduk</a></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Registrasi Penduduk</h2>
                <p class="section-lead">
                    Pastikan data yang di isi sesuai dengan data diri anda.
                </p>
        <div id="output-status"></div>
        <div class="row">
            <div class="col-md-12">
                    <div class="card" id="settings-card">
                    <div class="card-header">
                        <h4>Formulir Registrasi Penduduk</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('register')}}">
                        @csrf
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                    </button>
                                    {{ $error }}
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK</label>
                            <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" @error('nik') is-invalid @enderror id="nik" name="nik" onkeypress="return number(event)" placeholder="Masukan No Induk Kependudukan">
                            </div>
                            @error('nik')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Kartu Keluarga</label>
                                <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" id="no_kk" name="no_kk" onkeypress="return number(event)" maxlength="16" placeholder="Masukan No Kartu Keluarga">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="nama" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                                <div class="col-sm-12 col-md-7">
                                <input type="text" id="nama" class="form-control" @error('nama') is-invalid @enderror name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama">
                                </div>
                                @error('nama')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-4">
                                <label for="username" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                <div class="col-sm-12 col-md-7">
                                <input type="text" id="username" class="form-control" @error ('username') is-invalid @enderror name="username" value="{{ old('username') }}" placeholder="Masukan Username">
                                </div>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                                @error('username')
                                    <div class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                                <div class="col-sm-12 col-md-7">
                                <input type="email" class="form-control" name="email" placeholder="Masukan Email Yang Aktif">
                                </div>
                            </div>

                            {{-- <label>Phone Number (US Format)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control phone-number">
                                </div> --}}
                    
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No. HP</label>
                                <div class="col-sm-12 col-md-7 input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <span class="badge badge-primary mr-1">ID</span> +62
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" onkeypress="return number(event)"  placeholder="Masukan No Handphone Aktif">
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
                                <div class="col-sm-12 col-md-7">
                                <select class="form-control select2" id="kecamatan" name="kecamatan">
                                        <option value="0">Pilih Kecamatan</option>
                                    @foreach ($kecamatan->districts as $key => $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelurahan / Desa</label>
                                <div class="col-sm-12 col-md-7">
                                <select class="form-control select2" id="desa" name="desa">
                                    <option value=" "></option>
                                </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                <div class="col-sm-12 col-md-7">
                                <input type="password" class="form-control" @error('password') is-invalid @enderror name="password" placeholder="Masukan Password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row mb-4">
                                <label for="password-confirm" class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Confirmation</label>
                                <div class="col-sm-12 col-md-7">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke text-md-right">
                            <button class="btn btn-secondary" href="{{ url('/dashboard')}}" type="button"><i class="fas fa-arrow-left"></i> Kembali</button>
                            <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan & Lanjutkan</button>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/pengaduan.js') }}"></script>
@endsection
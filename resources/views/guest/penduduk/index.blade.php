@extends('layouts.masterGuest')

@section('title_name')
    Formulir Pengaduan
@endsection

@section('content')
{{-- <section class="section">
    <div class="section-header">
        <h1>Formulir Registrasi Penduduk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Registrasi Penduduk</a></div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Isi Formulir Sesuai Data Diri</h2>
                <p class="section-lead">Pastikan kembali data yang di isi benar.</p>
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Penduduk</h4>
                        </div>
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        <div class="card-footer bg-whitesmoke">
                        This is card footer
                        </div>
                    </div>
        </div>
</section> --}}
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="{{url('/')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Formulir Penduduk</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Formulir Penduduk</a></div>
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
                        <form method="POST" action="{{url('penduduk/pengaduan')}}">
                        @csrf
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pelayanan Pengaduan</label>
                                <div class="col-sm-12 col-md-7">
                                {!! Form::select('jenis_pengaduan_id', \App\Models\JenisPengaduan::pluck('nama', 'id'), null, ['class' => 'form-control select2'])!!}
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Detail Pengaduan</label>
                                <div class="col-sm-12 col-md-7">
                                <textarea type="text" class="form-control" id="detail" name="detail" placeholder="Jelaskan Singkat Tentang Pengaduan" style="height: 150px;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-whitesmoke text-md-right">
                            <button class="btn btn-primary" type="submit">Simpan & Lanjutkan</button>
                            <button class="btn btn-secondary" href="{{ url('/dashboard')}}" type="button">Kembali</button>
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
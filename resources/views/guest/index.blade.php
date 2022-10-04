@extends('layouts.masterGuest')


@section('content')
<section class="section">
    <div class="row mt-3">
        <div class="col-12 mb-3">
            <div class="hero text-white hero-bg-image hero-bg-parallax"  style="background-image: url({{'icon-layanan/1.jpg'}});">
                <div class="hero-inner">
                    @if (Auth::guest())
                        <h2> Selamat Datang Di SIAP (Sistem Informasi Pelayanan Disdukcapil)</h2>
                        <h3><strong>Kabupaten Majalengka</strong></h3>
                        <p class="lead">Pelayanan Pengaduan Online Dinas Kependudukan dan Pencatatan Sipil Kabupaten Majalengka.</p>
                        <p class="lead">Silahkan <strong>Registrasi</strong> untuk melanjutkan ke pengaduan yang dipilih.</p>
                    @else
                        <h2>Selamat Datang {{ ucwords(Auth::user()->username)}}</h2>
                        <p class="lead">Silahkan kirim pengaduan yang akan diajukan untuk ditindak lanjuti oleh pihak kami.</p>
                    @endif    
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                {{-- <i class="fas fa-cog"></i> --}}
                <img alt="image" src="{{ asset('icon-layanan/kk.png') }}" class="author-box-picture" style="width: 150px; height:100px;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Kartu Keluarga</h5>
                        <p class="card-text">Pelayanan Kartu Keluarga meliputi :<br>
                                - Kartu Keluarga Baru<br>
                                - Kartu Keluarga Perubahan Data (Anak Baru Lahir)<br>
                                - Kartu Keluarga Hilang/Rusak<br>
                        </p>
                            <a href="{{ url('pengaduan')}}" class="card-cta">Pelayanan Kartu Keluarga<i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                {{-- <i class="fas fa-search"></i> --}}
                <img alt="image" src="{{ asset('icon-layanan/ktp.png') }}" class="author-box-picture" style="width: 150px; height:100px;">
                </div>
                <div class="card-body">
                <h5 class="card-title">KTP-El</h5>
                    <p>Pelayanan KTP-El meliputi : <br>
                        - KTP-El Perubahan Data<br>
                        - KTP-El Perekaman Baruk<br>
                        - KTP-El Hilang/Rusak<br>
                    </p>
                <a href="{{ url('pengaduan')}}" class="card-cta">Pelayanan Pengaduan KTP-El<i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                {{-- <i class="fas fa-envelope"></i> --}}
                <img alt="image" src="{{ asset('icon-layanan/kia.png') }}" class="author-box-picture" style="width: 150px; height:100px;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Kartu Identitas Anak</h5>
                        <p class="card-text">Pelayanan Kartu Identitas Anak meliputi :<br>
                            - Kartu Identitas Anak Usia 7 hari - 5 tahun <br>
                            - Kartu Identitas Anak Usia 5 tahun - 17 tahun<br>
                        </p>
                <a href="{{ url('pengaduan')}}" class="card-cta">Pelayanan Pengaduan KIA<i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-large-icons">
                <div class="card-icon bg-primary text-white">
                {{-- <i class="fas fa-power-off"></i> --}}
                <img alt="image" src="{{ asset('icon-layanan/pp.png') }}" class="author-box-picture" style="width: 150px; height:100px;">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Penduduk Pindah/Datang</h5>
                        <p class="card-text">Pelayanan Pindah/Datang meliputi :<br>
                            - Penduduk Pindah<br>
                            - Penduduk Datang<br>
                        </p>
                <a href="{{ url('pengaduan')}}" class="card-cta">Pelayanan Pengaduan Pindah/Datang<i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card author-box card-primary">
                <div class="card-body">
                    <div class="author-box-left">
                    <img alt="image" src="{{ asset('icon-layanan/ilustration.png') }}" class="author-box-picture" style="width: 350px; height:300px;">
                    <div class="clearfix"></div>
                    </div>
                    <div class="author-box-details">
                    <div class="author-box-name mt-4">
                        <h2><a href="#">SIAP</a></h2>
                    </div>
                    <div class="author-box-job"><h5>Sistem Informasi Pelayanan Administrasi Kependudukan</h5></div>
                    <div class="author-box-description">
                        <p>Program pelayanan online administrasi kependudukan Dinas Kependudukan dan Pencatatan Sipil Kabupaten Majalengka.</p>
                    </div>
                    <div class="mb-2 mt-3"><div class="text-small font-weight-bold">Follow Sosial Media</div></div>
                    <a href="https://facebook.com" target="blank" class="btn btn-social-icon mr-1 btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" class="btn btn-social-icon mr-1 btn-twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" class="btn btn-social-icon mr-1 btn-instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <div class="w-100 d-sm-none"></div>
                    </div>
                </div>
            </div>
        </div>    
    </div>                      
</section>
@endsection
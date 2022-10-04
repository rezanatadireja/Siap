@extends('layouts.masterGuest')

@section('title_name')
    Pengaduan Saya
@endsection

@section('content')
<section class="section">
    <div class="section-body">
        <div class="row">       
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card author-box card-primary">
                    <div class="card card-hero">
                        <div class="card-header">
                        <div class="card-icon">
                            <i class="far fa-user"></i>
                        </div>
                        <h3>{{ucwords(Auth::user()->penduduk->nama)}}</h3>
                        <div class="card-description">Nomor Induk Penduduk : {{(Auth::user()->penduduk->nik)}}</div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive table-invoice">
                                <table class="table table-striped">
                                <tbody class="text-center">
                                <tr>
                                    <th>No Kartu Keluarga</th>
                                    <th>Email</th>
                                    <th>No. HP</th>
                                </tr>
                                <tr>
                                    <td>{{(Auth::user()->penduduk->no_kk)}}</td>
                                    {{-- <td><a href="#"><i>{{(Auth::user()->penduduk->no_kk)}}</i></a></td> --}}
                                    <td class="font-weight-600"><a href=""><i>{{ Auth::user()->email }}</i></a></td>
                                    <td>{{(Auth::user()->penduduk->no_hp)}}</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            <div class="col-12 col-md-12 col-lg-12 p-0">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Pengaduan Saya</h5>
                        <div class="card-header-action">
                            <button class="btn btn-primary" type="button" disabled id="loading" hidden>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" id="list-pengaduan">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection



@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/guestPengaduan.js') }}"></script>
@endsection


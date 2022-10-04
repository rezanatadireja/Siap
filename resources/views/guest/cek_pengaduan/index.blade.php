@extends('layouts.masterGuest')

@section('title_name')
    Cek Pengaduan
@endsection


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="container mt-3">
                <div class="row justify-content-center">
                <div class="col-12 col-md-9 offset-md-1 offset-lg-1">
                    <div class="login-brand">
                    Cek Pengaduan
                    </div>
                    <div id="listError"></div>
                    <div class="card card-primary">
                    <div class="row m-0 justify-content-center">
                        <div class="col-12 col-md-6 p-0">
                        <div class="card-body">
                            <form method="POST" id="cekPengaduan">
                                @csrf
                            <div class="form-group floating-addon">
                                <label>No Pengaduan</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-file-invoice"></i>
                                    </div>
                                </div>
                                <input id="no_pengaduan" type="text" class="form-control" value="{{ old('no_pengaduan') }}" name="no_pengaduan" autofocus="" placeholder="Masukkan Nomor Pengaduan">
                                </div>
                            </div>
                            <div class="form-group floating-addon">
                                <label>Nomor Induk Kependudukan</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <i class="fas fa-address-card"></i>
                                    </div>
                                </div>
                                <input id="nik" type="text" class="form-control" value="{{ old('nik') }}" name="nik" placeholder="Masukkan Nomor Induk Kepdudukan">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-round btn-lg btn-primary">
                                <i class="fas fa-search"></i> Cari
                                </button>
                            </div>
                            </form>
                        </div>  
                        </div>
                    </div>
                    </div>
                </div>
                    
                </div>
            </div>
            <div class="row justify-content-center" id="data" hidden>
                <div class="col-md-12">

                <div>
            </div>
        </div>
    </section>
@endsection

@section('modal')
    <div class="modal fade" id="modalPengaduan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"">
                    @csrf
                    <div class="modal-header">	
                        <h5 class="modal-title">Cek Pengaduan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        @include('guest.cek_pengaduan.result')
                    </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/cek-pengaduan.js') }}"></script>
@endsection
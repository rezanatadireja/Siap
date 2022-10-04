@extends('layouts.masterAdmin')

@section('title_name')
    Pengaduan
@endsection

@section('custom_style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Pengaduan</h1>
    </div>
    <div class="section-body">
        <h2 class="section-title">Formulir Pengaduan</h2>
        <p class="section-lead">Silahkan Isi Formulir Pengaduan.</p>
    </div>
    <div class="row">
        <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
            <h4>Formulir Pengaduan</h4>
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('pengaduan.store')}}">
                @csrf
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK</label>
                        <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="nik" name="nik" onkeypress="return number(event)" placeholder="Masukan No Induk Kependudukan">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Kartu Keluarga</label>
                        <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="no_kk" name="no_kk" onkeypress="return number(event)" maxlength="16" placeholder="Masukan No Kartu Keluarga">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                        <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Lengkap">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
                        <div class="col-sm-12 col-md-7">
                        <select class="form-control select2" id="kecamatan" name="kecamatan">
                            @foreach ($kecamatan as $key => $value)
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
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No. HP</label>
                        <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" onkeypress="return number(event)"  placeholder="Masukan No Handphone Aktif">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Detail Pengaduan</label>
                        <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control" id="detail" name="detail" placeholder="Jelaskan Singkat Tentang Pengaduan">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                        <button type="submit" id="simpan" class="btn btn-primary">Kirim Pengaduan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection

@section('custom_script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"></script>
@endsection


@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/pengaduan.js') }}"></script>
@endsection
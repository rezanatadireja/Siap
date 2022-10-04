{{-- @extends('layouts.masterGuest')

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
                        <h3>{{ucwords(Auth::user()->name)}}</h3>
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
                                <tr> --}}
                                    {{-- <td>{{(Auth::user()->penduduk->no_kk)}}</td> --}}
                                    {{-- {{-- <td><a href="#"><i>{{(Auth::user()->penduduk->no_kk)}}</i></a></td>
                                    <td class="font-weight-600"><a href=""><i>{{ Auth::user()->email }}</i></a></td>
                                    <td>0{{(Auth::user()->penduduk->no_hp)}}</td>
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
                </div>
                <div class="card-body p-0" id="list-pengaduan">

                </div>
                </div>
            </div>
        </div>
</section>

@include('guest.editSyarat')

@endsection --}}

{{-- 

@section('custom_script_footer')
    <script src="{{ asset('js/pengaturan/guestPengaduan.js') }}"></script>
@endsection --}}

@extends('layouts.masterGuest')

@section('title_name')
    Pengaduan Saya
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
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
		<link rel="stylesheet" href="{{asset('css/summernote.css')}}" />
@endsection

@section('content')
<section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ url('dashboard/mYpengaduan')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Pelayanan Pengaduan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#"><b>NO : {{$pengaduan->no_pengaduan}}</b></a></div>
            </div>
        </div>
        <div class="section-body">
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
                                    <th>Email</th>
                                    <th>No. HP</th>
                                    <th>Jenis Pelayanan Pengaduan</th>
                                    <th>Status</th>
                                </tr>
                                <tr>
                                    <td>{{$pengaduan->user->penduduk->no_kk}}</td>
                                    <td><a href="#">{{ $pengaduan->user->email }}</a></td>
                                    <td>{{$pengaduan->user->penduduk->no_hp}}</td>
                                    <td>
                                        <i><strong>{{ $pengaduan->jenisPengaduan->nama}}</strong></i>
                                    </td>
                                    <td>
                                        @if ($pengaduan->status == 'diterima')
                                            <div class="badge badge-success"><i class="fas fa-check-circle"></i> {{ ucwords($pengaduan->status) }}</div>
                                        @else
                                            <div class="badge badge-warning"><i class="fab fa-font-awesome-flag"></i> {{ ucwords($pengaduan->status) }}</div>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Persyaratan Pelayanan Pengaduan</h4>
                    </div>
                    <div class="card-body p-0" id="daftarSyarat">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

@include('guest.editSyarat')

@section('modal')
<div class="modal fade lihatSyarat" id="lihatSyarat">
    <div class="modal-dialog">
        <div class="modal-content"">
            <div class="modal-header">	
                <h5 class="modal-title">Konfirmasi Persyaratan Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form method="POST" action="{{route("konfirmasi.syarat")}}" id="update_syarat">
                @csrf
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer bg-whitesmoke">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade lihatPesan" id="lihatPesan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"">
            <div class="modal-header">	
                <h5 class="modal-title">Konfirmasi Pengaduan / Pelayanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            {{-- <form method="POST"  action="{{$pengaduan->id}}" data-id="{{$pengaduan->id}}"> --}}
                    <div class="modal-body">
                        
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@endsection



@section('custom_script_footer')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script src="{{ asset('js/pengaturan/myPengaduan.js')}}"></script>
    <script src="{{ asset('js/summernote.js')}}"></script>
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
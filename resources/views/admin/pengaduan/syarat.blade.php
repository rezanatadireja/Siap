@extends('layouts.masterAdmin')

@section('title_name')
    Pelayanan Syarat Pengaduan
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
        <link href="{{asset('css\sweetalert2.min.css')}}" rel="stylesheet" />
@endsection

@section('content')
<section class="section">
        <div class="section-header">
        <div class="section-header-back">
            <a href="{{ url('admin/pengaduan')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Detail Pengaduan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ url('admin/pengaduan') }}">Pelayanan Pengaduan</a></div>
                <div class="breadcrumb-item active">Detail Pengaduan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="col-12 col-md-12 col-lg-12">
                    <div class="card author-box card-primary">
                    <div class="card card-hero">
                        <div class="card-header">
                        <div class="card-icon flex">
                            <i class="far fa-user"></i>
                                @if($pengaduan->status == 'baru')
                                    <div class="mr-5 mb-5">
                                        <button  class="btn btn-sm btn-primary mt-2 kirimPesan" data-id="{{$pengaduan->id}}">Update Status</button>
                                    </div>
                                @endif
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
                        <div class="card-header-action">
                            <button class="btn btn-primary" type="button" disabled id="loading" hidden>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0" id="daftarSyarat">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade kirimSMS" id="kirimSMS">
    <div class="modal-dialog">
        <div class="modal-content"">
            <div class="modal-header">	
                <h5 class="modal-title">Pemberitahuan SMS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form action="{{ route('kirimSMS') }}" id="sendSMS">
                @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label>Nama </label>
                            <input type="text" name="nama" value="{{$pengaduan->user->penduduk->nama}}" readonly="" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label>No Handphone </label>
                            <input type="text" name="no_hp" value="{{$pengaduan->user->penduduk->no_hp}}" readonly="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan    <button type="button" id="clearInput" class="btn btn-default text-primary btn-sm"><i class="fas fa-sync-alt"></i> Refresh</button></label>
                            <textarea class="form-control" name="message" id="message" style="height: 150px;">Pelayanan Pengaduan {{ $pengaduan->jenisPengaduan->nama }} atas nama {{ucwords($pengaduan->user->penduduk->nama)}} telah diterima, silahkan login untuk melihat berkas pengaduan. Terima kasih.</textarea>
                            <span class="text-danger error-text file_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke">
                        <button type="submit" class="btn btn-primary" id="kirim"><i class="fas fa-paper-plane"></i> Kirim</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade kirimWhatsapp" id="kirimWhatsapp">
    <div class="modal-dialog">
        <div class="modal-content"">
            <div class="modal-header">	
                <h5 class="modal-title">Pemberitahuan Whatsapp</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <form action="{{ route('kirimWA') }}" id="sendWA">
                @csrf
                    <div class="modal-body">
                        <div class="form-group mt-2">
                            <label>Nama </label>
                            <input type="text" name="nama" value="{{$pengaduan->user->penduduk->nama}}" readonly="" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label>No Handphone </label>
                            <input type="text" name="no_hp" value="{{$pengaduan->user->penduduk->no_hp}}" readonly="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="message">Pesan    <button type="button" id="clearInput" class="btn btn-default text-primary btn-sm"><i class="fas fa-sync-alt"></i> Refresh</button></label>
                            <textarea class="form-control" name="message" id="message" style="height: 150px;">Pelayanan Pengaduan {{ $pengaduan->jenisPengaduan->nama }} atas nama {{ucwords($pengaduan->user->penduduk->nama)}} telah diterima, silahkan login untuk melihat berkas pengaduan. Terima kasih.</textarea>
                            <span class="text-danger error-text file_error"></span>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke">
                        <button type="submit" class="btn btn-primary" id="kirimWA"><i class="fas fa-paper-plane"></i> Kirim</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
    <script src="{{ asset('js/pengaturan/adminSyarat.js')}}"></script>
    <script src="{{ asset('js/summernote.js')}}"></script>
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
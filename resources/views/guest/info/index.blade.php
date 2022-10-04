@extends('layouts.masterGuest')

@section('title_name')
    Berkas Formulir
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Informasi Persyataran Pengaduan</h1>
        </div>
        <div class="section-body">
            <h2 class="section-title">Informasi persyaratan pengaduan</h2>
                <p class="section-lead">
                Persyaratan pengaduan akan berubah sesuai dengan kententuan yang berlaku.
                </p>
                <div class="row">
                @foreach ($jenisPengaduan as $item)
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $item->subBidang->nama }}</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                            <li class="media">
                                <div class="media-body">
                                    <div class="media-title mb-1">{{ $item->nama }}</div>
                                        <div class="media-description text-muted">
                                            @foreach ($item->jenisSyarat as $i)
                                            <ul>
                                                <li>
                                                    {{ $i->nama }}
                                                </li>
                                            </ul>
                                            @endforeach
                                        </div>
                                </div>
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
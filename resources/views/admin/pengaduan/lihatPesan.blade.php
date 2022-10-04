<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
            <div class="invoice-title">
                <h2>Pengaduan</h2>
                <div class="invoice-number text-primary"><b>{{$pengaduan->no_pengaduan}}</b></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                <address>
                    <strong>Pengirim :</strong><br>
                    {{-- {{$pengaduan->jenisPengaduan->subBidang->bidang->name}}<br> --}}
                    Sub. Bagian Bidang : {{$pengaduan->jenisPengaduan->subBidang->nama}}<br>
                    Jenis Pelayanan Pengaduan : {{$pengaduan->jenisPengaduan->nama}}<br>
                </address>
                </div>
                <div class="col-md-6 text-md-right">
                <address>
                    <strong>Dikirim Ke:</strong><br>
                    {{$pengaduan->user->penduduk->nik}}<br>
                    {{$pengaduan->user->penduduk->nama}}<br>
                    {{$pengaduan->user->email}}<br>
                    {{$pengaduan->user->penduduk->no_hp}}
                </address>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <address>
                        <strong>Tanggal Pengaduan :</strong><br>
                        {{$pengaduan->created_at->format('d-m-Y') }}<br><br>
                    </address>
                    </div>
                    <div class="col-md-6 text-md-right">
                    <address>
                        <strong>Status Persyaratan Pengaduan :</strong><br>
                        <i>{{ucwords($pengaduan->status)}}</i><br><br>
                    </address>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="text-md-right" id="btnSMS">
            <button class="btn btn-primary btn-icon icon-left btn-update" data-id="{{$pengaduan->id}}"><i class="fas fa-envelope"></i> Kirim Email</button>
            <button class="btn btn-warning btn-icon icon-left" data-bs-target="#kirimSMS" data-bs-toggle="modal" data-bs-dismiss="modal""><i class="fas fa-sms"></i> Kirim Pesan Singkat</button>
            <button class="btn btn-success btn-icon icon-left" data-bs-target="#kirimWhatsapp" data-bs-toggle="modal" data-bs-dismiss="modal""><i class="fab fa-whatsapp"></i> Kirim Whatsapp</button>
        </div>
    </div>
</div>

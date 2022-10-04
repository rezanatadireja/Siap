<div class="invoice">
    <div class="invoice-print">
        <div class="row">
            <div class="col-lg-12">
            <div class="invoice-title" id="data">
                <h2>Pengaduan</h2>
                <div class="invoice-number text-primary"><b><span id="pengaduan_no"></span></b></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                <address>
                    {{-- <strong>Informasi Pengaduan :</strong><br> --}}
                    @role('warga')
                    <strong>Nama : <span id="user_name"></span></strong><br>
                    <strong>NIK : <span id="user_nik"></span></strong><br>
                    @endrole
                    <strong>Bagian Bidang Pengaduan : <span id="bag_bidang" class="mt-3"></span></strong><br>
                    <strong>Sub Bagian Bidang Pengaduan : <span id="sub_bidang" class="mt-3"></span></strong><br>
                    <strong>Jenis Pengaduan : <span id="jenis_pengaduan" class="mt-3"></span></strong><br>
                    {{-- Sub. Bagian Bidang : {{$pengaduan->jenisPengaduan->subBidang->nama}}<br>
                    Jenis Pelayanan Pengaduan : {{$pengaduan->jenisPengaduan->nama}}<br> --}}
                </address>
                </div>
                <div class="col-md-12 text-md-right">
                <address>
                    <strong>Status Pengaduan</strong><br>
                        <span id="status_pengaduan" class="text-uppercase mt-2"></span>
                </address>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    @role('warga')
                    <p class="section-lead">Persyaratan Pengaduan</p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <thead>
                                            <tr>
                                                <th>Nama Syarat</th>
                                                <th>Status</th>
                                                <th class="text-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="list-syarat">
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address class="text-md-left">
                                            <i>Silahkan <strong>Unduh</strong> berkas disamping.</i><br>
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <address class="text-md-right">
                                            <strong>Unduh Berkas</strong><br>
                                            <button class="btn btn-warning btn-sm mt-2"><i class="fa fa-download"></i> Unduh</button>
                                        </address>
                                    </div>
                                </div>
                                @else
                                <div class="alert alert-primary alert-has-icon">
                                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Catatan:</div>
                                            Silahkan <i>login</i> untuk melihat syarat pelayanan pengaduan.
                                        </div>
                                </div>
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-md-right">
                @role('warga')
                <button class="btn btn-primary btn-icon icon-left" data-dismiss="modal"> Tutup</button>
                @else
                <button class="btn btn-primary btn-icon icon-left" href="{{ route('login') }}"><i class="fas fa-sign-out-alt"></i> Login</button>
                @endrole
            </div>
        </div>
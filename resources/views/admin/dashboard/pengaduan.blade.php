<div class="modal fade" tabindex="-1" role="dialog" id="editKuotaPengaduan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Update Kuota Pelayanan Pengaduan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('jenis-pengaduan.store')}}" id="updateKuota">
                @csrf
                <div class="modal-body">
                  <div id="listError"></div>
                    <div class="row">
                        <div class="col-md-12">
                              <input type="text" name="id_data" id="id_data" class="form-control" hidden>
                              <input type="text" name="bidang" id="bidang" class="form-control" hidden>
                              <input type="text" name="sub_bidang" id="sub_bidang" class="form-control" hidden>
                            <div class="form-group">
                                <label @error('nama') clas="text-danger"@enderror>Nama Pelayanan Pengaduan @error('nama') | {{ $message}} @enderror</label>
                                    <input type="text" name="nama" id="nama" class="form-control "readonly>
                            </div>
                            <div class="form-group">
                                <label @error('kuota') clas="text-danger"@enderror>Kuota Pelayanan Per/Hari @error('kuota') | {{ $message}} @enderror</label>
                                    <input type="text" name="kuota" id="kuota" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-primary updateKuota">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
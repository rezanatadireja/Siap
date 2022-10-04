<div class="modal fade editSyarat">
    <div class="modal-dialog">
        <div class="modal-content"">
        <div class="modal-header">	
            <h5 class="modal-title">Edit Persyaratan Pengaduan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
            <form method="POST"  action="{{route("update.syarat")}}" enctype="multipart/form-data" id="update_form">
                        @csrf
                        <input type="hidden" name="pengaduan_id" id="{{$pengaduan->id}}" value="{{$pengaduan->id}}">
                        <input type="hidden" name="syarat_id" value="">
                        <div class="form-group">
                            <label>Syarat Pelayanan Pengaduan</label>
                                <select class="form-control" name="jenis_syarat_id">
                                    <option value="">Pilih Syarat Pelayanan Pengaduan</option>
                                    @foreach($pengaduan->jenisPengaduan->jenisSyarat as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                    @endforeach
                                </select>
                            <div class="invalid-feedback">
                            Please fill in the first name
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Upload Berkas File <button type="button" id="clearInput" class="btn btn-danger btn-sm"><i class="fas fa-sync-alt"></i> Refresh</button></label>
                            <input type="file" name="file_update" class="form-control">
                            <span class="text-danger error-text file_update_error"></span>
                        </div>
                        <div class="img-holder-update">
                            <a data-fancybox="gallery" href="/storage/files/" data-caption="">
                                <img class="img-fluid mx-auto d-block" width="150" height="100" />
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary btn-update">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
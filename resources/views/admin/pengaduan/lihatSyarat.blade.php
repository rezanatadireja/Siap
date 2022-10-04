
    <input type="hidden" name="pengaduan_id" value="{{$syarat->pengaduan_id}}">
    <input type="hidden" name="syarat_id" value="{{$syarat->id}}">
        <div class="card">
            <div class="card-body custom">
                <a data-fancybox="gallery" href="/storage/files/{{$syarat->file}}" data-caption="{{$syarat->jenisSyarat->nama}}">
                    <img src="/storage/files/{{$syarat->file}}" class="img-fluid mx-auto d-block" width="150" height="100" />
                </a>
            </div>
        </div>
        <div class="form-group mt-2">
            <label>Syarat Pelayanan Pengaduan</label>
            <input type="text" name="jenisSyarat_id" value="{{$syarat->jenisSyarat->nama}}" readonly="" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Konfirmasi Syarat</label>
            {!! Form::select('status', ['diterima' => 'Terima', 'diperbaiki' => 'Perbaikan'], $syarat->status, ['class' => 'form-control select2', 'placeholder' => 'Pilih Konfirmasi Syarat'])!!}
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" name="keterangan" style="height: 70px;" placeholder="Isi ketarangan apabila syarat pengaduan belum memenuhi ketentuan."></textarea>
        </div>

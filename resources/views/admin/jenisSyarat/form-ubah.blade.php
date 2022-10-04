
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" value="{{ $data->id }}" name="id" id="id_data" class="form-control">
            <input type="hidden" value="{{ $data->jenisPengaduan->id }}" name="jenis_pengaduan_id" class="form-control">
            <div class="form-group">
                <label @error('nama') clas="text-danger"@enderror>Nama Bidang @error('nama') | {{ $message}} @enderror</label>
                <input type="text" name="jeni-pengaduan" value="{{$data->jenisPengaduan->nama}}" class="form-control" readonly>
                {{-- {!! Form::select('jenis_pengaduan_id[]', $data->jenisPengaduan->nama, \App\Models\JenisPengaduan::pluck('nama', 'id'), ['class' => 'form-control select2'])!!} --}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label @error('nama') clas="text-danger"@enderror>Syarat Pelayanan Pengaduan @error('nama') | {{ $message}} @enderror</label>
                <input type="text" name="nama" value="{{ $data->nama }}" class="form-control">
            </div>
        </div>
    </div>

    

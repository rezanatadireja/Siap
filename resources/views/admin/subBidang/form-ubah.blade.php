
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" value="{{ $subBidang->id }}" name="id" id="id_data" class="form-control">
            <div class="form-group">
                <label @error('nama') clas="text-danger"@enderror>Nama Sub Bidang @error('nama') | {{ $message}} @enderror</label>
                <input type="text" name="nama" value="{{ $subBidang->nama }}" class="form-control">
            </div>
        </div>
    </div>

    

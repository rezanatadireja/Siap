
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" value="{{ $bidang->id }}" name="id" id="id_data" class="form-control">
            <div class="form-group">
                <label @error('name') clas="text-danger"@enderror>Nama Bidang @error('name') | {{ $message}} @enderror</label>
                <input type="text" name="name" value="{{ $bidang->name }}" class="form-control">
            </div>
        </div>
    </div>

    

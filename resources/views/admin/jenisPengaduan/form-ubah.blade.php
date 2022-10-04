<ul id="listError"></ul>
<div class="row">
    <div class="col-md-12">
        <input type="hidden" name="id" id="id_data" class="form-control">
        <div class="form-group">
            <label @error('name') class="text-danger"@enderror>Nama Bidang @error('name') | {{ $message}} @enderror</label>
            <select name="edit_bidang" id="edit_bidang" class="form-control selct2" readonly disabled>
                <option>Pilih Bidang</option>
                @foreach ($b as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">    
            <label @error('nama') class="text-danger"@enderror>Sub Bagian Bidang @error('nama') | {{ $message}} @enderror</label>
            <select name="edit_sub_bidang" id="edit_sub_bidang" class="form-control selct2" readonly disabled>
                <option>Pilih Sub Bidang</option>
                @foreach ($s as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label @error('nama') class="text-danger"@enderror>Pelayanan Pengaduan @error('nama') | {{ $message}} @enderror</label>
            <input type="text" name="edit_nama" id="edit_nama" class="form-control">
        </div>
        <div class="form-group">
            <label @error('kuota') class="text-danger"@enderror>Kuota Pelayanan Per/Hari @error('kuota') | {{ $message}} @enderror</label>
            <input type="text" name="edit_kuota" id="edit_kuota" class="form-control">
        </div>
    </div>
</div>

    <input type="hidden" name="id" value="{{$formulir->id}}">
        <div class="card">
            <div class="card-body custom">
                <a data-fancybox="gallery" href="/storage/files/formulir{{$formulir->file}}" data-caption="{{$formulir->name}}">
                    <img src="/storage/files/formulir/{{$formulir->file}}" class="img-fluid mx-auto d-block" width="150" height="100" />
                </a>
            </div>
        </div>
        <div class="form-group mt-2">
            <label>Nama Berkas</label>
            <input type="text" name="name" value="{{$formulir->name}}" class="form-control">
        </div>

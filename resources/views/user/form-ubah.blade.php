<div class="form-group">
    {!! Form::label('usernameubah', 'Username') !!}
    {!! Form::text('usernameubah', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama Pengguna']) !!}
</div>

<div class="form-group">
    {!! Form::label('roleubah', 'Pilih Role') !!}
    {!!  Form::select('roleubah', [], null, ['class' => 'form-control select2', 'style'=>"width: 100%;"])  !!}
</div>

<div class="form-group">
    {!! Form::label('fullnameubah', 'Nama Lengkap') !!}
    {!! Form::text('fullnameubah', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama Lengkap']) !!}
</div>

<div class="checkbox">
    <label>
        <input type="checkbox" name="ubahkatasandi" id="ubahkatasandi" value="" checked> Mengubah Password
    </label>
</div>

<div id="divSandi" class="form-group hidden">
    {!! Form::label('passwordubah', 'Kata Sandi Baru') !!} <br/>
    <div id="divSandi" class="form-group input-group">
        {!! Form::password('passwordubah', null, ['class' => 'form-control', 'placeholder' => 'Masukkan Kata Sandi']) !!}
        {{-- <span class="input-group-append">
            <button class="btn btn-primary" id="katasandiautoubah">
                Otomatis
            </button>
        </span> --}}
    </div>
</div>

<div class="checkbox">
    <label>
        <input type="checkbox" name="activeubah" id="activeubah" value=""> Aktif
    </label>
</div>


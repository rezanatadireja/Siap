<div class="form-group">
    {!! Form::label('username', 'Username') !!}
    {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama Pengguna', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('fullname', 'Nama Lengkap') !!}
    {!! Form::text('fullname', null, ['class' => 'form-control', 'placeholder' => 'Masukan Nama Lengkap']) !!}
</div>

<div class="form-group">
    {!! Form::label('role', 'Pilih Level User') !!}
    {!!  Form::select('role', [], null, ['class' => 'form-control select2', 'style'=>"width: 100%;"])  !!}
</div>

{{-- <div class="form-group">
    {!! Form::label('password', 'Kata Sandi') !!} <br/>
    {!! Form::password('password', null, ['class' => 'form-control', 'placeholder' => 'Kata Sandi']) !!}
</div> --}}

<div class="form-group">
    <div class="d-block">
        <label for="password" class="control-label">Password</label>
    </div>
    <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>
    <div class="invalid-feedback">
        please fill in your password
    </div>
    </div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="active" id="active" value=""> Aktif
    </label>
</div>
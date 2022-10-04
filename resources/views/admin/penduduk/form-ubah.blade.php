<div class="row">
    <div class="col-md-6">
        <input type="hidden" value="{{ $data->id }}" name="id" id="id_data" class="form-control">
        <input type="hidden" value="{{ $data->user->id }}" name="user_id" class="form-control">
            <div class="form-group row">
                {{ Form::label('nik', 'NIK'.' :', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" name="nik" value="{{ $data->nik }}" onkeypress="return number(event)" autocomplete="off" placeholder="Nomor Induk Kependudukan">
                    </div>
            </div>
            <div class="form-group row">
                {{ Form::label('no_kk', 'No KK'.' :', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" name="no_kk" value="{{ $data->no_kk }}" autocomplete="off" onkeypress="return number(event)" placeholder="Nomor Kartu Keluarga">
                    </div>
            </div>
            <div class="form-group row">
                {{ Form::label('name', 'Nama'.' :', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" name="name" value="{{ $data->user->name }}" autocomplete="off" placeholder="Nama Lengkap">
                    </div>
                </div>
            <div class="form-group row">
                {{ Form::label('kecamatan', 'Kecamatan'.':', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        <select name="kecamatan" id="kecamatan" class="form-control select2">
                            <option value="0">Pilih Kecamatan</option>
                            @foreach ($kecamatan as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select> 
                        {{-- <input type="text" class="form-control" name="kecamatan" autocomplete="off" placeholder="Masukkan Nama Kecamatan"> --}}
                    </div>
                </div>
            <div class="form-group row">
                {{ Form::label('desa', 'Desa'.' :', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9"> 
                        <select name="desa" id="desa" class="form-control select2">
                            <option value="0">Pilih Desa</option>
                            <option value=""></option>
                        </select>
                        {{-- <input typey="text" class="form-control" name="desa" autocomplete="off" placeholder="Masukkan Nama Desa"> --}}
                    </div>
                </div>
        </div>
        <div class="col-md-6">
                <div class="form-group row">
                    {{ Form::label('username', 'Username'.' :', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" name="username" value="{{ $data->user->username }}" autocomplete="off" placeholder="Username">
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('email', 'Email'.' :', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" name="email" value="{{ $data->user->email }}">
                    </div>
                </div>
                <div class="form-group row">
                    {{ Form::label('no_hp', 'No Hp'.' :', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9"> 
                        <input type="text" class="form-control" name="no_hp" onkeypress="return number(event)" value="{{ $data->no_hp }}">
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                        {{ Form::label('password', 'Password', ['class'=>'col-sm-3 text-right']) }}
                        <div class="col-sm-9"> 
                                <input type="password" class="form-control" name="password" placeholder="Kata Sandi">
                        </div>
                </div>
                <div class="form-group row">
                        {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'col-sm-3 text-right']) }}
                        <div class="col-sm-9"> 
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Kata Sandi">
                        </div>
                </div>
        </div>
</div>

{{-- @section('custom_script_footer')
<script src="{{ asset('js/pengaturan/penduduk.js') }}"></script>
@endsection --}}
<div class="row">
    <div class="col-md-6">
        <input type="hidden" name="id" id="id_data" class="form-control">
        {{-- <input type="hidden" value="{{ $data->user->id }}" name="user_id" id="user_id" class="form-control"> --}}
        <div class="form-group row">
            {{ Form::label('nik', 'NIK'.' :', ['class'=>'col-sm-3 text-right']) }}
            <div class="col-sm-9">
                <input
                    type="text"
                    class="form-control"
                    name="nik"
                    id="edit_nik"
                    onkeypress="return number(event)"
                    autocomplete="off"
                    placeholder="Nomor Induk Kependudukan"></div>
            </div>
            <div class="form-group row">
                {{ Form::label('no_kk', 'No KK'.' :', ['class'=>'col-sm-3 text-right']) }}
                <div class="col-sm-9">
                    <input
                        type="text"
                        class="form-control"
                        name="no_kk"
                        id="edit_kk"
                        autocomplete="off"
                        onkeypress="return number(event)"
                        placeholder="Nomor Kartu Keluarga"></div>
                </div>
                <div class="form-group row">
                    {{ Form::label('name', 'Nama'.' :', ['class'=>'col-sm-3 text-right']) }}
                    <div class="col-sm-9">
                        <input
                            type="text"
                            class="form-control"
                            name="nama"
                            id="edit_nama"
                            autocomplete="off"
                            placeholder="Nama Lengkap"></div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('kecamatan', 'Kecamatan'.':', ['class'=>'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            <select name="edit_kecamatan" id="edit_kecamatan" class="form-control select2">
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatan->districts as $key => $item)
                                <option value="{{ $item->id }}" selected="true">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" name="kecamatan" autocomplete="off" placeholder="Masukkan Nama Kecamatan"> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        {{ Form::label('desa', 'Desa'.' :', ['class'=>'col-sm-3 text-right']) }}
                        <div class="col-sm-9">
                            <select name="edit_desa" id="edit_desa" class="form-control select2">
                                <option value="">Pilih Desa</option>
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
                            <input
                                type="text"
                                class="form-control"
                                name="username"
                                id="edit_username"
                                readonly="readonly"></div>
                        </div>
                        <div class="form-group row">
                            {{ Form::label('email', 'Email'.' :', ['class'=>'col-sm-3 text-right']) }}
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="email"
                                    id="edit_email"
                                    readonly="readonly"></div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('no_hp', 'No Hp'.' :', ['class'=>'col-sm-3 text-right']) }}
                                <div class="col-sm-9">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="no_hp"
                                        id="edit_hp"
                                        onkeypress="return number(event)"></div>
                                </div>
                                <hr>
                                    <div class="form-group row">
                                        {{ Form::label('password', 'Password', ['class'=>'col-sm-3 text-right']) }}
                                        <div class="col-sm-9">
                                            <input
                                                type="password"
                                                class="form-control"
                                                name="password"
                                                id="edit_password"
                                                readonly="readonly"></div>
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'col-sm-3 text-right']) }}
                                            <div class="col-sm-9">
                                                <input
                                                    type="password"
                                                    class="form-control"
                                                    name="password_confirmation"
                                                    readonly="readonly"></div>
                                            </div>
                                        </div>
                                    </div>
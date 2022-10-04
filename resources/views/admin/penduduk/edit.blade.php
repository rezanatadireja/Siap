<div class="modal fade" tabindex="-1" role="dialog" id="editPenduduk">
        <div class="modal-dialog modal-lg"  role="document">
            <div class="modal-content"">
            <div class="modal-header">	
                <h5 class="modal-title">Edit Penduduk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <ul id="update-error"></ul>
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" value="{{ $data->id }}" name="id" id="id_data" class="form-control">
                        <input type="hidden" value="{{ $data->user->id }}" name="user_id" id="user_id" class="form-control">
                            <div class="form-group row">
                                {{ Form::label('nik', 'NIK'.' :', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        <input type="text" class="form-control" name="nik" id="edit_nik" onkeypress="return number(event)" autocomplete="off" placeholder="Nomor Induk Kependudukan">
                                    </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('no_kk', 'No KK'.' :', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        <input type="text" class="form-control" name="no_kk" id="edit_kk" autocomplete="off" onkeypress="return number(event)" placeholder="Nomor Kartu Keluarga">
                                    </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('name', 'Nama'.' :', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        <input type="text" class="form-control" name="nama" id="edit_nama" autocomplete="off" placeholder="Nama Lengkap">
                                    </div>
                                </div>
                            <div class="form-group row">
                                {{ Form::label('kecamatan', 'Kecamatan'.':', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9">
                                        <select name="edit_kecamatan" id="edit_kecamatan" class="form-control select2">
                                            <option value="0">Pilih Kecamatan</option>
                                            @foreach ($kecamatan as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select> 
                                        {{-- <input type="text" class="form-control" name="kecamatan" autocomplete="off" placeholder="Masukkan Nama Kecamatan"> --}}
                                    </div>
                                </div>
                            <div class="form-group row">
                                {{ Form::label('desa', 'Desa'.' :', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        <select name="edit_desa" id="edit_desa" class="form-control select2">
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
                                        <input type="text" class="form-control" name="username" id="edit_username" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('email', 'Email'.' :', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        <input type="text" class="form-control" name="email" id="edit_email" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('no_hp', 'No Hp'.' :', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        <input type="text" class="form-control" name="no_hp" id="edit_hp" onkeypress="return number(event)">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                        {{ Form::label('password', 'Password', ['class'=>'col-sm-3 text-right']) }}
                                        <div class="col-sm-9"> 
                                                <input type="password" class="form-control" name="password" id="edit_password" readonly>
                                        </div>
                                </div>
                                <div class="form-group row">
                                        {{ Form::label('password_confirmation', 'Confirm Password', ['class'=>'col-sm-3 text-right']) }}
                                        <div class="col-sm-9"> 
                                                <input type="password" class="form-control" name="password_confirmation" readonly>
                                        </div>
                                </div>
                        </div>
                </div>
            </div>
                <div class="modal-footer bg-whitesmoke">
                    <button type="button" class="btn btn-primary btn-update">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<div class="modal fade" tabindex="-1" role="dialog" id="addPenduduk">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penduduk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body" >
                <form method="POST" action="{{ route('penduduk.create') }}" id="form">
                    @csrf
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group row">
                                {{ Form::label('nik', 'NIK'.' *', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9">
                                        <input type="text" name="nik" class="form-control" onkeypress="return number(event)" placeholder="Nomor Induk Kependudukan"> 
                                        {{-- {{ Form::text('nik', null, array('class' => 'form-control','autocomplete'=>'off','placeholder'=>'Nomor Induk Kependudukan', 'onkeypress' => 'return number(event)')) }} --}}
                                    </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('no_kk', 'No KK'.' *', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        {{ Form::text('no_kk', null, array('class' => 'form-control','autocomplete'=>'off','placeholder'=>'Nomor Kartu Keluarga', 'onkeypress' => 'return number(event)')) }}
                                    </div>
                            </div>
                            <div class="form-group row">
                                {{ Form::label('name', 'Nama'.' *', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        {{ Form::text('nama', null, array('class' => 'form-control','autocomplete'=>'off','placeholder'=>'Nama Lengkap')) }}
                                    </div>
                                </div>
                            <div class="form-group row">
                                {{ Form::label('kecamatan', 'Kecamatan'.' *', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        <select name="kecamatan" id="kecamatan" class="form-control select2">
                                            <option value="0">Pilih Kecamatan</option>
                                            @foreach ($kecamatan->districts as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            <div class="form-group row">
                                {{ Form::label('desa', 'Desa'.' *', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        <select name="desa" id="desa" class="form-control select2">
                                            <option value="0">Pilih Desa</option>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <div class="form-group row">
                                    {{ Form::label('username', 'Username'.' *', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        {{ Form::text('username', null, array('class' => 'form-control','autocomplete'=>'off','placeholder'=>'Username')) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('email', 'Email'.' *', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        {{ Form::text('email', null, array('class' => 'form-control','placeholder'=>'Email')) }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{ Form::label('no_hp', 'No Hp'.' *', ['class'=>'col-sm-3 text-right']) }}
                                    <div class="col-sm-9"> 
                                        {{ Form::text('no_hp', null, array('class' => 'form-control','placeholder'=>'Nomor Handphone', 'onkeypress' => 'return number(event)')) }}
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
            </div>
            <div class="modal-footer bg-whitesmoke">
                {{ Form::submit(__('Simpan'), array('class' => 'btn btn-primary tambahPenduduk')) }}
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
            {{ Form::close() }}
        </form>
        </div>
    </div>
</div>
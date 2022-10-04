@if(!empty($user))
<div class="modal-content" id="editUser">
{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}
@else
<div class="modal-content" id="addUser">
    {{ Form::open(array('url' => 'users', 'files' => true,)) }}
@endif
<div class="modal-header">	
  <h5 class="modal-title">@if(!empty($user)) Edit User @else Buat User @endif</h5>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
</div>
<div class="modal-body" >
	<div class="row">
		<div class="col-md-6">
				<div class="form-group row">
					{{ Form::label('name', 'Nama'.' *', ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
							{{ Form::text('name', null, array('class' => 'form-control','autocomplete'=>'off','placeholder'=>'Nama Lengkap')) }}
						</div>
				</div>
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
			</div>
			<div class="col-md-6">
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
    @if(auth()->user()->checkPermission('assign.roles'))
			<div class="form-group row">
				{{ Form::label('role', __('Role *'), ['class'=>'col-sm-2 text-center']) }}
				<div class="col-sm-10 pl-0"> 
						@foreach($roles as $role)
							<span style="margin-right:30px"><input type="checkbox" name="role[]" value="{{$role->name}}" {{(!empty($user) && $user->hasRole($role->name)) ? 'checked' : ''}}> {{ucwords($role->name)}}</span>
						@endforeach
				</div>
			</div>
    @endif
</div>
<div class="modal-footer bg-whitesmoke">
    {{ Form::submit(__('Simpan'), array('class' => 'btn btn-primary')) }}
    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
</div>
{{ Form::close() }}
</div>
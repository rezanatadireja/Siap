
<div class="modal-body">
	<div class="row">
		<div class="col-md-6">
            <input type="hidden" value="{{ $user->id }}" name="id" id="id_data" class="form-control">
				<div class="form-group row">
					{{ Form::label('name', 'Nama'.' *', ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
                            <input type="text" name="name" value="{{ $user->name }}" class="form-control">
						</div>
				</div>
				<div class="form-group row">
					{{ Form::label('username', 'User'.' *', ['class'=>'col-sm-3 text-right']) }}
						<div class="col-sm-9"> 
							<input type="text" name="username" value="{{ $user->username }}" class="form-control">
						</div>
				</div>
				<div class="form-group row">
					{{ Form::label('email', 'Email'.' *', ['class'=>'col-sm-3 text-right']) }}
					<div class="col-sm-9"> 
							<input type="text" name="email" value="{{ $user->email }}" class="form-control">
					</div>
				</div>
				{{--  --}}
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
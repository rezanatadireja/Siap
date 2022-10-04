<div class="row" id="permissionList">
	@foreach($permissions as $key=>$svalue)
	<div class="col-sm-3" id="list">
		<div class="card">
		<div class="box box-success permission-list">
			<div class="card-header"><b>{{ucfirst($key)}}</b> 
				<input type="checkbox" id="checkAllPer" class="pull-right" 
				onclick="checkPermissions(this)" {{($role->hasAnyPermission($svalue)) ? 'checked' : ''}}>
			</div>
			<div class="card-body">
				@foreach($svalue as $value)
						<p><input type="checkbox" name="permissions[]" 
								value="{{$value->id}}" {{($role->hasPermissionTo($value->name)) ? 'checked' : ''}} 
								onclick="checkAllPermissions(this)"> {{$value->label}}
						</p>
				@endforeach
			</div>
		</div>
	</div>
	</div>
	@endforeach
</div>
@extends('layouts.masterAdmin')

@section('title_name')
    Daftar Permission
@endsection

@section('content')
<section class="section">
	<div class="section-header">
        <h1>Manajemen Permissions</h1>
        <div class="section-header-breadcrumb">
            <div class="card-header-action">
                <button type="button" submit-toggle="#rolePermissionMapping" class="btn btn-flat btn-primary btn-update">Simpan Permission</button>@if(auth()->user()->checkPermission('permissions.create'))@endif
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-sm-12" id="refresh">
			<div class="card">
				{{ Form::open(['url'=>route('permissionrole.create'), 'id'=>'rolePermissionMapping']) }}
			<div class="card-body">
					<div class="form-group">
						<label for="role">Pilih Role</label>
						{{ Form::select('role_id', $roles, $role_id, ['class'=>'form-control select2', 'onchange'=>'onChange()', 'id'=>'role_id']) }}
					</div>
				</div>
			</div>
		@include('users.permission_list')
		{{ Form::close() }}					
		</div>
	</div>
</section>    
@endsection

@section('custom_script')
    <script src="{{ asset('js/pengaturan/util.js') }}"></script>
@endsection
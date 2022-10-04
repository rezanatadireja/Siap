<div id="usersTable">    
	<table id="myTable" class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th>Username</th>
				<th>Alamat Email</th>
				<th class="hidden-xs">Role</th>
				<th class="text-center">Aksi</th>
			</tr>
		</thead>
		<tbody>
		@foreach($users as $data)
			<tr>
				<td>{{ $data->username }}</td>
				<td>{{ $data->email }}</td>
				<td>
						@php $n=1; @endphp
						@foreach($data->getRoleNames() as $role) 
						{{$n > 1 ? ', ':null}}{{ucwords($role)}}
						@php $n++; @endphp
						@endforeach
				</td>
				<td class="text-center py-0 align-middle">
		{{-- @foreach($actions as $action)
			@if($action['name'] == 'delete')
				<a href="#" class="form-inline" onclick="return confirm('Yakin?')">
				{{ Form::open(array('url' => $action['url'], 'class' => 'form-inline')) }}
				{{ Form::hidden('_method', 'DELETE') }}
				{{ Form::submit('Hapus', array('class' => 'btn btn-danger')) }}
				{{ Form::close() }}</a>
			@else
				<a href="{{$action['url']}}" class="btn btn-info form-inline"
						@if(!empty($action['data-replace'])) data-replace-empty="{{$action['data-replace']}}" @endif
						@if(!empty($action['ajax-url'])) data-ajax-url="{{$action['ajax-url']}}" data-toggle="modal" @endif
					><i class="fas fa-{{!empty($action['icon']) ? $action['icon'] : 'pencil-alt'}}"></i></a>
			@endif
		@endforeach --}}
		<a class="btn btn-primary btn-action mr-1 btn-edit" href="#" data-id="{{ $data->id }}" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i>
		</a>
		<a class="btn btn-danger btn-action swal-confirm" data-toggle="tooltip" title="" data-original-title="Delete" data-id="{{ $data->id }}"><i class="fas fa-trash"></i>
			<form action="{{ route( 'users.destroy', $data->id )}}" method="POST" id="delete{{ $data->id }}">
				@csrf
				@method('delete')
			</form>
		</a>
		{{-- <a href="#" data-id="{{ $data->id }}" class="btn btn-info form-inline btn-edit">Edit</a> --}}



						{{-- @php
							$actions = [
								['data-replace'=>'#editUser','url'=>'#editUserModal','ajax-url'=>url('users/'.$data->id.'/edit'), 'name'=>'Edit', 'icon'=>'pencil-alt'],
								['url'=>'users/' . $data->id,'name'=>'delete']];
							@endphp
						@include('component.actions', ['actions'=>$actions]) --}}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	{{-- Pagination --}}
    @include('component.pagination', ['items'=>$users, 'index_route'=>route('users.index')])
		{{-- Modal Role--}}
</div>
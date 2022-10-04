{{-- <div class="btn-group btn-group-sm">
		@foreach($actions as $action)
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
		@endforeach
		<a href="#" data-id="{{ $data->id }}" class="btn btn-info form-inline btn-edit">Edit</a>
</div>

 --}}

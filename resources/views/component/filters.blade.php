<div class="card-header-form">
	<form class="form-inline custom-filter" action="{{$filter_route}}" method="GET" id="{{$filter_id}}">
	{{-- <div class="form-group pr-2">
		<label class="pr-1" for="per_page">{{__('Show')}} </label>
		<select autocomplete="off" class="form-control sm" name="filter[per_page]" id="per_page"  onchange="$('#{{$filter_id}}').submit()">
				<option value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
		</select>
	</div> --}}
	<div class="form-group pull-right">
			<label class="pr-1" for="search">{{__('Search')}} </label>
			<input autocomplete="off" type="text" name="filter[search]" id="search" class="form-control" onkeyup="submitOnEnter('#{{$filter_id}}')" />
	</div>
	</form>
</div>

{{-- <div class="card-tools">
	<div class="form-group pr-2">
		<label class="pr-1" for="per_page">{{__('Show')}} </label>
		<select autocomplete="off" class="form-control" name="filter[per_page]" id="per_page"  onchange="$('#{{$filter_id}}').submit()">
				<option value="10">10</option>
				<option value="25">25</option>
				<option value="50">50</option>
				<option value="100">100</option>
		</select>
	</div>
	<div class="input-group input-group-sm" style="width: 150px;">
	<input type="text" name="table_search" class="form-control float-right" placeholder="Search">
	<div class="input-group-append">
		<button type="submit" class="btn btn-default">
		<i class="fas fa-search"></i>
		</button>
	</div>
	</div>
</div> --}}

{{-- <div class="card-header-form mb-3">
	<form class="form-inline custom-filter" action="{{$filter_route}}" method="GET" id="{{$filter_id}}">
		<div class="input-group">
			<input autocomplete="off" name="filter[search]" id="search" type="text" class="form-control" placeholder="Search">
			<button class="btn btn-primary" onkeyup="submitOnEnter('#{{$filter_id}}')" for="search"><i class="fas fa-search"></i></button>
		</div>
	</form>
</div> --}}

{{-- 
<div class="card-header-form">
	<form>
	<div class="input-group">
		<input type="text" class="form-control" placeholder="Search">
		<div class="input-group-btn">
		<button class="btn btn-primary"><i class="fas fa-search"></i></button>
		</div>
	</div>
	</form>
</div> --}}

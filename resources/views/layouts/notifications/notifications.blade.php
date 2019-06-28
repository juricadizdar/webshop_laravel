<div class="container">
<div class="row">
@foreach(Session::all() as $key => $value)
@switch($key)
	@case('success')
		<div class="alert alert-{{ $key }}">{!! $value !!}</div>
		@break
	@case('danger')
		<div class="alert alert-{{ $key }}">{!! $value !!}</div>
		@break
	@default
@endswitch
@endforeach
</div>
</div>
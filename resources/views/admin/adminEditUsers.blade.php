@extends('layouts.admin')

@section('body')


<div class="table-responsive">
<h3>Update user data</h3>
    <form action="{{ route('users.update', $user) }}" method="post">

        {{csrf_field()}}
		@method('PUT')
        <div class="form-group">
            <label for="name">Admin</label>
            <input type="text" class="form-control" name="admin" id="name" value="{{$user->admin}}" required>
        </div>
        <div class="form-group">
            <label for="description">Email</label>
            <input type="email" class="form-control" name="email" id="description" value="{{$user->email}}">
        </div>
        <div class="form-group">
			<button class="btn btn-primary">Update</button>
        </div>
		
    </form>

</div>
@endsection

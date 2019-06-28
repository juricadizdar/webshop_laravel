@extends('layouts.admin')

@section('body')

<div class="table-responsive">
	
    <table class="table table-striped">
	<h3>List of users</h3>
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Admin</th>
            <th>Email</th>
            <th>Orders</th>
            <th>Edit</th>
			<th>Remove</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
        <tr>

            <td>{{$user['id']}}</td>
            <td>{{$user['name']}}</td>
            <td>{{$user['admin']}}</td>
            <td>{{$user['email']}}</td>
			<td>{{count($user->orders)}}</td>
            <td><a href="{{ route('users.edit', $user) }}" class="btn btn-primary">Change premission</a></td>
			<td>
				<form method="post" action="{{ route('users.destroy', $user)}}" style="display:inline-block;">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger">Remove</button>
				</form>
			</td>
        </tr>
        @endforeach

        </tbody>
    </table>
</div>
@endsection
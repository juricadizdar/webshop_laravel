@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Logged in</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					
					<p>Name: {!!  Auth::user()->name !!}</p>
					<p>Email: {!!  Auth::user()->email !!}</p>
					
					<a href="/products" class="btn btn-primary">Go to webshop</a>
					
					@if(Auth::user()->admin == 1)
						<a href="/admin/products" class="btn btn-primary"> Admin Panel </a>
					@else
						
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

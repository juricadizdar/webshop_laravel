@extends('layouts.admin')

@section('body')


<div class="table-responsive">
    <table class="table table-striped">
	<h3>List of products</h3>
        <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Remove</th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)
        <tr>
             <td><img src="{{ asset('storage/'.$product['image']) }}" alt="" width="100" height="80" style="max-height:220px" ></td>
			 
            <td>{{$product['name']}}</td>
            <td>{{$product['description']}}</td>
            <td>{{$product['type']}}</td>
            <td>{{$product['price']}}</td>

            <td><a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Edit</a></td>
            <td>
				<form method="post" action="{{ route('products.destroy', $product)}}" style="display:inline-block;">
					@csrf
					@method('DELETE')
					<button class="btn btn-danger">Remove</button>
				</form>
			</td>


        </tr>

        @endforeach





        </tbody>
    </table>
	
	{{ $products->links() }}


</div>
@endsection
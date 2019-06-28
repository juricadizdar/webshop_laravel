@extends('layouts.admin')

@section('body')


<div class="table-responsive">
	<h3>Update product</h3>
	
    <form action="{{ route('products.update', $product) }}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
		@method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name" value="{{$product->name}}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" placeholder="description" value="{{$product->description}}" required>
        </div>


        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" name="type" id="type" placeholder="type" value="{{$product->type}}" required>
        </div>

        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="price" value="{{$product->price}}" required>
        </div>
        @if($product->image)
            <div>
                <img src="{{ asset('storage/product_images/'.$product->image) }}" width="100" height="80" class="img-fluid" />
            </div>
        @endif
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="img" class="form-control" />
            </div>
                <div class="form-group">
					<button class="btn btn-primary">Update</button>
                </div>
    </form>

</div>
@endsection

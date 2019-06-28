@extends('layouts.admin')

@section('body')


<div class="table-responsive">
	
	<h3>Insert new product</h3>
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" name="description" id="description" required>
        </div>


        <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" name="type" id="type" required>
        </div>

        <div class="form-group">
            <label for="type">Price</label>
            <input type="text" class="form-control" name="price" id="price" required>
        </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="img" class="form-control" />
            </div>
                <div class="form-group">
					<button class="btn btn-primary">Store</button>
                </div>
    </form>

</div>
@endsection
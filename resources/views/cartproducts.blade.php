@extends('layouts.cart')
 
@section('center')

<div id="fh5co-services" class="fh5co-bg-section">
		<div class="container">
			<div class="table-responsive">
			<table class="table table-striped">
				<thead>
				<tr>
					  <th scope="col">Item</th>
					  <th scope="col">Descripton</th>
					  <th scope="col">Price</th>
					  <th scope="col">Quantity</th>
					  <th scope="col">Total</th>
					</tr>
				  </thead>
				  
				  <tbody>
				  @foreach($carts->items as $item)
					<tr>
					  <td class="active"><img src="{{Storage::disk('local')->url($item['data']['image'])}}" width="100" height="70"/></td>
					  <td class="active">
							<h5>{{ $item['data']['name'] }}</h5> 
							<p>{{ $item['data']['description'] }}</p>
							<p>{{ $item['data']['type'] }}</p>
					  </td>
					  <td class="active">HRK: {{ $item['price'] }}</td>
					  <td class="active"><a class="btn btn-default" href="{{ route('increaseProduct', ['id' => $item['data']['id']]) }}">+</a>{{ $item['quantity'] }}<a class="btn btn-default" href="{{ route('decreaseProduct', ['id' => $item['data']['id']]) }}"> -</a></td>
					  <td class="active">HRK: {{ $item['quantity'] * $item['price'] }}</td>
					  <td class="active"><a class="btn btn-default" href="{{ route('deleteFromCart',['id' => $item['data']['id']]) }}">x</a></td>
					</tr>
				
				  @endforeach
				  </tbody>
				</table>
			</div>
			
			<div class="row animate-box">
			
				<ul class="list-group">
				  <li class="list-group-item d-flex justify-content-between align-items-center">
					Quantity
					<span class="badge badge-pill">{{ $carts->totQuant }}</span>
				  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
					Shipping cost
					<span class="badge  badge-pill">Free</span>
				  </li>
				  <li class="list-group-item d-flex justify-content-between align-items-center">
					Total
					<span class="badge badge-pill">HRK: {{ $carts->totPrice }}</span>
				  </li>
				</ul>
				

				<a class="btn btn-primary btn-lg btn-block" href="{{ route('orders.index') }}">Proceed to checkout</a>
				<a class="btn btn-primary btn-lg btn-block" href="{{ route('allProducts') }}">Add products</a>
			</div>
			
		</div>
</div>

@endsection
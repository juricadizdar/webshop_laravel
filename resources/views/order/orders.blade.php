@extends('layouts.cart')

@section('center')

<div class="container" style="margin-top: 30px; margin-bottom: 30px;">
<div class="row">
    <div class="col-md-4 order-md-2 mb-4" style="float: right;">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">{{ $getSession->totQuant }}</span>
      </h4>
      <ul class="list-group mb-3">
	  @foreach($getSession->items as $item)
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
				<strong>Product name</strong>
				<small class="text-muted"> {{ $item['data']['name'] }} </small>
          </div>
		  
		  <div>
				<strong>Quantity</strong>
				<small class="text-muted"> {{ $item['quantity'] }} </small>
          </div>
		  
          <div>
				<strong>Price</strong>
				<small class="text-muted"> {{ $item['price'] }} </small>
          </div>
        </li>
		@endforeach
        <li class="list-group-item d-flex justify-content-between">
          <span>Total (HRK)</span>
          <strong>{{ $getSession->totPrice }}</strong>
        </li>
      </ul>
	</div>
	
    <div class="col-md-8 order-md-1" style="float: left;">
      <h4 class="mb-3">Billing address</h4>
	  
	  
      <form class="needs-validation" method="post" action="{{ route('orders.store') }}">
	  @csrf
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" name="first_name" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" name="last_name" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" name="address" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>
		
		<div class="mb-3">
          <label for="address">City</label>
          <input type="text" class="form-control" id="address" name="city" required>
          <div class="invalid-feedback">
            Please enter your city.
          </div>
        </div>

        <div class="mb-3">
          <label for="address2">State</label>
          <input type="text" class="form-control" id="address2" name="state">
		  <div class="invalid-feedback">
            Please enter your state.
          </div>
        </div>
		  
          <div class="col-md-3 mb-3">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" id="zip" name="zip" required>
            <div class="invalid-feedback">
              Zip code required.
            </div>
          </div>
		  
		<div class="row"></div>
		

        <input class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="Proceed to payment">
		
      </form>
	  <a class="btn btn-primary btn-lg btn-block" href="/cart">Update Cart</a>

	  
    </div>
  </div>
 </div>
 @endsection
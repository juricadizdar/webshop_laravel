@extends ('layouts.cart')

@section('center')
<div class="container" style="margin-top: 30px; margin-bottom: 30px;">
<div class="row">

      <form class="needs-validation" method="post" action="{{ route('payments.store') }}">
	  @csrf
        <h3 class="mb-3" style="margin-top: 30px;">Payment</h3>


        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="credit_card" checked required>
            <label class="custom-control-label" for="credit">Credit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" value="debit_card" required>
            <label class="custom-control-label" for="debit">Debit card</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" value="paypal" required>
            <label class="custom-control-label" for="paypal">PayPal</label>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Name on card</label>
            <input type="text" name="card_name" class="form-control" id="cc-name" placeholder="" required>
            <div class="invalid-feedback">
              Name on card is required
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="cc-number">Credit card number</label>
            <input type="text" name="card_number" class="form-control" id="cc-number" placeholder="" required>
			{!! $errors->has('card_number') ? $errors->first('card_number', '<p class="text-danger">:message</p>')  : '' !!}
            <div class="invalid-feedback">
              Credit card number is required
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="cc-expiration">Expiration</label>
            <input type="text" name="card_expiration" class="form-control" id="cc-expiration" placeholder="" required>
			{!! $errors->has('card_expiration') ? $errors->first('card_expiration', '<p class="text-danger">:message</p>')  : '' !!}
            <div class="invalid-feedback">
              Expiration date required
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="cc-cvv">CVV</label>
            <input type="text" name="card_cvv" class="form-control" id="cc-cvv" placeholder="" required>
			{!! $errors->has('card_cvv') ? $errors->first('card_cvv', '<p class="text-danger">:message</p>')  : '' !!}
            <div class="invalid-feedback">
              Security code required
            </div>
          </div>
        </div>
		
		<div class="row"></div>
		

        <input class="btn btn-primary btn-lg btn-block" name="submit" type="submit" value="Pay">
		
      </form>
	  
  </div>
 </div>		
@endsection		

		
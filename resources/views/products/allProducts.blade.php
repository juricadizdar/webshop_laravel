@extends('layouts.products')

	
@section('center')
	<div id="fh5co-product">	
			<div class="container">
			<div class="row">
				
				
				@foreach($products as $product)
				
					<div class="col-md-4 text-center animate-box">
						<div class="product">
							<div class="product-grid" style="background-image:url( {{Storage::disk('local')->url($product->image)}} );">
								<div class="inner">
									<p>
										<a href="{{ route('addToCart', ['id'=> $product->id]) }}" class="icon"><i class="icon-shopping-cart"></i></a>
										<a href="{{ route('singleProduct', $product->id) }}" class="icon"><i class="icon-eye"></i></a>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="single.html">{{ $product->name }}</a></h3>
								<span class="price">{{ $product->price }}</span>
							</div>
						</div>
					</div>	
					
				@endforeach	
				
			</div>	
			</div>
	</div>
@endsection
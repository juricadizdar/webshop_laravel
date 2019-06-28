

<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
			
			@foreach($products as $product)
		   	<li style="background-image:url( {{Storage::disk('local')->url($product->image)}} );">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
		   				<div class="slider-text-inner">
		   					<div class="desc">
		   						<span class="price">{{ $product->price }}</span>
		   						<h2>{{ $product->name }}</h2>
		   						<p>{{ $product->description  }}</p>
			   					<p><a href="{{ route('singleProduct', $product->id) }}" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p>
		   					</div>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
			@endforeach
			
		  	</ul>
	  	</div>
</aside>
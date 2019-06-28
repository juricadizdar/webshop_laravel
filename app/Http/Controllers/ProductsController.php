<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
		$products = Product::paginate(6);
		return view('allproducts')->with('products', $products);
		
    }
	
	public function indexAll()
    {
        //
		$products = Product::all();
		return view('products.allProducts')->with('products', $products);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product)
    {
        //
		$singleProduct = Product::where('id', $product)->get();
		return view('products.singleProduct')->with('singleProduct', $singleProduct);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
	
	public function addToCart(Request $request, $id){
		
		$preCart = $request->session()->get('cart');
		$cart = new Cart($preCart);
		
		$product = Product::find($id);
		$cart->addItem($id, $product);
		
		$request->session()->put('cart', $cart);
		
		//dump($cart);
		
		return redirect()->route('allProducts');
	}
	
	public function showCart(){
		
		$carts = Session::get('cart');
		
		// Cart not empty
		if($carts){
			return view('cartproducts')->with('carts', $carts);
			
		// Cart is empty	
		} else {
			return redirect()->route('allproducts');
			
		}
		
	}
	
	public function deleteFromCart(Request $request, $id){
		$cart = $request->session()->get('cart');
		
		if (array_key_exists($id, $cart->items)){
			unset($cart->items[$id]);
		}
		
		$preCart = $request->session()->get('cart');
		$updCart = new Cart($preCart);
		$updCart->updatePriceAndQuantity();
		
		$request->session()->put('cart', $updCart);
		return redirect()->route('cartproducts');
	}
	
	public function increaseProduct(Request $request, $id){
		
		$preCart = $request->session()->get('cart');
		$cart = new Cart($preCart);
		
		$product = Product::find($id);
		$cart->addItem($id, $product);
		$request->session()->put('cart', $cart);
		
		//return redirect()->route('cartproducts');
		return redirect()->back();
		
	}
	
	public function decreaseProduct(Request $request, $id){
		
		$preCart = $request->session()->get('cart');
		$cart = new Cart($preCart);
		
		if($cart->items[$id]['quantity'] > 1){
			$cart->items[$id]['quantity'] = $cart->items[$id]['quantity'] - 1;
			$product = Product::find($id);
			$price = (int)str_replace("HRK:","", $product->price);
			$cart->items[$id]['price'] = $cart->items[$id]['quantity'] * $price;
			$cart->updatePriceAndQuantity();
			
			$request->session()->put('cart', $cart);
			
		}
		
		return redirect()->route('cartproducts');
		
	}
	
	public function search(Request $request){
		$search = trim($request->get('search'));
		$products = Product::where('name', 'Like', '%'.$search.'%')->paginate(3);
		return view('allproducts')->with('products', $products);
	}
	
	public function about()
    {
        //
		return view('about.about');
		
    }
	
	public function contact()
    {
        //
		return view('contact.contact');
		
    }
}

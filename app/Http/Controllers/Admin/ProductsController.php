<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
		$products = Product::paginate(3);
		return view('admin.adminProducts')->with('products', $products);
		
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('admin.adminCreateProduct');
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
		
		Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();
		  
		if($request->file('image')){
			  $filename = $request->file('image')->getClientOriginalName();
			  
			  $dir ='product_images/'.$filename; 

			$path =  $request->file('image')->storeAs(null, $dir, 'public');
		}
		
		$data = [
			'name' => trim($request->get('name')),
			'description' => trim($request->get('description')),
			'type' => trim($request->get('type')),
			'price' => (int)$request->get('price'),
			'image' => isset($path) ? $path : '' 
		];
		
		$store = Product::create($data);
		
		if($store){
			return redirect('admin/products');
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
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
		return view('admin.adminEditProduct')->with('product', $product);
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
		Validator::make($request->all(),['image'=>"required|file|image|mimes:jpg,png,jpeg|max:5000"])->validate();
		  
		if($request->file('image')){
			$filename = $request->file('image')->getClientOriginalName();
			  
			$dir ='product_images/'.$filename;

			if($product->image){
				Storage::disk('public')->delete($product->image);
			} 

			$path =  $request->file('image')->storeAs(null, $dir, 'public');
		}
	
		$data = [
			'name' => trim($request->get('name')),
			'description' => trim($request->get('description')),
			'type' => trim($request->get('type')),
			'price' => (int)$request->get('price'),
			'image' => isset($path) ? $path : ''
		];
		
		$update = $product->update($data);
		
		if($update){
			session()->flash('success', 'Users data updated successfully!');
			return redirect('admin/products');
		} else {
			session()->flash('danger', 'There was a problem, please try again!');
			return back();
		} 
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
		if($product->image){
			Storage::disk('public')->delete($product->image);
		}
		$deleteProduct = $product->delete();
		
		if($deleteProduct){
			session()->flash('success', 'Product deleted successfully!');
			return back();
		} else {
			session()->flash('danger', 'There was a problem, please try again!');
			return back();
		}
    }

}
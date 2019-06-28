<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Session;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index()
    {
		$getSession = Session::get('cart');
		
		if($getSession->totQuant == null){
			session()->flash('danger', 'Your card is empty!');
			return redirect()->route('allProducts');
		} else{
			return view('order.orders')->with('getSession', $getSession);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$getSession = Session::get('cart');
		
		if($getSession->totQuant == null){
			return redirect()->route('allProducts');
		} else{
			return view('order.orders')->with('getSession', $getSession);
		}
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
		// Get session
		$getSession = Session::get('cart');
		
		// date field
		$date = date("Y-m-d H:i:s");
		// status field
		$status = 'delivery';
		// del-date field
		$delivery = strtotime("2 day", strtotime($date));
		$del_date = date("Y-m-d", $delivery);
		// price field
		$price = Session::get('cart')->totPrice;
		// user_id field
		$user_id = Auth::user()->id;
		// email field
		$email = Auth::user()->email;
		
		$data = [
			'date' => $date,
			'status' => $status,
			'del_date' => $del_date,
			'price' => $price,
			'first_name' => trim(ucfirst(strtolower($request->get('first_name')))),
			'last_name' => trim(ucfirst(strtolower($request->get('last_name')))),
			'address' => trim(ucfirst(strtolower($request->get('address')))),
			'city' => trim(ucfirst(strtolower($request->get('city')))),
			'state' => trim(ucfirst(strtolower($request->get('state')))),
			'zip' => (int)trim($request->get('zip')),
			'user_id' => $user_id,
			'email' => $email
		];
		
		//dd($data);
		$order = new Order();
		$order->create($data);
		
		if($order){
			//Session::forget('cart');
			return redirect()->route('payments.index');
		} 
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}

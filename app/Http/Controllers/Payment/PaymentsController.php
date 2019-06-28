<?php

namespace App\Http\Controllers\Payment;

use App\Models\Payment;
use App\Models\Order;
use App\Mail\OrderRecieved;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Session;


class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('payment.payment');
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
		// order_id field
		$lastRecord = Order::orderBy('id', 'DESC')->first();
		$order_id = $lastRecord->id;
		
		// user_id field
		$user_id = $lastRecord->user_id;
		
		/*$user_id1 = Order::orderBy('id', 'DESC')->with('user')->first();
		dump($user_id1->user->email);*/
		
		// paid_with field
		$cardRequest = $request->get('paymentMethod');
		switch($cardRequest){
		
			case "credit_card":
			$paid_with = $cardRequest;
			break;
			
			case "debit_card":
			$paid_with = $cardRequest;
			break;
			
			case "paypal":
			$paid_with = $cardRequest;
			break;
		}
		$paid_with = $cardRequest;
		
		// amount field
		$amount = $lastRecord->price;
		//dump($amount);
		
		// date field
		$created_at = date("Y-m-d H:i:s");
		
		Validator::make($request->all(),
			[
				'card_number'=>"required|digits:16",
				'card_expiration'=>"required|digits:4",
				'card_cvv'=>"required|digits_between:3,4"
			])->validate();
			
		$data = [		
			'order_id' => $order_id,
			'user_id' => $user_id,
			'paid_with' => $paid_with,
			'amount' => $amount,
			'created_at' => $created_at,
			'card_name' => trim(ucfirst(strtolower($request->get('card_name')))),
			'card_number' => trim($request->get('card_number')),
			'card_expiration' => trim($request->get('card_expiration')),
			'card_cvv' => trim($request->get('card_cvv'))		
		];
		//dump($data);
		$payment = new Payment();
		$payment->create($data);
		
		if($payment){
			\Mail::to(Auth::user())->send(new OrderRecieved);
			Session::forget('cart');
			session()->flash('success', 'Order completed, You recieved confirmation email!');
			return redirect()->route('allproducts');
		}
		
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

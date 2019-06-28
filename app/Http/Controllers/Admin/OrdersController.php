<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class OrdersController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $orders = Order::with('payment')->paginate(10);

			$today = strtotime(date('Y-m-d'));
			foreach($orders as $order){
				
				$del_date = strtotime($order->del_date);
				if ($del_date <= $today) {
					$order->status = "deliverd";
			}
		
		}
		return view('admin.adminOrders')->with('orders', $orders);
		
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
		return view('admin.adminEditUsers')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
	
		$data = [
			'admin' => (bool)trim($request->get('admin')),
			'email' => trim($request->get('email'))
		];
		
		$save = $user->update($data);
		
		if($save){
			return redirect('admin/users');
		} 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
		$deleteUser = $user->delete();
		
		if($deleteUser){
			return back();
		}
    }

}